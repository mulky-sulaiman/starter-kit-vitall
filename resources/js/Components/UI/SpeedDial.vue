<script lang="ts" setup>
import { onMounted } from 'vue'
import LanguageSwitcher from './LanguageSwitcher.vue'
import ThemeSwitcher from './ThemeSwitcher.vue'
import ScreenSwitcher from './ScreenSwitcher.vue'
import BackToTop from './BackToTop.vue'

onMounted(() => {
    initFlowbite();
})

</script>

<style></style>
<template>
    <div data-dial-init class="fixed flex end-6 bottom-6 group">
        <div id="speed-dial-menu-horizontal" class="flex items-center hidden space-x-2 me-4 rtl:space-x-reverse">
            <!-- Language Switcher -->
            <LanguageSwitcher />
            <!-- Screen Swicther -->
            <ScreenSwitcher />
            <!-- Theme Switcher -->
            <ThemeSwitcher />
            <!-- Back to Top -->
            <BackToTop />
        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-horizontal" aria-controls="speed-dial-menu-horizontal"
            aria-expanded="false"
            class="flex items-center justify-center w-12 h-12 text-white bg-blue-700 rounded-full animate-pulse hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-7 h-7 transition-transform group-hover:rotate-[180deg]" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            <span class="sr-only">{{ $t('speed-dial.open-actions-menu') }}</span>
        </button>
    </div>
</template>
