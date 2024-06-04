<script setup lang="ts">
import { MenuItem } from "@headlessui/vue";

defineOptions({
  inheritAttrs: false,
});

import { initFlowbite } from 'flowbite'

onMounted(() => {
  initFlowbite();
})
</script>

<template>
  <MenuItem v-slot="{ active }">
  <button
    class="block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 transition duration-150 ease-in-out ocus:outline-none"
    :class="[active && 'bg-gray-100']" v-bind="$attrs">
    <slot />
  </button>
  </MenuItem>
</template>
