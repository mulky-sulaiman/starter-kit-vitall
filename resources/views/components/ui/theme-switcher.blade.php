<!-- Theme Switcher Trigger -->
<button x-data="{
    darkMode: $persist(false).as('dark_mode'),
    toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        if (document.documentElement.classList.contains('dark')) {
            this.darkMode = true;
            new Audio('/assets/audio/dark.mp3').play()
        } else {
            this.darkMode = false;
            new Audio('/assets/audio/light.mp3').play()
        }
    }
}" @click="toggleDarkMode()" x-init="if (document.documentElement.classList.contains('dark')) { darkMode = true; }" id="theme-toggle"
    data-tooltip-target="tooltip-theme-toggle" data-tooltip-placement="top"
    class="inline-flex justify-center p-2 text-gray-500 bg-white border border-gray-200 rounded-full shadow-sm hover:text-gray-900 dark:border-gray-600 dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
    <template x-if="darkMode">
        <svg id="theme-toggle-dark-icon" class="w-5 h-5 animate-pulse" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
    </template>
    <template x-if="!darkMode">
        <svg id="theme-toggle-light-icon" class="w-5 h-5 animate-pulse" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                fill-rule="evenodd" clip-rule="evenodd"></path>
        </svg>
    </template>
</button>
<!-- Theme Switcher Tooltip -->
<div id="tooltip-theme-toggle" role="tooltip"
    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    {{ __('speed-dial.toggle-dark-mode') }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
