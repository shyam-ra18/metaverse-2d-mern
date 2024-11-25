import { Router } from "express";

export const spaceRouter = Router();

spaceRouter.post("/", (req, res) => {
    res.send("Space");
});

spaceRouter.delete("/:spaceId", (req, res) => {
    res.send("Space");
});

spaceRouter.get("/all", (req, res) => {
    res.send("Space");
});

spaceRouter.post("/element", (req, res) => {
    res.send("Space");
});

spaceRouter.delete("/element", (req, res) => {
    res.send("Space");
});

spaceRouter.get("/:spaceId", (req, res) => {
    res.send("Space");
});