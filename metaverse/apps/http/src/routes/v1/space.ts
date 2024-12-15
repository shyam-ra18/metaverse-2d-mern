import { Router } from "express";
import { CreateElementSchema, CreateSpaceSchema } from "../../types";
import client from '@repo/db/client';
import { userMiddleware } from "../../middleware/user";

export const spaceRouter = Router();

spaceRouter.post("/", userMiddleware, async (req, res) => {
    try {
        const parsedData = CreateSpaceSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({
                message: 'Validation Failed',
                errors: parsedData.error.errors
            });
            return
        }

        if (!parsedData?.data?.mapId) {
            const space = await client.space.create({
                data: {
                    name: parsedData.data.name,
                    width: parseInt(parsedData.data.dimensions.split("x")[0]),
                    height: parseInt(parsedData.data.dimensions.split("x")[1]),
                    creatorId: req.userId as string
                }
            })
            res.status(201).json({ spaceId: space.id, message: 'Space created' })
        };

        const map = await client.map.findUnique({
            where: {
                id: parsedData.data.mapId
            },
            select: {
                mapElements: true,
                height: true,
                width: true
            }
        });

        if (!map) {
            res.status(403).json({ message: 'Map not found' })
            return
        }

        let space = await client.$transaction(async () => {
            const space = await client.space.create({
                data: {
                    name: parsedData.data.name,
                    width: map.width,
                    height: map.height,
                    creatorId: req.userId as string
                }
            });

            await client.spaceElements.createMany({
                data: map.mapElements.map(e => ({
                    spaceId: space.id,
                    elementId: e.elementId,
                    x: e.x!,
                    y: e.y!
                }))
            });

            return space;
        })

        res.status(201).json({ spaceId: space.id, message: 'Space created' })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.delete("/:spaceId", userMiddleware, async (req, res) => {
    try {

        const { spaceId } = req.params;

        if (!spaceId) {
            res.status(400).json({ message: "Invalid request: Missing spaceId parameter" });
            return
        }

        const space = await client.space.findUnique({
            where: {
                id: spaceId
            }, select: {
                creatorId: true
            }
        });

        if (!space) {
            res.status(404).json({ message: 'No space found' })
            return
        }

        if (space?.creatorId !== req.userId) {
            res.status(403).json({ message: "Unauthorized: You do not have permission to delete this space" });
            return
        }

        await client.space.delete({
            where: {
                id: spaceId
            }
        });

        res.status(200).json({ message: "Space deleted successfully" })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.get("/all", userMiddleware, async (req, res) => {
    try {
        const spaces = await client.space.findMany({
            where: {
                creatorId: req.userId
            }
        });

        res.status(200).json({
            spaces: spaces.map(s => ({
                id: s.id,
                name: s.name,
                dimensions: `${s.width}x${s.height}`,
                thumbnail: s.thumbnail
            }))
        })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.post("/element", userMiddleware, async (req, res) => {
    try {
        const parsedData = CreateElementSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({
                message: 'Validation Failed',
                errors: parsedData.error.errors
            });
            return
        }

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.delete("/element", (req, res) => {
    res.send("Space");
});

spaceRouter.get("/:spaceId", (req, res) => {
    res.send("Space");
});