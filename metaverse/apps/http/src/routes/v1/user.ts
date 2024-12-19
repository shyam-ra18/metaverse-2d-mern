import { Router } from "express";
import { SigninSchema, SignupSchema, UpadeMetadataSchema } from "../../types";
import client from '@repo/db/client';
import { hash, compare } from "../../scrypt";
import jwt from 'jsonwebtoken';
import { JWT_PASSWORD } from "../../config";
import { userMiddleware } from "../../middleware/user";

export const userRouter = Router();

userRouter.post("/signup", async (req, res) => {

    const parsedData = SignupSchema.safeParse(req.body);
    if (!parsedData.success) {
        res.status(400).json({ message: 'Validation Failed' })
        return
    }
    try {

        const userExist = await client.user.findUnique({
            where: {
                username: parsedData.data.username
            }
        })

        if (userExist) {
            res.status(400).json({ message: 'User already exist' })
            return
        }

        const hashedPassword = await hash(parsedData.data.password)

        const user = await client.user.create({
            data: {
                username: parsedData.data.username,
                password: hashedPassword,
                role: parsedData.data.type === 'admin' ? "Admin" : 'User'
            }
        })

        res.status(201).json({
            userId: user.id,
            message: 'User created successfully'
        });

    } catch (error) {
        console.log('signup error ==> ', error)
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

userRouter.post("/signin", async (req, res) => {
    const parsedData = SigninSchema.safeParse(req.body);
    if (!parsedData.success) {
        res.status(400).json({ message: 'Validation Failed' })
        return
    }

    try {
        const user = await client.user.findUnique({
            where: {
                username: parsedData.data.username
            }
        })

        if (!user) {
            res.status(403).json({ message: 'User not found' })
            return
        }

        const isValid = await compare(parsedData.data.password, user.password);
        if (!isValid) {
            res.status(400).json({ message: 'Invalid credentials' })
        }
        const token = jwt.sign({
            userId: user.id,
            role: user.role
        }, JWT_PASSWORD);

        res.status(200).json({ token, message: 'Signin successfull' })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }

});

userRouter.post("/metadata", userMiddleware, async (req, res) => {
    try {
        // Validate request body with Zod
        const parsedData = UpadeMetadataSchema.safeParse(req.body);
        if (!parsedData.success) {
            res.status(400).json({
                message: 'Validation Failed',
                errors: parsedData.error.errors
            });
            return
        }
        // Update user metadata in the database
        await client.user.update({
            where: { id: req.userId },
            data: { avatarId: parsedData.data.avatarId },
        });

        // Respond with success
        res.status(200).json({ message: 'Metadata updated' });
    } catch (error) {
        // console.error('Error updating metadata:', error);
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

userRouter.get("/metadata/bulk", async (req, res): Promise<void> => {
    try {
        const userIdString = (req.query.ids ?? []) as string;
        const userIds = (userIdString).slice(1, userIdString?.length - 2).split(',');

        const metadata = await client.user.findMany({
            where: {
                id: { in: userIds }
            },
            select: {
                avatar: true,
                id: true
            }
        })

        res.status(200).json({
            avatars: metadata?.map((m) => ({
                id: m.id,
                avatarId: m.avatar?.imageUrl
            }))
        })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
});