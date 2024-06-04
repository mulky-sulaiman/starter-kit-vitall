<script setup>
import Checkbox from '@/Components/Checkbox.vue'
import InputLabel from '@/Components/InputLabel.vue'
import { useForm } from '@inertiajs/vue3'

import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import FormInput from '@/Components/Form/Input.vue'
import UIButton from '@/Components/UI/Button.vue'
import { Icon } from '@iconify/vue'
import UISpinner from '@/Components/UI/Spinner.vue'


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>

    <Head :title="$t('login.title')" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 text-sm font-medium text-success-600 dark:text-success-400">
            {{ status }}
        </div>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ $t("login.title") }}
        </h1>

        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <!-- Email -->
            <div>
                <FormInput id="email" name="email" type="email" v-model="form.email" required autofocus
                    autocomplete="username" :label="$t('login.email')" :placeholder="$t('login.email_placeholder')"
                    :hint="$t('login.email_hint')" :isRequired="true" :isDirty="form.isDirty && form.email != ''"
                    :hasError="form.errors.email ? true : false" :error="form.errors.email" />
            </div>
            <!-- Password -->
            <div>
                <FormInput id="password" name="password" type="password" v-model="form.password" required
                    autocomplete="current-password" :label="$t('login.password')" :hint="$t('login.password_hint')"
                    :isRequired="true" :isDirty="form.isDirty && form.password != ''"
                    :hasError="form.errors.password ? true : false" :error="form.errors.password" />
            </div>
            <!-- Remember Me - Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <InputLabel for="remember" class="flex items-center">
                        <Checkbox v-model:checked="form.remember" id="remember" name="remember" />
                        <span class="ml-3 cursor-pointer">{{
                            $t("login.remember_me")
                        }}</span>
                    </InputLabel>
                </div>
                <Link href="forgot-password"
                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                {{ $t("login.forgot_password") }}</Link>
            </div>
            <!-- Submit -->
            <UIButton type="submit" class="w-full" :disabled="form.processing" :isDisabled="form.processing">
                <Icon icon="tabler:login-2" class="w-6 h-6 mr-3" v-if="!form.processing" />
                <UISpinner class="mr-3 text-white dark:text-white" v-if="form.processing" />
                <span>{{ $t("login.login") }}</span>
            </UIButton>
            <!-- Register  -->
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                {{ $t("login.register_prefix") }}
                <Link :href="route('register')"
                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                {{
                    $t("login.register") }}</Link>
            </p>
        </form>
    </AuthenticationCard>
</template>
