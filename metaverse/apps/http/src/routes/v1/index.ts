import { Router } from "express";
import { userRouter } from "./user";
import { adminRouter } from "./admin";
import { spaceRouter } from "./space";
import client from "@repo/db/client";

export const router = Router();

router.use('/user', userRouter);
router.use('/space', spaceRouter);
router.use('/admin', adminRouter);

router.get("/elements", async (req, res) => {
    try {
        const elements = await client.element.findMany();
        res.json({
            elements: elements.map(e => ({
                id: e.id,
                imageUrl: e.imageUrl,
                width: e.width,
                height: e.height,
                static: e.static
            }))
        });
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

router.get("/avatars", async (req, res) => {
    try {
        const avatars = await client.avatar.findMany();
        res.json({
            avatars: avatars.map(a => ({
                id: a.id,
                imageUrl: a.imageUrl,
                name: a.name
            }))
        });
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});