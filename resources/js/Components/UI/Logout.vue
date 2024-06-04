<script lang="ts" setup>
import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { FwbButton } from 'flowbite-vue';
onMounted(() => {
    initFlowbite();
});
const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <div v-if="$page.props.auth.user">
        <div id="logout-modal" data-modal-backdrop="static" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="logout-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 text-center md:p-5">
                        <Icon icon="tabler:hand-stop"
                            class="w-12 h-12 mx-auto mb-4 text-danger-700 dark:text-danger-600" aria-hidden="true" />
                        <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">We are going to log you
                            out</h3>
                        <p class="mb-5 text-base font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            logout?</p>
                        <div class="flex items-center justify-center gap-x-4">
                            <FwbButton color="red" size="md" @click.prevent="logout()" data-modal-hide="logout-modal"
                                class="tracking-widest uppercase">
                                Yes, Proceed
                            </FwbButton>

                            <FwbButton color="alternative" size="md" data-modal-hide="logout-modal"
                                class="tracking-widest uppercase">
                                No, Cancel
                            </FwbButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
