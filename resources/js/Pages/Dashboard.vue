<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    app_user:{
        type:Object
    }
});
console.log(props.app_user);
console.log(props.app_user.length);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p>Selamat datang <span class=" font-bold">{{ $page.props.auth.user.name }}</span>. Pilih aplikasi dibawah.</p>
                        
                        <ul v-if="props.app_user.length > 0">
                            <li v-for="app in props.app_user">
                                <Link :href="route(app.route_name, {app_id:app.id})">
                                    {{ app.name }}
                                </Link>
                            </li>
                        </ul>
                        <p class=" text-red-600" v-else>Anda belum memiliki akses kedalam aplikasi apapun. Silahkan hubungi Admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
