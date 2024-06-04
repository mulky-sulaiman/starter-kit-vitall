<script lang="ts" setup>
defineProps({
    value: String,
    required: Boolean,
});
// block text-sm font-medium text-gray-700 dark:text-gray-300
</script>

<template>
    <label class="block text-sm font-medium text-gray-900 dark:text-white" :class="{ 'required': required }">
        <template v-if="value">{{ value }}</template>
        <template v-else>
            <slot />
        </template>
    </label>
</template>
