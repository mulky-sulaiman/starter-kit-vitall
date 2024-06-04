<x-layouts.main>
    <div class="flex items-center justify-center max-w-lg min-h-screen mx-auto text-black dark:text-white">
        <div class="w-full p-6 tracking-widest text-center uppercase bg-white text-inherit dark:bg-gray-800">
            <p class="flex items-center justify-center mb-2 font-bold text-9xl">
                <x-tabler-brand-javascript class="w-20 h-20" />
            </p>
            <p class="mb-2 text-md">
                {{ __('This site require Javascript') }}</p>
            <p class="text-xs">
                {{ __('Please enable javascript to be able to use our service') }}</p>
        </div>
    </div>
</x-layouts.main>
