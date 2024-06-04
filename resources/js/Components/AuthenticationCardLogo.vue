<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
</script>
<template>
    <Link :href="route('home')"
        class="flex items-center mb-6 text-2xl font-semibold tracking-widest text-gray-900 uppercase dark:text-white">
    <ApplicationLogo class="w-8 h-8 mr-2" fill="currentColor" />
    {{ $t("index.brand") }}
    </Link>
</template>
