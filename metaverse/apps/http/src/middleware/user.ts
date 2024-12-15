import jwt from 'jsonwebtoken';
import { JWT_PASSWORD } from '../config';
import { NextFunction, Request, Response } from 'express';

export const userMiddleware = (req: Request, res: Response, next: NextFunction): void => {
    try {
        // Extract the Authorization header
        const authHeader = req.headers.authorization;

        // Check if the header exists and is properly formatted
        if (!authHeader || !authHeader.startsWith('Bearer ')) {
            res.status(401).json({ message: 'Unauthorized: Missing or invalid token' });
            return
        }

        // Extract the token from the header
        const token = authHeader.split(' ')[1];

        // Check if the token is present
        if (!token) {
            res.status(403).json({ message: 'Unauthorized: Token not provided' });
            return
        }

        const decoded = jwt.verify(token, JWT_PASSWORD) as { role: string, userId: string };
        req.role = decoded.role as "Admin" | "User";
        req.userId = decoded.userId;

        next(); // Proceed to the next middleware or route handler
    } catch (error) {
        res.status(500).json({ message: 'Internal Server Error' });
    }
};
