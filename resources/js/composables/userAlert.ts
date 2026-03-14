import { reactive } from 'vue'

type AlertType = 'success' | 'error' | 'warning' | 'info'

interface Alert {
  id: number
  type: AlertType
  title: string
  message: string
  duration?: number
}

const alerts = reactive<Alert[]>([])
let counter = 0

export function useAlert() {
  function show(type: AlertType, title: string, message: string, duration = 4000) {
    const id = ++counter
    alerts.push({ id, type, title, message, duration })
    if (duration > 0) setTimeout(() => dismiss(id), duration)
  }

  function dismiss(id: number) {
    const index = alerts.findIndex(a => a.id === id)
    if (index !== -1) alerts.splice(index, 1)
  }

  return {
    alerts,
    success: (title: string, message: string, duration?: number) => show('success', title, message, duration),
    error:   (title: string, message: string, duration?: number) => show('error',   title, message, duration),
    warning: (title: string, message: string, duration?: number) => show('warning', title, message, duration),
    info:    (title: string, message: string, duration?: number) => show('info',    title, message, duration),
    dismiss,
  }
}