<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CheckCircle2Icon, ThumbsUpIcon, MessageSquareText  } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import posts from '@/routes/posts';
import { Button } from '@/components/ui/button';
import { ButtonGroup } from '@/components/ui/button-group';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Post } from '@/types/models';
import { timeAgo } from '@/lib/utils';

interface Props {
    posts: Post[];
}

const props = defineProps<Props>(); 

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'My Posts',
        href: "user/my_posts",
    },
];

const page = usePage();

</script>

<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Link :href="posts.create()">
                <Button>Create Post</Button>
            </Link>
            <div class="my-4 space-y-4">
                <Card v-for="post in props.posts" :key="post.id" class="w-full max-w-xl">
                    <CardHeader>
                        <CardTitle>{{ post.user.name }}</CardTitle>
                        <CardDescription>{{ timeAgo(post.created_at) }}</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <Link :href="posts.show(post.id)">
                            <p>{{ post.content }}</p>
                        </Link>
                    </CardContent>
                    <CardFooter>
                        <ButtonGroup>
                            <ButtonGroup>
                                <Button variant="outline">
                                    <ThumbsUpIcon />
                                    {{ post.reactions_count }} reactions
                                </Button>
                                <Button variant="outline">
                                    <MessageSquareText />
                                    {{ post.comments_count }} comments
                                </Button>
                            </ButtonGroup>
                        </ButtonGroup>  
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
