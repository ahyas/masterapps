<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import DataMediasi from './Partials/DataMediasi.vue';

const props = defineProps({
    data:{
        type:Object
    },
    user_type:{
        type:String
    },
    mediasi:{
        type:Object
    },
    review:{
        type:Object
    },
});
console.log('data ',props.data)
console.log('can ',usePage().props.auth.can)
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
            <p><u>Detail perkara :</u></p>
            <div class="relative overflow-x-auto">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <th class=" text-left">Nomor perkara </th>
                            <th class=" text-left">Tanggal pendaftaran</th>
                            <th class=" text-left">Pihak</th>
                            <th v-if="props.user_type == 'pihak'" class=" text-left">Mediator</th>
                            <th></th>
                        </tr>
                        
                        <tr v-for="perkara in props.data" :key="perkara.id">
                            <td>{{ perkara.nomor_perkara }}</td>
                            <td>{{ perkara.tgl_pendaftaran }}</td>
                            <td>
                                <ul class="list-item list-disc" v-for="pihak in perkara.pihaks">
                                    <li>{{ pihak.nama }} (<span class=" font-semibold" v-if="pihak.jenis_kelamin == 'L'">Laki-laki</span><span class=" font-semibold" v-else>Perempuan</span>)</li> 
                                </ul>
                            </td>
                            <td v-if="'mediator' in perkara">
                                <span v-if="Object.keys(perkara.mediator).length == 0">
                                    <Link :href="route('home')" class="text-blue-600 dark:text-blue-500 hover:underline">
                                        Pilih
                                    </Link>
                                </span>
                                <span v-else>
                                    {{ perkara.mediator.nama }}
                                </span>
                            </td>
                            <td>
                                <Link v-if="$page.props.auth.can.menilai_mediator" :href="route('mediasi.penilaian.create', {app_id:$page.props.auth.app_id, perkara_id:perkara.id})" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4">Review</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr/>
            
            <table v-for="row in props.data" :key="row.id" class="mb-4">
                <DataMediasi v-if="row.mediasi" :mediasi="row.mediasi"/>
                <tr v-else>
                    <td colspan="3">Tidak ada data ditampilkan</td>
                </tr>
            </table>
            
        </div>
    </FlowbiteLayout>
</template>
