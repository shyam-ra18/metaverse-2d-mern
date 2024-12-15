import { Router } from "express";
import { SigninSchema, SignupSchema } from "../../types";
import client from '@repo/db/client';
// import bcrypt from 'bcrypt';
import { hash, compare } from "../../scrypt";
import jwt from 'jsonwebtoken';
import { JWT_PASSWORD } from "../../config";

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
            user: user.id,
            role: user.role
        }, JWT_PASSWORD);

        res.status(200).json({ token, message: 'Signin successfull' })
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }

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