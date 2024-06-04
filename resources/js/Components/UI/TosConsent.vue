<script lang="ts" setup>
import { router } from '@inertiajs/vue3';
import Checkbox from '../Checkbox.vue';
import InputError from '../InputError.vue';
import InputLabel from '../InputLabel.vue';
import { ref } from 'vue';
defineProps(['modelValue', 'errorMessage'])
const input = ref(null);
defineEmits(['update:modelValue']);
</script>
<template>
    <!-- Consent ToS & PP -->
    <div class="mt-4">
        <InputLabel for="terms">
            <div class="flex items-center">
                <Checkbox ref="input" id="terms" v-bind="$attrs" :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)" name="terms" required />

                <div class="cursor-pointer ms-2">
                    {{ $t("register.agree_to_the") }}
                    <a target="_blank" :href="route('home')"
                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800">{{
                            $t("register.tos") }}</a>
                    {{ $t("register.and") }}
                    <a target="_blank" :href="route('home')"
                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800">{{
                            $t("register.privacy_policy") }}</a>
                </div>
            </div>
            <InputError class="mt-2" :message="errorMessage" v-if="errorMessage" />
        </InputLabel>
    </div>
</template>
