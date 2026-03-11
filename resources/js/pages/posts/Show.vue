<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
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
    post: Post;
}

const props = defineProps<Props>(); 

const form = useForm({
    content: null,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
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

            <div class="my-6 space-y-4">
                <Card class="w-full max-w-xl">
                    <CardHeader>
                        <CardTitle>{{ props.post.user.name }}</CardTitle>
                        <CardDescription>{{ new Date(props.post.created_at) }}</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <p>{{ props.post.content }}</p>
                    </CardContent>
                    <CardFooter>
                        <p></p>
                    </CardFooter>
                </Card>
            </div>
            <hr />
            <div class="my-6">
                <h2 class="text-xl font-semibold mb-2">Comments</h2>
                <div class="p-4 w-full max-w-xl">
                    <form  class="space-y-4">
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
            </div>
        </div>
    </AppLayout>
</template>
