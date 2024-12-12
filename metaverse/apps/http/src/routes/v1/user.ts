import { Router } from "express";

export const userRouter = Router();

userRouter.post("/signup", (req, res) => {

    res.json({
        message: 'signup'
    })
});

userRouter.post("/signin", (req, res) => {
    res.json({
        message: 'signin'
    })
});

userRouter.post("/metadata", (req, res) => {
    res.json({
        message: 'signin'
    })
});

userRouter.get("/metadata/bulk", (req, res) => {
    res.json({
        message: 'signin'
    })
});