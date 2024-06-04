<script setup>
import { useForm } from '@inertiajs/vue3'

import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import FormInput from '@/Components/Form/Input.vue'
import UIButton from '@/Components/UI/Button.vue'
import UITosConsent from '@/Components/UI/TosConsent.vue'
import { Icon } from '@iconify/vue'
import UISpinner from '@/Components/UI/Spinner.vue'

const form = useForm({
    password: '',
    terms: false,
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>

    <Head :title="$t('passwords.confirm_password_title')" />
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-danger-700 md:text-2xl dark:text-danger-600">
            {{ $t('passwords.confirm_password_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-justify text-gray-500 dark:text-gray-400">
            {{ $t('passwords.confirm_password_sub_title') }}
        </div>

        <div class="flex items-center justify-center">
            <div class="items-center justify-center text-center">
                <img class="self-center mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                    src="https://ui-avatars.com/api/?name={{ $page.props.auth.user.name }}&color=7F9CF5&background=EBF4FF"
                    alt="{{  }}">
                <div class="w-full mx-auto mt-4 text-center">
                    <p class="text-lg font-medium text-gray-900 font-base dark:text-white">{{ $page.props.auth.user.name
                        }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-200">{{ $page.props.auth.user.email }}</p>
                </div>
            </div>
        </div>
        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <!-- Password -->
            <div>
                <FormInput id="password" name="password" type="password" v-model="form.password" required
                    autocomplete="current-password" :label="$t('login.password')" :hint="$t('login.password_hint')"
                    :isRequired="true" :isDirty="form.isDirty && form.password != ''"
                    :hasError="form.errors.password ? true : false" :error="form.errors.password" />
            </div>
            <!-- Forgot Password Link-->
            <div class="flex items-center justify-between">
                <Link class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                    href="{{ route('password.request') }}">{{ $t('login.forgot_password') }}</Link>
            </div>
            <!-- Consent ToS & PP -->
            <div>
                <UITosConsent v-model="form.terms" required :checked="form.terms.length > 0 ? true : false" />
            </div>
            <!-- Submit -->
            <UIButton type="submit" class="w-full" :disabled="form.processing" :isDisabled="form.processing">
                <Icon icon="tabler:lock-open" class="w-6 h-6 mr-3" v-if="!form.processing" />
                <UISpinner class="mr-3 text-white dark:text-white" v-if="form.processing" />
                <span class="truncate">{{ $t('auth.resend_verify_email') }}</span>
            </UIButton>
        </form>
    </AuthenticationCard>
</template>
