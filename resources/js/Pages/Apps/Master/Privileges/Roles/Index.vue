<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    app_role:{
        type:Object
    }
});
console.log(props.app_role);
</script>

<template>
    <Head title="Privileges" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manage roles
            </h2>
            <Link :href="route('privileges.index', {app_id:$page.props.auth.app_id})" class=" font-semibold text-blue-500">Privileges</Link>
            <Link :href="route('roles.index', {app_id:$page.props.auth.app_id})"  class=" ml-1 font-semibold text-blue-500">Roles</Link>
            <Link :href="route('permissions.index', {app_id:$page.props.auth.app_id})" class=" ml-1 font-semibold text-blue-500">Permissions</Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Daftar Roles</p>
                        <p class=" mb-2">Setiap aplikasi memiliki roles nya masing-masing</p>
                        <hr></hr>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-4">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3" width="5">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">App</th>
                                    <th scope="col" class="px-6 py-3">Role / Slug</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(app, index) in props.app_role" :key="app.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 align-top">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-left align-top">{{ app.name }}</td>
                                    <td class="px-6 py-4 text-left align-top">
                                        <ul class=" list-disc list-inside text-sm">
                                            <li v-for="role in app.roles">
                                                {{ role.name }} / {{ role.slug }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
