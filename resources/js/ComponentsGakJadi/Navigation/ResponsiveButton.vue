<script lang="ts" setup>
import { initFlowbite } from 'flowbite'

onMounted(() => {
  initFlowbite();
})
</script>
<template>
  <button
    class="block w-full py-2 pl-3 pr-4 text-base font-medium leading-5 text-left text-gray-600 transition duration-150 ease-in-out border-l-4 border-transparent focus:outline-none hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300"
    v-bind="$attrs">
    <slot />
  </button>
</template>
