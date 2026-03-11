<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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
import { useForm } from '@inertiajs/vue3'
import posts from '@/routes/posts';

interface Post {
    id: number;
    content: string;
}

interface Props {
    post: Post;
}

const props = defineProps<Props>(); 

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Post',
        href: "/posts/{props.post.id}/edit",
    },
];

const form = useForm({
    content: props.post.content
})

const handleSubmit = () => {
    form.put(posts.update(props.post.id).url);
}

</script>

<template>
    <Head title="New Post" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 w-full max-w-xl">
            <!-- Create Post Form -->
            <form @submit.prevent="handleSubmit" class="space-y-4">
                <FieldGroup>
                     <Field>
                        <FieldLabel htmlFor="block-end-textarea">Post Content</FieldLabel>
                        <InputGroup>
                        <InputGroupTextarea
                            v-model="form.content"
                            placeholder="Write your post..."
                        />
                        <InputGroupAddon align="block-end">
                            <InputGroupText>0/280</InputGroupText>
                            <InputGroupButton variant="default" size="sm" className="ml-auto" :disabled="form.processing">
                            Post
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
    </AppLayout>
</template>
