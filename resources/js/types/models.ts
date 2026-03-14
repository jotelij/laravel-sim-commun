import { User } from "./auth";

export type Post = {
    id: number;
    content: string;
    user: User;
    created_at: string;
    comments: Comment[];
    comments_count: number;
    reactions_count: number;
}

export type Comment = {
    id: number;
    content: string;
    user: User;
    created_at: string;
    reactions_count: number;
}