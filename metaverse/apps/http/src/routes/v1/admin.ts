import client from '@repo/db/client';
import { Router } from "express";
import { CreateAvatarSchema, CreateElementSchema, CreateMapSchema, UpdateElementSchema } from "../../types";
import { adminMiddleware } from '../../middleware/admin';

export const adminRouter = Router();

adminRouter.post("/element", adminMiddleware, async (req, res) => {
    try {
        const parsedData = CreateElementSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({ message: 'Validation failed' });
            return
        }

        const element = await client.element.create({
            data: {
                width: parsedData.data.width,
                height: parsedData.data.height,
                static: parsedData.data.static,
                imageUrl: parsedData.data?.imageUrl,
            }
        });

        res.status(200).json({
            message: "Element created",
            id: element.id
        })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

adminRouter.put("/element/:elementId", adminMiddleware, async (req, res) => {
    try {
        const parsedData = UpdateElementSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({ message: 'Validation failed' });
            return
        }

        await client.element.update({
            where: {
                id: req.params.elementId
            },
            data: {
                imageUrl: parsedData.data.imageUrl
            }
        });

        res.status(200).json({
            message: "Element updated"
        })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

adminRouter.post("/avatar", adminMiddleware, async (req, res) => {
    try {
        const parsedData = CreateAvatarSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({ message: 'Validation failed' });
            return
        }

        const avatar = await client.avatar.create({
            data: {
                name: parsedData.data.name,
                imageUrl: parsedData.data.imageUrl
            }
        });

        res.status(201).json({
            id: avatar.id,
            message: "Avatar created"
        })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

adminRouter.get("/map", adminMiddleware, async (req, res) => {
    try {
        const parsedData = CreateMapSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({ message: 'Validation failed' });
            return
        }

        const map = await client.map.create({
            data: {
                name: parsedData.data.name,
                width: parseInt(parsedData.data.dimensions.split('x')[0]),
                height: parseInt(parsedData.data.dimensions.split('x')[1]),
                thumbnail: parsedData.data.thumbnail,
                mapElements: {
                    create: parsedData.data.defaultElements.map(e => ({
                        elementId: e.element,
                        x: e.x,
                        y: e.y
                    }))
                }
            }
        });

        res.status(201).json({
            id: map.id,
            message: "Map created"
        })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});