import { WebSocket } from "ws";
import { RoomManager } from "./roomManager";
import { OutgoingMessage } from "./types";

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

export class User {
  public id: string;
  constructor(private ws: WebSocket) {
    this.id = getRandomId(10);
  }

  initHandlers() {
    this.ws.on("message", (data) => {
      const parsedData = JSON.parse(data.toString());
      switch (parsedData.type) {
        case "join":
          const spaceId = parsedData.payload.spaceId;
          RoomManager.getInstance().addUser(spaceId, this);
          this.send({
            type: "join",
            payload: {
              spaceId: spaceId,
              userId: this.id,
            },
          });
          break;
        case "move":
          break;
        default:
          break;
      }
      console.log("Received message from client: ", data);
    });
  }

  send(payload: OutgoingMessage) {
    this.ws.send(JSON.stringify(payload));
  }
}
