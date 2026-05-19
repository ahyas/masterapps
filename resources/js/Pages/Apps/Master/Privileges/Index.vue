<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import Search from './Partials/Search.vue';
const props = defineProps({
    user_apps:{
        type:Object
    },
    query: {
        type: Object,
        default: () => ({
            search: ''
        })
    },
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
                        <p class=" font-semibold">Manage Privileges</p>
                        <p class=" mb-2">Role user pada setiap aplikasi</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <Search :search="props.query.search" :app_id="$page.props.auth.app_id" />
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3" width="5">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left" width="300px">
                                        Role
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in props.user_apps.data" :key="user.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ props.user_apps.from + index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span>{{ user.name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        <span v-if="user.email">
                                            {{ user.email }}
                                        </span>
                                        <span v-else class="text-blue-600">
                                            {{ user.username }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-left">
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="props.user_apps.links" :meta="props.user_apps" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
