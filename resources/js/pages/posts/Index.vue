<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CheckCircle2Icon, ThumbsUpIcon, MessageSquareText  } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, Paginated } from '@/types';
import posts from '@/routes/posts';
import { Button } from '@/components/ui/button';
import { ButtonGroup } from '@/components/ui/button-group';
import {Alert,AlertTitle} from '@/components/ui/alert';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Post } from '@/types/models';
import { timeAgo } from '@/lib/utils';


interface Props {
    posts: Paginated<Post>;
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
            <!-- <div v-if="page.props.flash?.message" class="grid w-full max-w-xl items-start gap-4 m-b-4">
                <!TODO: Move this to a global component and use it for flash messages when creating/updating/deleting posts.>
                <Alert>
                    <CheckCircle2Icon />
                    <AlertTitle>{{ page.props.flash?.message }}</AlertTitle>
                </Alert>
            </div> -->
            <Link :href="posts.create()">
                <Button>Create Post</Button>
            </Link>
            <div class="flex-1 overflow-y-auto p-4 my-4 space-y-4">
                <Card v-for="post in props.posts.data" :key="post.id" class="w-full max-w-xl">
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

            <div class="flex justify-center gap-1 p-3 border-t">
                <Link
                    v-for="link in props.posts.links"
                    :key="link.label"
                    :href="link.url ?? '#'"
                    preserve-scroll preserve-state
                    v-html="link.label"
                    class="px-3 py-1 text-sm rounded-md border border-border hover:bg-muted transition-colors"
                    :class="{
                        'bg-primary text-primary-foreground border-primary': link.active,
                        'opacity-40 pointer-events-none': !link.url
                    }"
                />
            </div>
        </div>
    </AppLayout>
</template>
