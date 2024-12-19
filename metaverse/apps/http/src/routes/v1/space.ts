import { Router } from "express";
import { AddElementSchema, CreateSpaceSchema, DeleteElementSchema } from "../../types";
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
            res.status(201).json({ spaceId: space.id, message: 'Space created' });
            return;
        };

        const map = await client.map.findFirst({
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
        const parsedData = AddElementSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({
                message: 'Validation Failed',
                errors: parsedData.error.errors
            });
            return
        }

        const space = await client.space.findUnique({
            where: {
                id: parsedData.data.spaceId,
                creatorId: req.userId,
            }, select: {
                width: true,
                height: true
            }
        });

        if (!space) {
            res.status(400).json({ message: "Space not found" })
            return
        }

        await client.spaceElements.create({
            data: {
                spaceId: parsedData.data.spaceId,
                elementId: parsedData.data.elementId,
                x: parsedData.data.x,
                y: parsedData.data.y,
            }
        });

        res.status(200).json({ message: 'Element added' })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.delete("/element", userMiddleware, async (req, res) => {
    try {
        const parsedData = DeleteElementSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({
                message: 'Validation Failed',
                errors: parsedData.error.errors
            });
            return
        }

        const spaceElement = await client.spaceElements.findFirst({
            where: {
                id: parsedData.data.id,
            }, include: {
                space: true
            }
        });

        if (!spaceElement?.space.creatorId || spaceElement.space.creatorId !== req.userId) {
            res.status(403).json({ message: "Unauthorized" })
            return
        }

        await client.spaceElements.delete({
            where: {
                id: parsedData.data.id,
            }
        });

        res.status(200).json({ message: 'Element deleted' })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

spaceRouter.get("/:spaceId", userMiddleware, async (req, res) => {
    try {
        const space = await client.space.findUnique({
            where: {
                id: req.params.spaceId,
            }, include: {
                elements: {
                    include: {
                        element: true
                    }
                }
            }
        });

        if (!space) {
            res.status(400).json({ message: "Space not found" })
            return
        }
        res.status(200).json({
            dimensions: `${space.width}x${space.height}`,
            elements: space.elements.map(e => ({
                id: e.id,
                element: {
                    id: e.element.id,
                    imageUrl: e.element.imageUrl,
                    width: e.element.width,
                    height: e.element.height,
                    static: e.element.static
                },
                x: e.x,
                y: e.y
            }))
        })

    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});