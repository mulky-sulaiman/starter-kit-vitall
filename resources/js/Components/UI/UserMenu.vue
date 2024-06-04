<script setup>
import { onMounted, ref } from 'vue'
import { initFlowbite } from 'flowbite'
import { router } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'

onMounted(() => {
    initFlowbite();
});

// const switchToTeam = (team) => {
//     router.put(route('current-team.update'), {
//         team_id: team.id,
//     }, {
//         preserveState: false,
//     });
// };

// Confirm Dialog
import { useConfirmDialogStore } from '@/Stores/useConfirmDialogStore'
// import { storeToRefs } from 'pinia'
import { watchEffect } from 'vue'

const confirmDialogStore = useConfirmDialogStore()
// const { isConfirmed, target } = storeToRefs(confirmDialogStore)
const confirmTarget = 'logout-from-menu'

const confirmDialogParams = {
    type: 'warning',
    size: 'sm',
    headTitle: 'Logout',
    title: 'We are going to log you out',
    message: 'Are you sure you want to logout?',
    labelCancel: 'No, Cancel',
    labelOk: 'Yes, Proceed',
    // placement: 'right',
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
    <!-- User Menu Dropdown Trigger -->
    <button type="button"
        class="flex flex-shrink-0 mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        id="userMenuDropdownButton" aria-expanded="false" data-dropdown-toggle="userMenuDropdown">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" :src="$page.props.auth.user.profile_photo_url" alt="user photo">
    </button>
    <!-- User Menu Dropdown Content -->
    <div class="z-50 hidden w-56 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="userMenuDropdown"
        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1638px, 58px);"
        data-popper-placement="bottom">
        <div class="px-4 py-3">
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $page.props.auth.user.name
                }}</span>
            <span class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">{{
                $page.props.auth.user.email }}</span>
        </div>

        <!-- Account Settings -->
        <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="userMenuDropdownButton">
            <li>
                <p class="block px-4 py-2 text-xs font-light text-gray-500 uppercase truncate dark:text-gray-400">
                    Account Settings
                </p>
            </li>
            <li>
                <Link :href="route('profile.edit')"
                    class="flex items-center px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <Icon icon="tabler:user-cog" class="w-5 h-5 mr-2 text-gray-400" />
                Profile
                </Link>
            </li>
        </ul>
        <!-- Logout -->
        <ul class="py-1 font-light text-danger-700 dark:text-danger-600" aria-labelledby="dropdown">
            <li>
                <a href="#" data-modal-target="confirm-dialog-modal" data-modal-toggle="confirm-dialog-modal"
                    v-on:click.prevent="setConfirmDialog()"
                    class="flex items-center px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <Icon icon="tabler:logout" class="w-5 h-5 mr-2" />
                    Log out
                </a>
            </li>
        </ul>
    </div>
</template>
