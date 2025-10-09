<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

onMounted(()=>{
    initFlowbite();
});

</script>

<template>
    <nav class="fixed top-0 z-50 w-full border-b bg-green-700 border-green-900">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-indigo-800 focus:outline-none focus:ring-1 focus:bg-indigo-800 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
             </button>
            <Link :href="route('home')">
                <div class="flex ms-2 md:me-24">
                <img src="https://img.icons8.com/?size=100&id=cy8NnWBeE4TL&format=png&color=000000" class="h-8 me-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-xl whitespace-nowrap text-white">App Mediator</span>
                </div>
            </Link>
          </div>

          <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://img.icons8.com/color/96/customer-skin-type-7.png" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-gray-900 dark:text-white" role="none">
                    {{ $page.props.auth.user.name }}
                </p>
                <p class="font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ $page.props.auth.user.email }}
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                    <Link :href="route('logout')" method="post" as="button" class="block w-max group px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                        Sign out
                    </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
            
        </div>
      </div>
    </nav>
    
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 sm:translate-x-0" aria-label="Sidebar">
       <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800 scrollbar">
          <ul class="space-y-2 font-medium">
            <li>
            <Link
                :href="route('dashboard')"
                class="active:text-blue-500"
            >
                <div class="flex items-center p-2 rounded-lg text-gray-200 hover:bg-gray-600 group">
                <svg class="w-5 h-5 text-gray-200 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                </svg>
                    <span class="ms-3">
                        Home
                    </span>
                </div>
            </Link>
            </li>

            <li>
                <Link
                    :href="route('app.mediator', {app_id:1})"
                    class="active:text-blue-500"
                >
                    <div class="flex items-center p-2 rounded-lg text-gray-200 hover:bg-gray-600 group">
                    <svg class="w-5 h-5 text-gray-200 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">
                    
                            Dashboard
                        
                        </span>
                    </div>
                </Link>
            </li>

            <li v-if="$page.props.auth.can.manage_mediasi">
                <Link
                    :href="route('mediasi.index', {app_id:$page.props.auth.app_id})"
                    class="active:text-blue-500"
                >
                    <div class="flex items-center p-2 rounded-lg text-gray-200 hover:bg-gray-600 group">
                    <svg class="w-5 h-5 text-gray-200 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">
                            Perkara mediasi
                        </span>
                    </div>
                </Link>
            </li>
                <li v-if="$page.props.auth.can.manage_report">
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-200 hover:bg-gray-600 transition duration-75 rounded-lg group" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Laporan</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-reports" class="hidden">
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-sm text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600">Perkara mediasi</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-sm text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600">Keberhasilan mediator</a>
                        </li>
                    </ul>
                </li>

                <li v-if="$page.props.auth.can.manage_setting">
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-200 hover:bg-gray-600 transition duration-75 rounded-lg group" aria-controls="dropdown-settings" data-collapse-toggle="dropdown-settings">
                        <svg class="w-5 h-5 text-gray-200 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M1 5h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 1 0 0-2H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2Zm18 4h-1.424a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2h10.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Zm0 6H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 0 0 0 2h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Z"/>
                            </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Pengaturan</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-settings" class="hidden">
                        <li v-if="$page.props.auth.can.hak_akses">
                            <a href="#" class="flex items-center w-full p-2 text-sm text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600">Hak akses</a>
                        </li>
                        <li v-if="$page.props.auth.can.aksesibilitas">
                            <a href="#" class="flex items-center w-full p-2 text-sm text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600">Aksesibilitas</a>
                        </li>
                        <li v-if="$page.props.auth.can.validasi_akun">
                            <Link :href="route('validasi_akun.index', {app_id:$page.props.auth.app_id})" class="flex items-center w-full p-2 text-sm text-gray-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600">Validasi akun</Link>
                        </li>
                    </ul>
                </li>

          </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-500">
            <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-gray-200 hover:bg-gray-600 group">
                <svg class="w-5 h-5 text-gray-200 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z"/>
                </svg>
                <span class="ms-3">Documentation</span>
                </a>
            </li>
        </ul>
       </div>
    </aside>
    
    <div class="min-h-screen bg-gray-100">
        <div class="p-4 sm:ml-64">
            <header
                class="bg-white shadow mt-14 px-4"
                v-if="$slots.header"
            >
                <div class="mx-auto py-4">
                    <slot name="header" />
                </div>
            </header>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>