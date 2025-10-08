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
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard master aplikasi
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Halaman konfigurasi sistem:</p>
                        <ul class="list-disc list-inside">
                            <li>
                                <Link :href="route('app.master.user', {app_id : $page.props.auth.app_id})">
                                    Manage Users
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('privileges.index', {app_id: $page.props.auth.app_id})">
                                    Manage Privileges
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('app.master.app', {app_id: $page.props.auth.app_id})">
                                    Manage Apps
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
