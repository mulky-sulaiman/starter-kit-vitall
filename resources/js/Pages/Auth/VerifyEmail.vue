<script setup>
import { computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import UIButton from '@/Components/UI/Button.vue'
import { Icon } from '@iconify/vue'
import UISpinner from '@/Components/UI/Spinner.vue'

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');

// Confirm Dialog
import { useConfirmDialogStore } from '@/Stores/useConfirmDialogStore'
// import { storeToRefs } from 'pinia'
import { watchEffect } from 'vue'

const confirmDialogStore = useConfirmDialogStore()
// const { isConfirmed, target } = storeToRefs(confirmDialogStore)
const confirmTarget = 'logout-from-verify'

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

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>

    <Head :title="$t('auth.verify_email')" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ $t('auth.verify_email_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ $t('auth.verify_email_sub_title') }}
        </div>

        <div class="mb-4 text-sm font-medium text-success-600 dark:text-success-400" v-if="verificationLinkSent">
            {{ $t('auth.verification_link_sent') }}
        </div>

        <form @submit.prevent="submit">
            <!-- Submit -->
            <UIButton type="submit" class="w-full" :disabled="form.processing" :isDisabled="form.processing">
                <Icon icon="tabler:login-2" class="w-6 h-6 mr-3" v-if="!form.processing" />
                <UISpinner class="mr-3 text-white dark:text-white" v-if="form.processing" />
                <span class="truncate">{{ $t('auth.resend_verify_email') }}</span>
            </UIButton>

            <div class="flex items-center justify-between mt-4">
                <Link :href="route('profile.edit')"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ $t('auth.edit_profile') }}</Link>
                <a href="{{ route('logout') }}" data-modal-target="confirm-dialog-modal"
                    data-modal-toggle="confirm-dialog-modal" v-on:click.prevent="setConfirmDialog()"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2">
                    {{ $t('auth.logout') }}
                </a>
            </div>
        </form>
    </AuthenticationCard>
</template>
