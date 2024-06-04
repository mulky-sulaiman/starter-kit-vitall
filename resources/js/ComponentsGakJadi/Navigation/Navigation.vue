<script setup lang="ts">
const { user, logout } = useAuth();
const open = ref(false);
import { Icon } from '@iconify/vue'
</script>

<template>
  <nav class="bg-white border-b border-gray-100">

    <!-- Primary Navigation Menu  -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <!-- Logo  -->
          <div class="flex items-center flex-shrink-0">
            <NuxtLink href="/dashboard">
              <ApplicationLogo class="block w-auto h-10 text-gray-600 fill-current" />
            </NuxtLink>
          </div>

          <!-- Navigation Links  -->
          <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <NavigationLink href="/dashboard"> Dashboard </NavigationLink>
          </div>
        </div>

        <!-- Settings Dropdown  -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
          <Dropdown align="right">
            <template #trigger>
              <button
                class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                <div>{{ user?.name }}</div>

                <div class="ml-1">
                  <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fillRule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clipRule="evenodd" />
                  </svg>
                </div>
              </button>
            </template>
            <!-- Authentication  -->
            <DropdownButton data-modal-target="logout-modal" data-modal-toggle="logout-modal" type="button"
              class="flex items-center">
              <Icon icon="tabler:logout" class="w-5 h-5 mr-2" />
              Log out
            </DropdownButton>
          </Dropdown>

        </div>

        <!-- Hamburger  -->
        <div class="flex items-center -mr-2 sm:hidden">
          <button @click="open = !open"
            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path v-if="open" class="inline-flex" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                d="M6 18L18 6M6 6l12 12" />
              <path v-else class="inline-flex" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Responsive Navigation Menu  -->
    <div v-show="open" class="block sm:hidden">
      <div class="pt-2 pb-3 space-y-1">
        <NavigationResponsiveLink href="/dashboard">
          Dashboard
        </NavigationResponsiveLink>
      </div>

      <!-- Responsive Settings Options  -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <svg class="w-10 h-10 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>

          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">
              {{ user?.name }}
            </div>
            <div v-if="user?.email" class="text-sm font-medium text-gray-500">
              {{ user.email }}
            </div>
          </div>
        </div>

        <div class="mt-3 space-y-1">
          <!-- Authentication  -->
          <NavigationResponsiveButton data-modal-target="logout-modal" data-modal-toggle="logout-modal"
            class="flex items-center">
            <Icon icon="tabler:logout" class="w-5 h-5 mr-2" />
            Log out
          </NavigationResponsiveButton>
        </div>
      </div>
    </div>
  </nav>
</template>
