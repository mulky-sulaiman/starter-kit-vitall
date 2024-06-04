<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { Icon } from '@iconify/vue'
import { router } from '@inertiajs/vue3'

onMounted(() => {
    initFlowbite();
})

// Confirm Dialog
import { useConfirmDialogStore } from '@/Stores/useConfirmDialogStore'
// import { storeToRefs } from 'pinia'
import { watchEffect } from 'vue'

const confirmDialogStore = useConfirmDialogStore()
// const { isConfirmed, target } = storeToRefs(confirmDialogStore)
const confirmTarget = 'logout-from-switcher'

const confirmDialogParams = {
    type: 'warning',
    size: 'sm',
    headTitle: 'Logout',
    title: 'We are going to log you out',
    message: 'Are you sure you want to logout?',
    labelCancel: 'No, Cancel',
    labelOk: 'Yes, Proceed',
    placement: 'right',
    target: confirmTarget
}

// Setter
const setConfirmDialog = (k) => {
    if (k) confirmDialogParams['key'] = k
    confirmDialogStore.set(confirmDialogParams)
}

// Watcher
watchEffect(() => {
    if (confirmDialogStore.isValidConfirmation(confirmTarget)) {
        logout()
    }
})

// Action
function confirmed() {
    console.log('confirmed')
    alert('confirmed')
}

const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <button type="button" data-dropdown-toggle="apps-dropdown"
        class="p-2 text-gray-500 rounded-lg sm:flex hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
        <span class="sr-only">View notifications</span>

        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
            </path>
        </svg>
    </button>

    <div class="z-20 z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600"
        id="apps-dropdown"
        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1648px, 65px);"
        data-popper-placement="bottom">
        <div
            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            Apps
        </div>
        <div class="grid grid-cols-3 gap-4 p-4">
            <!-- Home -->
            <Link :href="`/`" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
            <Icon icon="tabler:home" class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" />
            <div class="text-sm font-medium text-gray-900 dark:text-white">Home</div>
            </Link>

            <Link :href="route('dashboard')"
                class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
            <Icon icon="tabler:dashboard" class="mx-auto mb-1 text-gray-500 w-7 h-7 dark:text-gray-400" />
            <div class="text-sm font-medium text-gray-900 dark:text-white">Dashboard</div>
            </Link>

            <a href="#" data-drawer-target="confirm-dialog-drawer" data-drawer-toggle="confirm-dialog-drawer"
                data-drawer-placement="right" v-on:click.prevent="setConfirmDialog()"
                class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                <Icon icon="tabler:logout" class="mx-auto mb-1 text-danger-700 w-7 h-7 dark:text-danger-600" />
                <div class="text-sm font-medium text-danger-700 dark:text-danger-600">Logout</div>
            </a>
        </div>
    </div>

</template>
