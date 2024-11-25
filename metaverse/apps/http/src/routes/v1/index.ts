import { Router } from "express";
import { userRouter } from "./user";
import { adminRouter } from "./admin";
import { spaceRouter } from "./space";

export const router = Router();

router.use('/user', userRouter);
router.use('/space', spaceRouter);
router.use('/admin', adminRouter);

router.get("/elements", (req, res) => {
    res.json({
        message: 'profile'
    })
});

router.get("/avatars", (req, res) => {
    res.json({
        message: 'profile'
    })
});