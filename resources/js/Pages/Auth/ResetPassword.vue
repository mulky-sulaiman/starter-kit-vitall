<script setup>
import { useForm } from '@inertiajs/vue3'

import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import FormInput from '@/Components/Form/Input.vue'
import UIButton from '@/Components/UI/Button.vue'
import UITosConsent from '@/Components/UI/TosConsent.vue'
import { Icon } from '@iconify/vue'
import UISpinner from '@/Components/UI/Spinner.vue'

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head :title="$t('passwords.reset_password')" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ $t('passwords.reset_password_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ $t('passwords.reset_password_sub_title') }}
        </div>

        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <!-- Email -->
            <div>
                <FormInput id="email" name="email" type="email" v-model="form.email" required autocomplete="username"
                    :label="$t('register.email')" :placeholder="$t('register.email_placeholder')"
                    :hint="$t('register.email_hint')" :isRequired="true"
                    :isDirty="form.isDirty && form.email != $page.props.email"
                    :hasError="form.errors.email ? true : false" :error="form.errors.email" readonly
                    :isReadOnly="true" />
            </div>
            <!-- Password -->
            <div>
                <FormInput id="password" name="password" type="password" v-model="form.password" required
                    autocomplete="new-password" :label="$t('register.password')" :hint="$t('register.password_hint')"
                    :isRequired="true" :isDirty="form.isDirty && form.password != ''"
                    :hasError="form.errors.password ? true : false" :error="form.errors.password" autofocus />
            </div>
            <!-- Password Confirmation -->
            <div>
                <FormInput id="password_confirmation" name="password_confirmation" type="password"
                    v-model="form.password_confirmation" required autocomplete="new-password"
                    :label="$t('register.password_confirmation')" :hint="$t('register.password_confirmation_hint')"
                    :isRequired="true" :isDirty="form.isDirty && form.password_confirmation != ''"
                    :hasError="form.errors.password_confirmation ? true : false"
                    :error="form.errors.password_confirmation" />
            </div>
            <!-- Consent ToS & PP -->
            <div>
                <UITosConsent v-model="form.terms" required :checked="form.terms.length > 0 ? true : false" />
            </div>
            <!-- Submit -->
            <UIButton type="submit" class="w-full" :disabled="form.processing" :isDisabled="form.processing">
                <Icon icon="tabler:lock-cog" class="w-6 h-6 mr-3" v-if="!form.processing" />
                <UISpinner class="mr-3 text-white dark:text-white" v-if="form.processing" />
                <span class="truncate">{{ $t('passwords.reset_password') }}</span>
            </UIButton>
        </form>
    </AuthenticationCard>
</template>
