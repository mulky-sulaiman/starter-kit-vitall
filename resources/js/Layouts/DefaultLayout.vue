<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { Icon } from '@iconify/vue'
import UIConfirmDialog from '@/Components/UI/ConfirmDialog.vue'
import UISpeedDial from '@/Components/UI/SpeedDial.vue'
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div
        class="fixed flex items-center justify-center top-0 left-0 z-50 bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300 uppercase">
        <Icon icon="tabler:brand-inertia" class="w-4 h-4 mr-2" />
        <span>Inertia Mode</span>
    </div>
    <slot />
    <UIConfirmDialog />
    <UISpeedDial />
</template>
