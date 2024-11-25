import { Router } from "express";

export const adminRouter = Router();

adminRouter.post("/element", (req, res) => {
    res.send("Admin Page");
});

adminRouter.put("/element/:elementId", (req, res) => {
    res.send("Admin Page");
});

adminRouter.post("/avatar", (req, res) => {
    res.send("Admin Page");
});

adminRouter.get("/map", (req, res) => {
    res.send("Admin Page");
});