<button title="Side navigation" type="button"
    class="fixed z-40 self-center order-10 visible block w-10 h-10 bg-white rounded opacity-100 lg:hidden left-6 top-6"
    aria-haspopup="menu" aria-label="Side navigation" aria-expanded="false" aria-controls="nav-menu-1">
    <div class="absolute w-6 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <span aria-hidden="true"
            class="absolute block h-0.5 w-9/12 -translate-y-2 transform rounded-full bg-slate-700 transition-all duration-300"></span>
        <span aria-hidden="true"
            class="absolute block h-0.5 w-6 transform rounded-full bg-slate-900 transition duration-300"></span>
        <span aria-hidden="true"
            class="absolute block h-0.5 w-1/2 origin-top-left translate-y-2 transform rounded-full bg-slate-900 transition-all duration-300"></span>
    </div>
</button>

<aside id="nav-menu-1" aria-label="Side navigation"
    class="fixed top-0 bottom-0 left-0 z-40 flex flex-col transition-transform -translate-x-full bg-white border-r w-72 sm:translate-x-0 border-r-slate-200">
    <div class="flex flex-col items-center gap-4 p-6 border-b border-slate-200">
        <div class="shrink-0">
            <a href="{{ route('admin.profile') }}" class="relative flex items-center justify-center w-12 h-12 text-white rounded-full">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=128" alt="user name" title="user name" width="48"
                    height="48" class="max-w-full rounded-full" />
                <span
                    class="absolute bottom-0 right-0 inline-flex items-center justify-center gap-1 p-1 text-sm text-white border-2 border-white rounded-full bg-emerald-500"><span
                        class="sr-only"> online </span></span>
            </a>
        </div>
        <div class="flex flex-col gap-0 min-h-[2rem] items-start justify-center w-full min-w-0 text-center">
            <h4 class="w-full text-base truncate text-slate-700">{{ Auth::user()->name }}</h4>
            <p class="w-full text-sm truncate text-slate-500">{{ Auth::user()->email }}</p>
        </div>
    </div>
    <nav aria-label="side navigation" class="flex-1 overflow-auto divide-y divide-slate-100">
        <div>
            <ul class="flex flex-col flex-1 gap-1 py-3">
                <li class="px-3">
                    <a href="{{ route('borrows.index') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('dashboard*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{ request()->is('dashboard*') ? 'text-indigo-500' : '' }}" aria-label="Dashboard icon"
                                role="graphics-symbol">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('dashboard*') ? 'text-indigo-500' : '' }}">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li class="px-3">
                    <a href="{{ route('students.index') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('students*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ request()->is('students*') ? 'text-indigo-500' : '' }}" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M5.5 8a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0ZM8 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8Zm7.5 5a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0ZM17 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6Zm-2.752 13.038c.703.285 1.604.462 2.753.462c2.282 0 3.586-.697 4.297-1.558c.345-.418.52-.84.61-1.163a2.728 2.728 0 0 0 .093-.573v-.027A2.179 2.179 0 0 0 19.822 14H14.18c-.028 0-.055 0-.082.002c.394.41.68.925.816 1.498h4.908c.372 0 .674.299.679.669a1.236 1.236 0 0 1-.04.212a1.6 1.6 0 0 1-.32.605c-.35.426-1.172 1.014-3.14 1.014c-.98 0-1.676-.146-2.17-.345c-.108.4-.286.883-.583 1.383ZM4.25 14A2.25 2.25 0 0 0 2 16.25v.278a2.073 2.073 0 0 0 .014.208a4.487 4.487 0 0 0 .778 2.07C3.61 19.974 5.172 21 8 21c2.828 0 4.39-1.025 5.208-2.195a4.484 4.484 0 0 0 .778-2.07a2.992 2.992 0 0 0 .014-.207v-.278A2.25 2.25 0 0 0 11.75 14h-7.5Zm-.75 2.507v-.257a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 .75.75v.257l-.007.08a2.986 2.986 0 0 1-.514 1.358C11.486 18.65 10.422 19.5 8 19.5s-3.486-.85-3.98-1.555a2.986 2.986 0 0 1-.513-1.358a1.527 1.527 0 0 1-.007-.08Z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('students*') ? 'text-indigo-500' : '' }}">
                            Siswa
                        </div>
                        {{-- <span
                            class="inline-flex items-center justify-center px-2 text-xs text-pink-500 bg-pink-100 rounded-full ">
                            2
                            <span class="sr-only"> new notifications</span>
                        </span> --}}
                    </a>
                </li>
                <li class="px-3">
                    <a href="{{ route('items.index') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('items*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ request()->is('items*') ? 'text-indigo-500' : '' }}" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="m5.25 2.75l-.563.531l-1.406 1.406l-.531.563l.406.656l2.094 3.5l.281.5H8.47l4 3.969c-3.574 3.59-8.121 8.152-8.281 8.313c-1.567 1.566-1.57 4.132.03 5.625c1.563 1.542 4.11 1.582 5.595 0l.03-.032L16 21.594l6.188 6.218l.093.063c1.57 1.48 4.067 1.5 5.532-.063v-.03h.03c1.532-1.567 1.548-4.114-.03-5.595l-.032-.03l-5.218-5.188c3.511-.328 6.261-3.293 6.312-6.875h.031c.004-.02 0-.043 0-.063V10c.098-1.156-.152-2.262-.75-3.219L27.47 5.72l-4.657 4.656l-1.406-1.469l4.75-4.75l-1.375-.562A7.03 7.03 0 0 0 22 3c-3.844 0-7 3.156-7 7c0 .418.09.781.156 1.156c-.437.438-.765.797-1.281 1.313L9.906 8.5V5.531l-.5-.281l-3.5-2.094zM22 5c.14 0 .238.082.375.094l-3.781 3.781l.687.719l2.813 2.906l.687.719L26.75 9.25c.02.23.184.398.156.656V10c0 2.754-2.246 5-5 5c-.367 0-.812-.086-1.312-.188l-.532-.093l-.375.375l-11.28 11.312h-.032v.032c-.71.777-1.953.796-2.781-.032v-.031h-.032c-.777-.71-.796-1.953.032-2.781c.379-.38 7.718-7.782 11.312-11.375l.407-.406l-.157-.563A6.113 6.113 0 0 1 17 10c0-2.754 2.246-5 5-5zm-16.438.25l2.344 1.438v1l-.218.218h-1L5.25 5.563zm14.625 12.156l6.22 6.188v.031h.03c.778.71.797 1.953-.03 2.781h-.032v.032c-.71.777-1.953.796-2.781-.032l-6.188-6.218z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('items*') ? 'text-indigo-500' : '' }}">
                            Alat-alat
                        </div>
                    </a>
                </li>
                <li class="px-3">
                    <a href="{{ route('borrows.form') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('borrows/form*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ request()->is('borrows/form*') ? 'text-indigo-500' : '' }}" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M13.442 4.052a1.866 1.866 0 1 1 3.733 0a1.866 1.866 0 0 1-3.733 0m1.867-.366a.366.366 0 1 0 0 .732a.366.366 0 0 0 0-.732m6.295 7.58a1.58 1.58 0 0 0-2.177-.182l-2.606 2.113a1.79 1.79 0 0 0-1.548-.893h-2.598c-1.163-.425-2.449-.497-3.262-.493c-.772.004-1.472.309-2.025.751l-1.693 1.353a.75.75 0 0 0-.743.004l-2.577 1.487a.75.75 0 0 0-.274 1.025l2.998 5.194a.75.75 0 0 0 1.025.274L8.7 20.411a.75.75 0 0 0 .34-.876l.525-.475a.75.75 0 0 1 .504-.194h6.173c.6 0 1.168-.273 1.544-.741l3.866-4.83a1.58 1.58 0 0 0-.048-2.03M8.286 18.194l-1.75-3.031l1.788-1.43c.341-.272.722-.42 1.096-.422c.769-.003 1.876.072 2.802.425q.173.066.37.068h2.681a.288.288 0 0 1 .227.465l-.073.059l-.025.02a.3.3 0 0 1-.129.031h-2.735a.75.75 0 0 0 0 1.5h2.735a1.78 1.78 0 0 0 1.247-.507l3.852-3.123a.078.078 0 0 1 .11.11l-3.867 4.828a.48.48 0 0 1-.373.18h-6.174a2.25 2.25 0 0 0-1.51.58zm-2.263 2.031L3.775 16.33l1.277-.737l2.249 3.894zm8.071-13.946a2.24 2.24 0 0 0-2.238 2.238v.93c0 .414.336.75.75.75h5.405a.75.75 0 0 0 .75-.75v-.93a2.24 2.24 0 0 0-2.238-2.238zm-.738 2.238c0-.408.33-.738.738-.738h2.429c.407 0 .738.33.738.738v.18h-3.905z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('borrows/form*') ? 'text-indigo-500' : '' }}">
                            Peminjaman
                        </div>
                    </a>
                </li>
                <li class="px-3">
                    <a href="{{ route('whatsapp-histories.index') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('whatsapp-histories*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ request()->is('whatsapp-histories*') ? 'text-indigo-500' : '' }}" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M5.694 11.753L2.299 3.024c-.236-.607.356-1.188.942-.981l.093.039l18 9a.75.75 0 0 1 .097 1.284l-.097.057l-1.308.654a3.5 3.5 0 0 0-1.503-.925l.798-.4L4.402 4.294l2.61 6.709h6.627a.75.75 0 0 1 .743.649l.007.102a.75.75 0 0 1-.649.743l-.101.007l-6.628-.001l-2.609 6.71l9.806-4.903a3.5 3.5 0 0 0-.162 1.758L3.334 21.423c-.583.292-1.217-.244-1.065-.847l.03-.095zM20 15.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0m2 5.375C22 22.431 20.714 24 17.5 24S13 22.437 13 20.875v-.103c0-.98.794-1.772 1.773-1.772h5.454c.98 0 1.773.793 1.773 1.772z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('whatsapp-histories*') ? 'text-indigo-500' : '' }}">
                            History WhatsApp
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <ul class="flex flex-col flex-1 gap-1 py-3">
                <li class="px-3">
                    <a href="{{ route('admin.profile') }}"
                        class="flex items-center gap-3 p-3 transition-colors rounded text-slate-700 hover:text-indigo-500 hover:bg-indigo-50 focus:bg-indigo-50 aria-[current=page]:text-indigo-500 aria-[current=page]:bg-indigo-50 {{ request()->is('profile*') ? 'bg-indigo-50' : '' }}">
                        <div class="flex items-center self-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ request()->is('profile*') ? 'text-indigo-500' : '' }}" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M128 80a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Zm109.94-52.79a8 8 0 0 0-3.89-5.4l-29.83-17l-.12-33.62a8 8 0 0 0-2.83-6.08a111.91 111.91 0 0 0-36.72-20.67a8 8 0 0 0-6.46.59L128 41.85L97.88 25a8 8 0 0 0-6.47-.6a112.1 112.1 0 0 0-36.68 20.75a8 8 0 0 0-2.83 6.07l-.15 33.65l-29.83 17a8 8 0 0 0-3.89 5.4a106.47 106.47 0 0 0 0 41.56a8 8 0 0 0 3.89 5.4l29.83 17l.12 33.62a8 8 0 0 0 2.83 6.08a111.91 111.91 0 0 0 36.72 20.67a8 8 0 0 0 6.46-.59L128 214.15L158.12 231a7.91 7.91 0 0 0 3.9 1a8.09 8.09 0 0 0 2.57-.42a112.1 112.1 0 0 0 36.68-20.73a8 8 0 0 0 2.83-6.07l.15-33.65l29.83-17a8 8 0 0 0 3.89-5.4a106.47 106.47 0 0 0-.03-41.52Zm-15 34.91l-28.57 16.25a8 8 0 0 0-3 3c-.58 1-1.19 2.06-1.81 3.06a7.94 7.94 0 0 0-1.22 4.21l-.15 32.25a95.89 95.89 0 0 1-25.37 14.3L134 199.13a8 8 0 0 0-3.91-1h-3.83a8.08 8.08 0 0 0-4.1 1l-28.84 16.1A96 96 0 0 1 67.88 201l-.11-32.2a8 8 0 0 0-1.22-4.22c-.62-1-1.23-2-1.8-3.06a8.09 8.09 0 0 0-3-3.06l-28.6-16.29a90.49 90.49 0 0 1 0-28.26l28.52-16.28a8 8 0 0 0 3-3c.58-1 1.19-2.06 1.81-3.06a7.94 7.94 0 0 0 1.22-4.21l.15-32.25a95.89 95.89 0 0 1 25.37-14.3L122 56.87a8 8 0 0 0 4.1 1h3.64a8.08 8.08 0 0 0 4.1-1l28.84-16.1A96 96 0 0 1 188.12 55l.11 32.2a8 8 0 0 0 1.22 4.22c.62 1 1.23 2 1.8 3.06a8.09 8.09 0 0 0 3 3.06l28.6 16.29a90.49 90.49 0 0 1 .05 28.29Z" />
                            </svg>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm truncate {{ request()->is('profile*') ? 'text-indigo-500' : '' }}">
                            Pengaturan
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <footer class="p-3 border-t border-slate-200">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 p-3 transition-colors rounded text-slate-900 hover:text-red-500 cursor-pointer">
                <div class="flex items-center self-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <path d="M10 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2" />
                            <path d="M15 12H3l3-3m0 6l-3-3" />
                        </g>
                    </svg>
                </div>
                <div
                    class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-sm font-medium truncate">
                    Logout
                </div>
            </button>
        </form>
    </footer>
</aside>

{{-- <div class="fixed top-0 bottom-0 left-0 right-0 z-30 transition-colors bg-slate-900/20 sm:hidden"></div> --}}
