<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CheckCircle2Icon } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import posts from '@/routes/posts';
import { Button } from '@/components/ui/button';
import {Alert,AlertTitle} from '@/components/ui/alert';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';


interface User {
    id: number;
    name: string;
}

interface Post {
    id: number;
    content: string;
    user: User;  
    created_at: string;
}

interface Props {
    posts: Post[];
}

const props = defineProps<Props>(); 

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: "/posts",
    },
];

const page = usePage();
</script>

<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <!-- show message -->
            <div v-if="page.props.flash?.message" class="grid w-full max-w-xl items-start gap-4 m-b-4">
                <!TODO: Move this to a global component and use it for flash messages when creating/updating/deleting posts.>
                <Alert>
                    <CheckCircle2Icon />
                    <AlertTitle>{{ page.props.flash?.message }}</AlertTitle>
                </Alert>
            </div>
            <Link :href="posts.create()">
                <Button>Create Post</Button>
            </Link>
            <div class="my-4 space-y-4">
                <Card v-for="post in props.posts" :key="post.id" class="w-full max-w-xl">
                    <CardHeader>
                        <CardTitle>{{ post.user.name }}</CardTitle>
                        <CardDescription>{{ new Date(post.created_at) }}</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <Link :href="posts.show(post.id)">
                            <p>{{ post.content }}</p>
                        </Link>
                    </CardContent>
                    <CardFooter>
                        <p>{{ post.created_at }}</p>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
