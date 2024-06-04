<script setup>
import { Icon } from '@iconify/vue'
import UIButton from '@/Components/UI/Button.vue'
import { useConfirmDialogStore } from '@/Stores/useConfirmDialogStore'
const confirmDialogStore = useConfirmDialogStore()

const setValidConfirm = () => {
    if (confirmDialogStore.target != null) {
        confirmDialogStore.isConfirmed = true
    }
}

</script>
<template>
    <!-- Confirm Dialog Modal -->
    <div id="confirm-dialog-modal" data-modal-backdrop="static" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-h-full p-4" v-bind:class="{
            'max-w-md': confirmDialogStore.size === 'sm',
            'max-w-lg': confirmDialogStore.size === 'md',
            'max-w-4xl': confirmDialogStore.size === 'lg',
            'max-w-7xl': confirmDialogStore.size === 'xl',
        }">
            <div class="relative bg-white border-t-4 rounded-lg shadow dark:bg-gray-700" :class="{
                'border-warning-600 dark:border-warning-500': confirmDialogStore.type === 'warning',
                'border-success-500 dark:border-success-400': confirmDialogStore.type === 'success',
                'border-danger-700 dark:border-danger-600': confirmDialogStore.type === 'danger',
                'border-info-500 dark:border-info-400': confirmDialogStore.type === 'info',
            }">
                <!-- Header -->
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="confirm-dialog-modal" v-on:click="confirmDialogStore.$reset">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <!-- Content -->
                <div class="p-4 text-center md:p-5">
                    <!-- Body -->
                    <h2 class="mb-5 text-xl font-medium tracking-widest uppercase" v-bind:class="{
                        'text-warning-600 dark:text-warning-500': confirmDialogStore.type === 'warning',
                        'text-success-500 dark:text-success-400': confirmDialogStore.type === 'success',
                        'text-danger-700 dark:text-danger-600': confirmDialogStore.type === 'danger',
                        'text-info-500 dark:text-info-400': confirmDialogStore.type === 'info',
                    }" v-text="confirmDialogStore.headTitle" v-show="confirmDialogStore.headTitle != ''"></h2>
                    <span v-show="confirmDialogStore.useIcon" class="animate-pulse">
                        <Icon icon="tabler:alert-square-rounded"
                            class="w-12 h-12 mx-auto mb-4 text-warning-600 dark:text-warning-500" aria-hidden="true"
                            v-show="confirmDialogStore.type === 'warning'" />
                        <Icon icon="tabler:square-rounded-check"
                            class="w-12 h-12 mx-auto mb-4 text-success-500 dark:text-success-400" aria-hidden="true"
                            v-show="confirmDialogStore.type === 'success'" />
                        <Icon icon="tabler:square-rounded-x"
                            class="w-12 h-12 mx-auto mb-4 text-danger-700 dark:text-danger-600" aria-hidden="true"
                            v-show="confirmDialogStore.type === 'danger'" />
                        <Icon icon="tabler:info-square-rounded"
                            class="w-12 h-12 mx-auto mb-4 text-info-500 dark:text-info-400" aria-hidden="true"
                            v-show="confirmDialogStore.type === 'info'" />
                    </span>
                    <div class="flex-row mb-5 gap-y-2">
                        <h3 class="text-lg font-normal" v-bind:class="{
                            'text-warning-600 dark:text-warning-500': confirmDialogStore.type === 'warning',
                            'text-success-500 dark:text-success-400': confirmDialogStore.type === 'success',
                            'text-danger-700 dark:text-danger-600': confirmDialogStore.type === 'danger',
                            'text-info-500 dark:text-info-400': confirmDialogStore.type === 'info',
                        }" v-text="confirmDialogStore.title" v-show="confirmDialogStore.title != ''"></h3>
                        <p class="text-gray-500 dark:text-gray-400" v-text="confirmDialogStore.message"
                            v-show="confirmDialogStore.message != ''"></p>
                    </div>
                    <!-- Footer -->
                    <div class="flex items-center justify-center gap-x-3">
                        <span v-show="confirmDialogStore.useCancel" class="w-full"
                            v-on:click="confirmDialogStore.$reset">
                            <UIButton size="sm" class="w-full" type="button" variant="light"
                                data-modal-hide="confirm-dialog-modal">
                                <span v-text="confirmDialogStore.labelCancel" class="truncate"></span>
                            </UIButton>
                        </span>
                        <span v-show="confirmDialogStore.useOk" class="w-full" v-on:click="confirmDialogStore.$reset">
                            <UIButton size="sm" class="w-full" type="button" :variant="confirmDialogStore.type"
                                data-modal-hide="confirm-dialog-modal" v-on:click="setValidConfirm()">
                                <span v-text="confirmDialogStore.labelOk" class="truncate"></span>
                            </UIButton>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirm Dialog Drawer top-0 left-0 transition-transform -translate-x-full -->
    <div id="confirm-dialog-drawer" data-drawer-backdrop="true"
        class="top-0 right-0 transition-transform -translate-x-full" v-bind:class="{
            // 'top-0 left-0 right-0 transition-transform -translate-y-full': confirmDialogStore.placement === 'top',
            // 'top-0 right-0 transition-transform -translate-x-full': confirmDialogStore.placement === 'right',
            // 'bottom-0 left-0 right-0 transition-transform': confirmDialogStore.placement === 'bottom',
            // 'top-0 left-0 transition-transform -translate-x-full': confirmDialogStore.placement === 'left',
            'fixed top-0 left-0 right-0 z-40 w-full p-4 transition-transform -translate-y-full bg-white dark:bg-gray-800': confirmDialogStore.placement ===
                'top',
            'fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800': confirmDialogStore.placement ===
                'right',
            'fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800 transform-none': confirmDialogStore.placement ===
                'bottom',
            'fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800': confirmDialogStore.placement ===
                'left',
            'border-t-4 border-warning-500 dark:border-warning-400': confirmDialogStore.type === 'warning',
            'border-t-4 border-success-500 dark:border-success-400': confirmDialogStore.type === 'success',
            'border-t-4 border-danger-700 dark:border-danger-600': confirmDialogStore.type === 'danger',
            'border-t-4 border-info-500 dark:border-info-400': confirmDialogStore.type === 'info',
        }" tabindex="-1" aria-labelledby="drawer-label">
        <!-- Header -->
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold tracking-widest uppercase"
            v-bind:class="{
                'text-warning-500 dark:text-warning-400': confirmDialogStore.type === 'warning',
                'text-success-500 dark:text-success-400': confirmDialogStore.type === 'success',
                'text-danger-700 dark:text-danger-600': confirmDialogStore.type === 'danger',
                'text-info-500 dark:text-info-400': confirmDialogStore.type === 'info',
            }" v-text="confirmDialogStore.headTitle" v-show="confirmDialogStore.headTitle != ''">
        </h5>
        <button type="button" data-drawer-hide="confirm-dialog-drawer"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
            v-on:click="confirmDialogStore.$reset">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <!-- Body {md:min-h-[92vh]} -->
        <div v-bind:class="{ '': confirmDialogStore.placement === 'left' || confirmDialogStore.placement === 'right' }">
            <span v-show="confirmDialogStore.useIcon" class="animate-pulse">
                <Icon icon="tabler:alert-square-rounded"
                    class="w-12 h-12 mx-auto mb-4 text-warning-500 dark:text-warning-400" aria-hidden="true"
                    v-show="confirmDialogStore.type === 'warning'" />
                <Icon icon="tabler:square-rounded-check"
                    class="w-12 h-12 mx-auto mb-4 text-success-500 dark:text-success-400" aria-hidden="true"
                    v-show="confirmDialogStore.type === 'success'" />
                <Icon icon="tabler:square-rounded-x" class="w-12 h-12 mx-auto mb-4 text-danger-700 dark:text-danger-600"
                    aria-hidden="true" v-show="confirmDialogStore.type === 'danger'" />
                <Icon icon="tabler:info-square-rounded" class="w-12 h-12 mx-auto mb-4 text-info-500 dark:text-info-400"
                    aria-hidden="true" v-show="confirmDialogStore.type === 'info'" />
            </span>
            <div class="flex-row items-center mb-5 text-center gap-y-2">
                <h3 class="text-lg font-normal" v-bind:class="{
                    'text-warning-500 dark:text-warning-400': confirmDialogStore.type === 'warning',
                    'text-success-500 dark:text-success-400': confirmDialogStore.type === 'success',
                    'text-danger-700 dark:text-danger-600': confirmDialogStore.type === 'danger',
                    'text-info-500 dark:text-info-400': confirmDialogStore.type === 'info',
                }" v-text="confirmDialogStore.title" v-show="confirmDialogStore.title != ''"></h3>
                <p class="text-gray-500 dark:text-gray-400" v-text="confirmDialogStore.message"
                    v-show="confirmDialogStore.message != ''"></p>
            </div>
        </div>
        <!-- Footer -->
        <div class="flex items-center justify-center gap-x-3">
            <span v-show="confirmDialogStore.useCancel" class="w-full" v-on:click="confirmDialogStore.$reset">
                <UIButton size="sm" class="w-full" type="button" variant="light"
                    data-drawer-hide="confirm-dialog-drawer">
                    <span v-text="confirmDialogStore.labelCancel" class="truncate"></span>
                </UIButton>
            </span>
            <span v-show="confirmDialogStore.useOk" class="w-full" v-on:click="confirmDialogStore.$reset">
                <UIButton size="sm" class="w-full" type="button" :variant="confirmDialogStore.type"
                    data-drawer-hide="confirm-dialog-drawer" v-on:click="setValidConfirm()">
                    <span v-text="confirmDialogStore.labelOk" class="truncate"></span>
                </UIButton>
            </span>
        </div>
    </div>
</template>
<style></style>
