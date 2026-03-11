<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
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

type Props = {
    title: string;
    description?: string;
    variant?: 'default' | 'small';
};

withDefaults(defineProps<Props>(), {
    variant: 'default',
});

</script>

<template>
    <FieldGroup>
        <Field>
            <FieldLabel htmlFor="block-end-textarea">{{ title }}</FieldLabel>
            <InputGroup>
            <InputGroupTextarea
                id="block-end-textarea"
                placeholder="Write your {{ title }}..."
            />
            <InputGroupAddon align="block-end">
                <InputGroupText>0/280</InputGroupText>
                <InputGroupButton variant="default" size="sm" className="ml-auto">
                Post
                </InputGroupButton>
            </InputGroupAddon>
            </InputGroup>
            <FieldDescription>
            {{ description }}
            </FieldDescription>
        </Field>
    </FieldGroup>

</template>