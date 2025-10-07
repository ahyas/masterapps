<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    permissions:{
        type:Object
    }
});
console.log(props.permissions);
</script>

<template>
    <Head title="Privileges" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manage permissions
            </h2>
            <Link :href="route('roles.index', {app_id:$page.props.auth.app_id})" class=" font-semibold text-blue-500">Roles</Link>
            <Link :href="route('permissions.index', {app_id:$page.props.auth.app_id})" class=" ml-1 font-semibold text-blue-500">Permissions</Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Permissions</p>
                        <ul>
                            <li v-for="app in props.permissions">
                                {{ app.name }}
                                <ul>

                                    <li v-for="role in app.roles">
                                        <ul class=" list-disc list-inside">
                                            <li v-for="permission in role.permissions">
                                                {{ permission.name }}
                                            </li>
                                        </ul>
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
