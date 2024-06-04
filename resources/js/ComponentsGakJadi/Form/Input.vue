<script setup>
import { ref, onMounted } from 'vue'
import { Icon } from '@iconify/vue'

defineProps(['label', 'id', 'name', 'type', 'prefix', 'suffix', 'isRequired', 'isDisabled', 'isReadOnly', 'hint', 'isDirty', 'hasError', 'error', 'modelValue', 'isSuccess', 'success']);
const input = ref(null)
defineEmits(['update:modelValue'])
onMounted(() => {
    // initFlowbite()
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})

defineExpose({ focus: () => input.value.focus() })

let showPassword = ref(false)

const togglePassword = () => {
    showPassword.value = !showPassword.value
};
</script>
<template>
    <template v-if="type != 'password'">
        <div>
            <template v-if="label">
                <!-- Label -->
                <label :for="id ?? ''" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    :class="{ '!text-danger-700 dark:!text-danger-500': hasError, '!text-success-700 dark:!text-success-500': isSuccess, 'required': isRequired }">
                    {{ label }}
                </label>
            </template>
            <!-- Input Block -->
            <div class="relative">
                <div class="relative">
                    <template v-if="prefix">
                        <!-- Prefix -->
                        <div class="absolute inset-y-0 flex items-center start-0 ps-3">
                            {{ prefix }}
                        </div>
                    </template>
                    <!-- Main -->
                    <input ref="input" :id="id ?? ''" :name="name ?? ''" :type="type ?? ''"
                        class="block w-full p-2.5 rounded-lg text-sm border  bg-gray-50 border-gray-300 text-gray-900  focus:ring-primary-500 focus:border-primary-500 dark:!bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        :class="{
                            'cursor-not-allowed': isDisabled || isReadOnly,
                            'ps-10': prefix, 'pe-10': suffix,
                            '!text-danger-900 !placeholder-danger-700  !border-danger-500  !bg-danger-50 focus:!ring-danger-500 dark:!bg-gray-700 focus:!border-danger-500 dark:!text-danger-500 dark:!placeholder-danger-500 dark:!border-danger-500': hasError,
                            'text-warning-900 placeholder-warning-700  border-warning-500  bg-warning-50 focus:!ring-warning-500 dark:bg-gray-700 focus:!border-warning-500 dark:text-warning-500 dark:placeholder-warning-500 dark:border-warning-500': isDirty && !hasError,
                            '!text-success-900 !placeholder-success-700  !border-success-500  !bg-success-50 focus:!ring-success-500 dark:!bg-gray-700 focus:!border-success-500 dark:!text-success-500 dark:!placeholder-success-500 dark:!border-success-500': isSuccess
                        }" v-bind="$attrs" :value="modelValue"
                        @input="$emit('update:modelValue', $event.target.value)" />
                    <template v-if="suffix && !hasError">
                        <!-- Suffix -->
                        <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                            {{ suffix }}
                        </div>
                    </template>
                    <template v-if="isDirty && !suffix && !hasError">
                        <!-- Dirty Suffix -->
                        <div class="absolute inset-y-0 flex items-center justify-center end-0 pe-3">
                            <Icon icon="tabler:alert-triangle" class="w-6 h-6 text-warning-500 dark:text-warning-500" />
                        </div>
                    </template>
                    <template v-if="hasError">
                        <!-- Error Suffix -->
                        <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                            <Icon icon="tabler:x" class="w-6 h-6 text-danger-700 dark:text-danger-500" />
                        </div>
                    </template>
                    <template v-if="isSuccess">
                        <!-- Success Suffix -->
                        <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                            <Icon icon="tabler:check" class="w-6 h-6 text-success-700 dark:text-success-500" />
                        </div>
                    </template>
                </div>
            </div>
            <template v-if="hasError">
                <!-- Validation Message -->
                <p :id="id + '-error'" class="mt-2 text-sm text-justify text-danger-600 dark:text-danger-500">
                    {{ error }}
                </p>
            </template>
            <template v-if="isSuccess">
                <!-- Validation Message -->
                <p :id="id + '-success'" class="mt-2 text-sm text-justify text-emerald-600 dark:text-emerald-500">
                    {{ success }}
                </p>
            </template>
            <template v-if="hint">
                <!-- Hint -->
                <p :id="id + '-hint'" class="mt-2 text-sm text-justify text-gray-500 dark:text-gray-400">
                    {{ hint }}
                </p>
            </template>
        </div>
    </template>
    <template v-else>
        <div>
            <template v-if="label">
                <!-- Label -->
                <label :for="id ?? ''" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    :class="{ '!text-danger-700 dark:!text-danger-500': hasError, '!text-success-700 dark:!text-success-500': isSuccess, 'required': isRequired }">
                    {{ label }}
                </label>
            </template>
            <!-- Input Block -->
            <div class="relative">
                <div class="relative">
                    <template v-if="prefix">
                        <!-- Prefix -->
                        <div class="absolute inset-y-0 flex items-center start-0 ps-3">
                            {{ prefix }}
                        </div>
                    </template>
                    <!-- Main -->
                    <input ref="input" :id="id ?? ''" :name="name ?? ''" :type="showPassword ? 'text' : 'password'"
                        placeholder="••••••••"
                        class="block w-full p-2.5 rounded-lg text-sm border  bg-gray-50 border-gray-300 text-gray-900  focus:ring-primary-500 focus:border-primary-500 dark:!bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        :class="{
                            'cursor-not-allowed': isDisabled || isReadOnly,
                            'ps-10': prefix, 'pe-10': suffix,
                            '!text-danger-900 !placeholder-danger-700  !border-danger-500  !bg-danger-50 focus:!ring-danger-500 dark:!bg-gray-700 focus:!border-danger-500 dark:!text-danger-500 dark:!placeholder-danger-500 dark:!border-danger-500': hasError,
                            'text-warning-900 placeholder-warning-700  border-warning-500  bg-warning-50 focus:!ring-warning-500 dark:bg-gray-700 focus:!border-warning-500 dark:text-warning-500 dark:placeholder-warning-500 dark:border-warning-500': isDirty && !hasError,
                            '!text-success-900 !placeholder-success-700  !border-success-500  !bg-success-50 focus:!ring-success-500 dark:!bg-gray-700 focus:!border-success-500 dark:!text-success-500 dark:!placeholder-success-500 dark:!border-success-500': isSuccess
                        }" v-bind="$attrs" :value="modelValue"
                        @input="$emit('update:modelValue', $event.target.value)" />

                    <!-- Suffix -->
                    <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                        <div class="flex items-center justify-center">
                            <a href="#" role="button" :data-tooltip-target="'tooltip-password-' + id"
                                :title="$t('global.password_tooltip')" @click.prevent="togglePassword()">
                                <Icon icon="tabler:eye"
                                    class="w-6 h-6 text-gray-400 hover:text-gray-500 focus:text-gray-500"
                                    v-if="!showPassword" />
                                <Icon icon="tabler:eye-off"
                                    class="w-6 h-6 text-gray-400 hover:text-gray-500 focus:text-gray-500"
                                    v-if="showPassword" />
                            </a>
                            <div :id="'tooltip-password-' + id" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $t('global.password_tooltip') }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <Icon icon="tabler:alert-triangle"
                                class="w-6 h-6 ml-3 text-warning-500 dark:text-warning-500"
                                v-show="isDirty && !hasError" />
                            <Icon icon="tabler:x" class="w-6 h-6 ml-3 text-danger-700 dark:text-danger-500"
                                v-show="hasError" />
                            <Icon icon="tabler:check" class="w-6 h-6 ml-3 text-success-700 dark:text-success-500"
                                v-show="isSuccess" />
                        </div>
                    </div>
                </div>
            </div>
            <template v-if="hasError">
                <!-- Validation Message -->
                <p :id="id + '-error'" class="mt-2 text-sm text-justify text-danger-600 dark:text-danger-500">
                    {{ error }}
                </p>
            </template>
            <template v-if="isSuccess">
                <!-- Validation Message -->
                <p :id="id + '-error'" class="mt-2 text-sm text-justify text-success-600 dark:text-success-500">
                    {{ success }}
                </p>
            </template>
            <template v-if="hint">
                <!-- Hint -->
                <p :id="id + '-hint'" class="mt-2 text-sm text-justify text-gray-500 dark:text-gray-400">
                    {{ hint }}
                </p>
            </template>
        </div>
    </template>
</template>
