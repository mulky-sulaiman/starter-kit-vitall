<script setup lang="ts">
import { Icon } from '@iconify/vue'
import { useFullscreen } from '@vueuse/core'

const { isFullscreen, enter, exit, toggle } = useFullscreen()
const el = ref<HTMLElement | null>(null)

</script>
<template>
    <!-- Screen Switcher Trigger -->
    <button ref="el" @click="toggle" id="screen-toggle" data-tooltip-target="tooltip-screen-toggle"
        data-tooltip-placement="top" type="button"
        class="inline-flex justify-center p-2 text-gray-500 bg-white border border-gray-200 rounded-full shadow-sm hover:text-gray-900 dark:border-gray-600 dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
        <Icon icon="tabler:maximize" class="w-5 h-5" v-show="!isFullscreen" />
        <Icon icon="tabler:minimize" class="w-5 h-5" v-show="isFullscreen" />
    </button>
    <!-- Screen Switcher Tooltip -->
    <div id="tooltip-screen-toggle" role="tooltip"
        class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        <span v-text="isFullscreen ? 'Exit Fullscreen' : 'Enter Fullscreen'"></span>
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>
