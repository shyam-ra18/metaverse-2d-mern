import z from "zod";

declare global {
    namespace Express {
        export interface Request {
            role: "Admin" | "User"
            userId?: string
        }
    }
}


export const SignupSchema = z.object({
    username: z.string(),
    password: z.string().min(8),
    type: z.enum(['user', 'admin'])
})

export const SigninSchema = z.object({
    username: z.string(),
    password: z.string().min(8),
})

export const UpadeMetadataSchema = z.object({
    avatarId: z.string(),
})

export const CreateSpaceSchema = z.object({
    name: z.string(),
    //custom function that validates 100x100 schema
    dimensions: z.string().regex(/^[0-9]{1,4}x[0-9]{1,4}$/),
    mapId: z.string().optional(),
})

export const AddElementSchema = z.object({
    elementId: z.string(),
    spaceId: z.string(),
    x: z.number().refine(
        (value) => Math.abs(value) < 1000,
        { message: "x must be a number with at most 3 digits." }
    ),
    y: z.number().refine(
        (value) => Math.abs(value) < 1000,
        { message: "y must be a number with at most 3 digits." }
    ),
})

export const DeleteElementSchema = z.object({
    id: z.string(),
})

export const CreateElementSchema = z.object({
    imageUrl: z.string(),
    width: z.number(),
    height: z.number(),
    static: z.boolean()
})

export const UpdateElementSchema = z.object({
    imageUrl: z.string(),
})

export const CreateAvatarSchema = z.object({
    name: z.string(),
    imageUrl: z.string()
})

export const CreateMapSchema = z.object({
    thumbnail: z.string(),
    dimensions: z.string().regex(/^[0-9]{1,4}x[0-9]{1,4}$/),
    name: z.string(),
    defaultElements: z.array(z.object({
        elementId: z.string(),
        x: z.number(),
        y: z.number(),
    }))
})