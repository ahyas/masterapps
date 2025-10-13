<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    user_apps:{
        type:Object
    }
});
console.log(props.user_apps);
</script>

<template>
    <Head title="Privileges" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manage privileges
            </h2>
            <Link :href="route('privileges.index', {app_id:$page.props.auth.app_id})" class=" font-semibold text-blue-500">Privileges</Link>
            <Link :href="route('roles.index', {app_id:$page.props.auth.app_id})" class=" ml-1 font-semibold text-blue-500">Roles</Link>
            <Link :href="route('permissions.index', {app_id:$page.props.auth.app_id})" class=" ml-1 font-semibold text-blue-500">Permissions</Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Privileges</p>
                        <p class=" mb-2">Role user pada setiap aplikasi</p>
                        <hr></hr>
                        <ul>
                            <li v-for="user in props.user_apps" :key="user.id" class=" mb-2">
                                <span class=" font-semibold">{{ user.name }}</span> <span v-if="user.email">{{ user.email }}</span><span v-else class="text-red-600">Email undefined</span>
                                <ul v-if="user.roles.length > 0" class=" list-inside list-disc text-sm">
                                    <li v-for="role in user.roles">{{ role.name }}@
                                        <span >{{role.app.name}}</span>
                                    </li>
                                </ul>
                                <ul v-else class="list-inside">
                                    <li>
                                        <span class=" text-red-600">Role undefined</span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
