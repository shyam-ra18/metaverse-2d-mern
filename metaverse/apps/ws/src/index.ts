import { WebSocketServer } from "ws";
import { User } from "./user";

const wss = new WebSocketServer({ port: 3000 });

wss.on("connection", function connection(ws) {
  let user: User;
  ws.on("error", console.error);

  ws.on("message", function message(data) {
    user = new User(ws);
  });

  ws.on("close", () => {
    user?.destroy();
  });
});
