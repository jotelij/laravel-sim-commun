<script setup lang="ts">
import AlertContainer from '@/components/AlertContainer.vue';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';


type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Global alert container (mounted once here) -->
        <AlertContainer />
        <slot />
    </AppLayout>
</template>
