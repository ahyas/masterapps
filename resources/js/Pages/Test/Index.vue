<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    perkara_mediasi:{
        type:Object
    },
    perkaras:{
        type:Object
    },
});
console.log(props.apps)
</script>

<template>
    <Head title="Privileges" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Manage Apps
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p class=" font-semibold">Daftar aplikasi</p>
                        <table class="table-auto">
                            <tbody>
                                <tr v-for="row in props.perkara_mediasi" >
                                    <tr v-for="baris in props.perkaras">
                                        <div v-if="row.perkara_id !== baris.id">
                                            <td>{{ row.perkara_id }}</td>
                                            <td>Found</td>
                                        </div>
                                    </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
