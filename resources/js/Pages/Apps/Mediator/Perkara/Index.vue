<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    perkara_pihak:{
        type:Object
    },
    a:{
        type:Object
    }
});
console.log(props.perkara_pihak)
</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success alert!</span> Change a few things up and try submitting again.
            </div>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p>Detail perkara</p>
            <div class="relative overflow-x-auto">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <th class=" text-left">Nomor perkara</th>
                            <th class=" text-left">Tanggal pendaftaran</th>
                            <th class=" text-left">Pihak</th>
                            <th class=" text-left">Mediator</th>
                        </tr>
                        
                        <tr v-for="perkara in props.perkara_pihak" :key="perkara.id">
                            <td>{{ perkara.nomor_perkara }}</td>
                            <td>{{ perkara.tgl_pendaftaran }}</td>
                            <td>
                                <ul class="list-item list-disc" v-for="pihak in perkara.pihaks">
                                    <li>{{ pihak.nama }}</li>
                                </ul>
                            </td>
                            <td>
                                <Link :href="route('home')" class="text-blue-600 dark:text-blue-500 hover:underline">Pilih</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </FlowbiteLayout>
</template>
