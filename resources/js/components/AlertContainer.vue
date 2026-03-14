<script setup lang="ts">
import { Alert, AlertTitle, AlertDescription } from '@/components/ui/alert'
import { useAlert } from '@/composables/userAlert'
import { CheckCircle2, XCircle, AlertTriangle, Info, X } from 'lucide-vue-next'


const { alerts, dismiss } = useAlert();

const variantMap = {
  success: 'default',
  error:   'destructive',
  warning: 'default',
  info:    'default',
} as const

const iconMap = {
  success: CheckCircle2,
  error:   XCircle,
  warning: AlertTriangle,
  info:    Info,
}
</script>

<template>
  <Teleport to="body">
    <div class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 w-[380px]">
      <TransitionGroup name="alert">
        <Alert
          v-for="alert in alerts"
          :key="alert.id"
          :variant="variantMap[alert.type]"
          class="shadow-lg pr-10 relative"
        >
          <component :is="iconMap[alert.type]" class="h-4 w-4" />
          <AlertTitle>{{ alert.title }}</AlertTitle>
          <AlertDescription>{{ alert.message }}</AlertDescription>

          <button
            class="absolute top-3 right-3 opacity-60 hover:opacity-100 transition-opacity"
            @click="dismiss(alert.id)"
          >
            <X class="h-4 w-4" />
          </button>
        </Alert>
      </TransitionGroup>
    </div>
  </Teleport>
</template>


<style scoped>
.alert-enter-active,
.alert-leave-active { transition: all 0.35s ease; }
.alert-enter-from   { opacity: 0; transform: translateX(60px); }
.alert-leave-to     { opacity: 0; transform: translateX(60px); }
</style>