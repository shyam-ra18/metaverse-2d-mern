import { WebSocket } from "ws";
import { RoomManager } from "./roomManager";
import { OutgoingMessage } from "./types";
import client from "@repo/db/client";
import jwt, { JwtPayload } from "jsonwebtoken";

const JWT_PASSWORD = "nkaskd7657B@#";
// Utility function to generate a random alphanumeric ID of the given length
function getRandomId(length: number) {
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  let randomId = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    randomId += characters[randomIndex];
  }

  return randomId;
}

// User class to handle individual user connections and interactions
export class User {
  public id: string;
  public userId?: string;
  private spaceId?: string;
  private x: number;
  private y: number;

  constructor(private ws: WebSocket) {
    // Assign a random ID to the user upon creation
    this.id = getRandomId(10);
    this.x = 0;
    this.y = 0;
  }

  // Initialize event handlers for the WebSocket connection
  initHandlers() {
    this.ws.on("message", async (data) => {
      const parsedData = JSON.parse(data.toString());
      switch (parsedData.type) {
        // Handle 'join' event: the user wants to join a space
        case "join":
          const spaceId = parsedData.payload.spaceId;
          const token = parsedData.payload.token;
          const userId = (jwt.verify(token, JWT_PASSWORD) as JwtPayload)
            ?.userId as string;

          if (!userId) {
            this.ws.close();
            return;
          }

          this.userId = userId;

          // Fetch the space from the database using the provided spaceId
          const space = await client.space.findFirst({
            where: {
              id: spaceId,
            },
          });

          if (!space) {
            this.ws.close();
            return;
          }

          // Set the user's spaceId and assign random spawn coordinates within the space
          this.spaceId = spaceId;
          this.x = Math.floor(Math.random() * space.width);
          this.y = Math.floor(Math.random() * space.height);

          // Add the user to the room (space)
          RoomManager.getInstance().addUser(spaceId, this);

          // Send a response to the user with their spawn coordinates and other users in the space
          this.send({
            type: "space-joined",
            payload: {
              spawn: {
                x: this.x,
                y: this.y,
              },
              users:
                RoomManager?.getInstance()
                  .rooms.get(spaceId)
                  ?.map((u) => ({ id: u.id })) ?? [], // List of users currently in the space
            },
          });

          // Broadcast that the user is join
          RoomManager.getInstance().broadcast(
            {
              type: "user-joined",
              payload: {
                userId: this.userId,
                x: this.x,
                y: this.y,
              },
            },
            this,
            this.spaceId!
          );
          break;

        // Handle 'move' event: the user wants to move to a new position
        case "move":
          const moveX = parsedData.payload.x;
          const moveY = parsedData.payload.y;

          // Calculate the distance the user is trying to move in the x and y directions
          const xDisplacement = Math.abs(this.x - moveX);
          const yDisplacement = Math.abs(this.y - moveY);

          // Update the user's position to the new coordinates
          this.x = moveX;
          this.y = moveY;

          // Check if the movement is valid (moving by exactly 1 step in either x or y direction)
          if (
            (xDisplacement == 1 && yDisplacement == 0) ||
            (xDisplacement == 0 && yDisplacement == 1)
          ) {
            // If the move is valid, broadcast the movement to other users in the same space
            RoomManager.getInstance().broadcast(
              {
                type: "move",
                payload: {
                  x: this.x,
                  y: this.y,
                },
              },
              this,
              this.spaceId!
            );
            return;
          }

          // If the move is invalid (not exactly 1 step), reject the move
          this.send({
            type: "movement-rejected",
            payload: {
              x: this.x,
              y: this.y,
            },
          });

          break;
        default:
          break;
      }
      console.log("Received message from client: ", data);
    });
  }

  destroy() {
    RoomManager.getInstance().broadcast(
      {
        type: "user-left",
        payload: {
          userId: this.userId,
        },
      },
      this,
      this.spaceId!
    );
    RoomManager.getInstance().removeUser(this, this.spaceId!);
  }

  send(payload: OutgoingMessage) {
    this.ws.send(JSON.stringify(payload));
  }
}
