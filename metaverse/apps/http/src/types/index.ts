import z from "zod";

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
    avatarId: z.string(),
})

export const AddElementSchema = z.object({
    elementId: z.string(),
    spaceId: z.string(),
    x: z.number(),
    y: z.number(),
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
    defaultElements: z.array(z.object({
        element: z.string(),
        x: z.number(),
        y: z.number(),
    }))
})