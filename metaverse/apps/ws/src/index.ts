import { WebSocketServer } from "ws";
import { User } from "./user";

const wss = new WebSocketServer({ port: 3001 });

wss.on("connection", function connection(ws) {
  console.log("user connected on socket server:-");
  let user = new User(ws);

  ws.on("error", console.error);

  ws.on("close", () => {
    user?.destroy();
  });
});
