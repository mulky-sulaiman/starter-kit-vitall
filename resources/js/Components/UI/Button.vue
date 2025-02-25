<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    title: {
        type: String,
        default: '',
    },
    model: {
        type: String,
        default: 'default',
    },
    variant: {
        type: String,
        default: 'primary',
    },
    size: {
        type: String,
        default: 'lg',
    },
    rounded: {
        type: String,
        default: 'lg',
    },
    isDisabled: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
    <template v-if="model == 'default'">
        <button :type="type" class="font-medium tracking-widest text-center uppercase cursor-pointer" :class="{
            // Size
            'px-3 py-2 text-xs': size == 'xs',
            'px-3 py-2 text-sm': size == 'sm',
            'px-5 py-2.5 text-sm': size == 'md',
            'px-5 py-3 text-base': size == 'lg',
            'px-6 py-3.5 text-base': size == 'xl',
            // Variant
            'text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800': variant == 'primary',
            'text-gray-900 focus:outline-none bg-white border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700': variant == 'alternate',
            'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700': variant == 'dark',
            'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700': variant == 'light',
            'focus:outline-none text-white bg-success-700 hover:bg-success-800 focus:ring-4 focus:ring-success-300 dark:bg-success-600 dark:hover:bg-success-700 dark:focus:ring-success-800': variant == 'success',
            'focus:outline-none text-white bg-danger-700 hover:bg-danger-800 focus:ring-4 focus:ring-danger-300 dark:bg-danger-600 dark:hover:bg-danger-700 dark:focus:ring-danger-900': variant == 'danger',
            'focus:outline-none text-white bg-warning-400 hover:bg-warning-500 focus:ring-4 focus:ring-warning-300 dark:focus:ring-warning-900': variant == 'warning',
            'focus:outline-none text-white bg-info-700 hover:bg-info-800 focus:ring-4 focus:ring-info-300 dark:bg-info-600 dark:hover:bg-info-700 dark:focus:ring-info-900': variant == 'info',
            // Rounded
            'rounded-none': rounded == 'none',
            'rounded': rounded == 'sm',
            'rounded-md': rounded == 'md',
            'rounded-lg': rounded == 'lg',
            'rounded-full': rounded == 'full',
            // Disabled
            '!cursor-not-allowed !opacity-50': isDisabled,
        }" v-bind="$attrs">
            <template v-if="title != ''">
                <span>{{ title }}</span>
            </template>
            <template v-else>
                <div class="flex items-center justify-center">
                    <slot />
                </div>
            </template>
        </button>
    </template>
    <template v-if="model == 'outline'">
        <button :type="type" class="font-medium tracking-widest text-center uppercase cursor-pointer" :class="{
            // Size
            'px-3 py-2 text-xs': size == 'xs',
            'px-3 py-2 text-sm': size == 'sm',
            'px-5 py-2.5 text-sm': size == 'md',
            'px-5 py-3 text-base': size == 'lg',
            'px-6 py-3.5 text-base': size == 'xl',
            // Variant
            'text-primary-700 hover:text-white border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:border-primary-500 dark:text-primary-500 dark:hover:text-white dark:hover:bg-primary-500 dark:focus:ring-primary-800': variant == 'primary',
            'text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800': variant == 'dark',
            'text-success-700 hover:text-white border border-success-700 hover:bg-success-800 focus:ring-4 focus:outline-none focus:ring-success-300 dark:border-success-500 dark:text-success-500 dark:hover:text-white dark:hover:bg-success-600 dark:focus:ring-success-800': variant == 'success',
            'text-danger-700 hover:text-white border border-danger-700 hover:bg-danger-800 focus:ring-4 focus:outline-none focus:ring-danger-300 dark:border-danger-500 dark:text-danger-500 dark:hover:text-white dark:hover:bg-danger-600 dark:focus:ring-danger-900': variant == 'danger',
            'text-warning-400 hover:text-white border border-warning-400 hover:bg-warning-500 focus:ring-4 focus:outline-none focus:ring-warning-300 dark:border-warning-300 dark:text-warning-300 dark:hover:text-white dark:hover:bg-warning-400 dark:focus:ring-warning-900': variant == 'warning',
            'text-info-700 hover:text-white border border-info-700 hover:bg-info-800 focus:ring-4 focus:outline-none focus:ring-info-300 dark:border-info-400 dark:text-info-400 dark:hover:text-white dark:hover:bg-info-500 dark:focus:ring-info-900': variant == 'info',
            // Rounded
            'rounded-none': rounded == 'none',
            'rounded': rounded == 'sm',
            'rounded-md': rounded == 'md',
            'rounded-lg': rounded == 'lg',
            'rounded-full': rounded == 'full',
            // Disabled
            '!cursor-not-allowed !opacity-50': isDisabled,
        }" v-bind="$attrs">
            <template v-if="title != ''">
                <span>{{ title }}</span>
            </template>
            <template v-else>
                <div class="flex items-center justify-center">
                    <slot />
                </div>
            </template>
        </button>
    </template>
</template>
