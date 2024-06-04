<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('dashboard');
middleware(['auth']);

new class extends Component {
    public $shew;
    public $shuw;

    public function mount()
    {
        $this->setShew(false);
        $this->setShuw(false);
    }

    public function setShew($v)
    {
        $this->shew = $v;
    }

    public function setShuw($v)
    {
        $this->shuw = $v;
    }
};
?>

<x-layouts.app>
    <x-slot name="head">
        <meta name="description" content="sikintil" />
    </x-slot>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @volt('dashboard')
        <div class="flex flex-col items-stretch flex-1 h-100">
            <div class="flex flex-col items-stretch flex-1 pb-5 mx-auto h-100 min-h-[500px] w-full">
                <div class="relative flex-1 w-full h-100">
                    <div
                        class="flex justify-between items-center w-full h-100 bg-pink- overflow-hidden border border-dashed bg-gradient-to-br from-white to-zinc-50 rounded-lg border-zinc-200 dark:border-gray-700 dark:from-gray-950 dark:via-gray-900 dark:to-gray-800 max-h-[500px]">
                        <div class="relative flex flex-col p-10">
                            <div
                                class="flex items-center pb-5 mb-5 space-x-1.5 text-lg font-bold text-gray-800 uppercase border-b border-dotted border-zinc-200 dark:border-gray-800 dark:text-gray-200">
                                <x-ui.logo class="block w-auto text-gray-800 fill-current h-7 dark:text-gray-200" />
                                <span>Genesis</span>
                            </div>
                            <p class="mb-5 text-sm text-zinc-500 dark:text-gray-400">This is the default dashboard which you
                                can use and customize. Alternatively we also have three dashboard starter templates
                                available.</p>
                            <p class="text-sm text-zinc-500 dark:text-gray-400">You can get all three designs, each with
                                dark mode for only $29. Learn more below.</p>
                            <div class="flex items-center my-6 space-x-3">
                                <x-ui.button
                                    href="https://tonylea.lemonsqueezy.com/checkout/buy/7b997498-2512-4d24-8aa6-6027c5a22922?logo=0"
                                    tag="a" target="_blank" type="primary"><x-phosphor-storefront-duotone
                                        class="w-4 h-4 mr-1" /> Get It Here</x-ui.button>
                                <x-ui.button href="https://www.youtube.com/watch?v=bkdXxmeh0Aw" tag="a"
                                    target="_blank" type="secondary"><x-phosphor-popcorn-duotone
                                        class="w-4 h-4 mr-1" />Video Preview</x-ui.button>
                            </div>
                            <p class="text-sm text-zinc-600 dark:text-gray-300">Thanks for using Genesis ✌️</p>
                        </div>
                        <img src="https://cdn.devdojo.com/images/february2024/dashboards.png" alt="Dashboard"
                            class="object-cover w-2/3 h-full rounded-lg" />
                    </div>
                    <div>
                        <a href="#" wire:click.prevent='setShew(true)'>Open Jet Modal</a>
                        <x-ui.jet-modal wire:model="shew" size="sm">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Terms of Service
                                    </h3>
                                    <button type="button" @click="show=false"
                                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 space-y-4 md:p-5">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        With less than a month to go before the European Union enacts new consumer privacy
                                        laws for its citizens, companies around the world are updating their terms of
                                        service agreements to comply.
                                    </p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect
                                        on May 25 and is meant to ensure a common set of data rights in the European Union.
                                        It requires organizations to notify users as soon as possible of high-risk data
                                        breaches that could personally affect them.
                                    </p>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                                    <button type="button" @click="show=false"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                        accept</button>
                                    <button type="button" @click="show=false"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                </div>
                            </div>
                        </x-ui.jet-modal>
                    </div>

                    <div>
                        <a href="#" wire:click.prevent='setShuw(true)'>Open Jet Drawer</a>
                        <x-ui.jet-drawer wire:model="shuw" placement="right">
                            <!-- Header -->
                            <h5 id="drawer-left-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span>Left drawer</span>
                            </h5>
                            <button type="button" @click="show=false" aria-controls="drawer-left-example"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>
                            <!-- Body -->
                            <div class="min-h-[92vh]">
                                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking
                                    advantage of our <a href="#"
                                        class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time
                                        sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked
                                    candidates and the #1 design job board.</p>
                            </div>
                            <!--Footer -->
                            <div>
                                <div class="grid grid-cols-2 gap-4">
                                    <a href="#" @click="show=false"
                                        class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn
                                        more</a>
                                    <a href="#" @click="show=false"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get
                                        access <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg></a>
                                </div>
                            </div>
                        </x-ui.jet-drawer>
                    </div>

                    <div>
                        <!-- drawer init and toggle -->
                        <div class="text-center">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                                data-drawer-backdrop="true" aria-controls="drawer-example">
                                Show drawer
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-example"
                            class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-label">
                            <h5 id="drawer-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>Info
                            </h5>
                            <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>

                            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking
                                advantage of our <a href="#"
                                    class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time
                                    sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked
                                candidates and the #1 design job board.</p>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="#"
                                    class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn
                                    more</a>
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get
                                    access <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-ui.card title="Test Card">
                            <div id="line-chart" class="w-full p-6 min-h-[30vh]"></div>
                            @script
                                <script>
                                    const options = {
                                        chart: {
                                            height: "100%",
                                            maxWidth: "100%",
                                            type: "line",
                                            fontFamily: "Inter, sans-serif",
                                            dropShadow: {
                                                enabled: false,
                                            },
                                            toolbar: {
                                                show: false,
                                            },
                                        },
                                        tooltip: {
                                            enabled: true,
                                            x: {
                                                show: false,
                                            },
                                        },
                                        dataLabels: {
                                            enabled: false,
                                        },
                                        stroke: {
                                            width: 6,
                                        },
                                        grid: {
                                            show: true,
                                            strokeDashArray: 4,
                                            padding: {
                                                left: 2,
                                                right: 2,
                                                top: -26
                                            },
                                        },
                                        series: [{
                                                name: "Clicks",
                                                data: [6500, 6418, 6456, 6526, 6356, 6456],
                                                color: "#1A56DB",
                                            },
                                            {
                                                name: "CPC",
                                                data: [6456, 6356, 6526, 6332, 6418, 6500],
                                                color: "#7E3AF2",
                                            },
                                        ],
                                        legend: {
                                            show: false
                                        },
                                        stroke: {
                                            curve: 'smooth'
                                        },
                                        xaxis: {
                                            categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
                                            labels: {
                                                show: true,
                                                style: {
                                                    fontFamily: "Inter, sans-serif",
                                                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                                }
                                            },
                                            axisBorder: {
                                                show: false,
                                            },
                                            axisTicks: {
                                                show: false,
                                            },
                                        },
                                        yaxis: {
                                            show: false,
                                        },
                                    }

                                    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
                                        const chart = new ApexCharts(document.getElementById("line-chart"), options);
                                        chart.render();
                                    }
                                </script>
                            @endscript
                            <x-slot name="footer">
                                <a href="#"
                                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-blue-600 uppercase rounded-lg hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                    Traffic analysis
                                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>

                                <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                    data-dropdown-placement="bottom"
                                    class="inline-flex items-center text-sm font-medium text-center text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
                                    type="button">
                                    Last 7 days
                                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="lastDaysdropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                7 days</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                30 days</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                90 days</a>
                                        </li>
                                    </ul>
                                </div>
                            </x-slot>
                        </x-ui.card>
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>
