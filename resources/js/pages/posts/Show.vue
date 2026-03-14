<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { ThumbsUpIcon, MessageSquareText  } from 'lucide-vue-next';
import {
  Field,
  FieldDescription,
  FieldGroup,
  FieldLabel,
} from "@/components/ui/field";
import {
  InputGroup,
  InputGroupAddon,
  InputGroupButton,
  InputGroupText,
  InputGroupTextarea,
} from "@/components/ui/input-group";
import posts from '@/routes/posts';
import { Button } from '@/components/ui/button';
import { ButtonGroup } from '@/components/ui/button-group';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Post } from '@/types/models';
import { timeAgo } from '@/lib/utils';

interface Props {
    post: Post;
}

const props = defineProps<Props>(); 

const form = useForm({
    content: null,
});

const handleSubmit = () => {
    form.post(posts.comments.store(props.post.id).url);
    form.reset();
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Read Post',
        href: "/posts/{props.post.id}",
    },
];

</script>

<template>
    <Head title="Post" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            
            <Link :href="posts.edit(props.post.id)">
                <Button>Edit Post</Button>
            </Link>
            
            <!-- show the post in a card, with the user's name as the title, the created_at as the description, and the content as the content. Then show the comments below, with the same format but without the footer. -->
            <div class="my-6 space-y-4 w-full max-w-xl">
                <CardHeader>
                    <CardTitle>{{ props.post.user.name }}</CardTitle>
                    <CardDescription>{{ timeAgo(props.post.created_at) }}</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>{{ props.post.content }}</p>
                </CardContent>
                <CardFooter>
                    <ButtonGroup>
                        <ButtonGroup>
                            <Button variant="outline">
                                <ThumbsUpIcon />
                                {{ props.post.reactions_count }} reactions
                            </Button>
                            <Button variant="outline">
                                <MessageSquareText />
                                {{ props.post.comments_count }} comments
                            </Button>
                        </ButtonGroup>
                    </ButtonGroup>  
                </CardFooter>
            </div>

            <hr />

            <div class="my-6">
                <h2 class="text-xl font-semibold mb-2">Comments</h2>
                <div class="p-4 w-full max-w-xl">
                    <form  @submit.prevent="handleSubmit" class="space-y-4">
                        <FieldGroup>
                            <Field>
                                <FieldLabel htmlFor="block-end-textarea">Write your comment</FieldLabel>
                                <InputGroup>
                                <InputGroupTextarea
                                    v-model="form.content"
                                    placeholder="Comment..."
                                />
                                <InputGroupAddon align="block-end">
                                    <InputGroupText>0/280</InputGroupText>
                                    <InputGroupButton variant="default" size="sm" className="ml-auto" :disabled="form.processing">
                                    Comment
                                    </InputGroupButton>
                                </InputGroupAddon>
                                </InputGroup>
                                
                                <FieldDescription v-if="form.errors.content">
                                    {{ form.errors.content }} 
                                </FieldDescription>
                            </Field>
                        </FieldGroup>
                    </form>
                </div>

                <!-- list the comments here, maybe in a card like the post, but smaller and without the footer. -->
                <div class="space-y-4">
                    <Card v-for="comment in props.post.comments" :key="comment.id" class="w-full max-w-xl">
                        <CardHeader>
                            <CardTitle>{{ comment.user.name }}</CardTitle>
                            <CardDescription>{{ timeAgo(comment.created_at) }}</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <p>{{ comment.content }}</p>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
