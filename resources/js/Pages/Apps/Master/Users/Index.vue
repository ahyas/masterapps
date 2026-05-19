<script setup>
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import Search from './partials/Search.vue';
const props = defineProps({
    users:{
        type:Object
    },
    query: {
        type: Object,
        default: () => ({
            search: ''
        })
    },
});
console.log(props.users);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manage user
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Daftar user</p>
                        
                        <div class="flex items-center justify-between mb-4 mt-4">
                            <Search :search="props.query.search" :app_id="$page.props.auth.app_id" />
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-4">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3" width="5">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3 w-px whitespace-nowrap">Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in props.users.data" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ props.users.from + index }}
                                    </td>
                                    <td class="px-6 py-4 text-left">{{ user.name }}</td>
                                    <td class="px-6 py-4 text-left">
                                        <span v-if="user.email">
                                            {{ user.email }}
                                        </span>
                                        <span v-else class="text-blue-600">
                                            {{ user.username }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="props.users.links" :meta="props.users" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
