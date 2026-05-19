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
            
            <Link :href="route('home')">
                <div class="flex ms-2 md:me-24">
                <img src="https://img.icons8.com/?size=100&id=cy8NnWBeE4TL&format=png&color=000000" class="h-8 me-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-xl whitespace-nowrap text-white">SMART MEDIATOR</span>
                </div>
            </Link>
          </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3 gap-4 text-white">
                    
                        <Link
                            :href="route('login')"
                            class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </Link>
                    
                </div>
            </div>

        </div>
      </div>
    </nav>
    
    <div class="min-h-screen bg-gray-100">
        <div class="p-4">
            
            <header
                class="bg-white shadow mt-14 px-4"
                v-if="$slots.header"
            >
                <div class="mx-auto py-4">
                    <slot name="header" />
                </div>
            </header>
            <main class=" mt-14 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <slot />
            </main>
        </div>
    </div>
</template>