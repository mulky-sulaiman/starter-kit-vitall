<script setup>
import { useForm } from '@inertiajs/vue3'

import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import AuthenticationStatus from '@/Components/AuthenticationStatus.vue'
import FormInput from '@/Components/Form/Input.vue'
import UIButton from '@/Components/UI/Button.vue'
import UITosConsent from '@/Components/UI/TosConsent.vue'
import { Icon } from '@iconify/vue'
import UISpinner from '@/Components/UI/Spinner.vue'


defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    terms: false,
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>

    <Head :title="$t('auth.forgot_password')" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ $t('passwords.forgot_password_title') }}
        </h1>
        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ $t('passwords.forgot_password_sub_title') }}
        </div>

        <div>
            <AuthenticationStatus :status="status" v-if="status" />
            <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                <!-- Email -->
                <div>
                    <FormInput id="email" name="email" type="email" v-model="form.email" required autofocus
                        autocomplete="username" :label="$t('login.email')" :placeholder="$t('login.email_placeholder')"
                        :hint="$t('login.email_hint')" :isRequired="true" :isDirty="form.isDirty && form.email != ''"
                        :hasError="form.errors.email ? true : false" :error="form.errors.email"
                        :isSuccess="status ? true : false" :success="status" />
                </div>
                <!-- Consent ToS & PP -->
                <div>
                    <UITosConsent v-model="form.terms" required :checked="form.terms.length > 0 ? true : false" />
                </div>
                <!-- Submit -->
                <UIButton type="submit" class="w-full" :disabled="form.processing" :isDisabled="form.processing">
                    <Icon icon="tabler:mail" class="w-6 h-6 mr-3" v-if="!form.processing" />
                    <UISpinner class="mr-3 text-white dark:text-white" v-if="form.processing" />
                    <span class="truncate">{{ $t('auth.resend_verify_email') }}</span>
                </UIButton>
            </form>
            <!-- Login Link -->
            <p class="mt-6 text-sm font-light text-gray-500 dark:text-gray-400">
                {{ $t('auth.forgot_password_login_prefix') }}
                <Link :href="route('login')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                {{ $t('auth.forgot_password_login') }}</Link>
            </p>
        </div>
    </AuthenticationCard>

</template>
