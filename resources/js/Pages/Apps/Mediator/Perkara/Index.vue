<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';

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
});
console.log('mediasi ',props.data)
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
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr/>
            <p><u>Detail mediasi :</u></p>
            <table v-for="row in props.data">
                <div v-if="row.mediasi">
                <tr>
                    <td class=" font-bold">Tanggal penetapan mediator</td>
                    <td>:</td>
                    <td>{{ row.mediasi.penetapan_penunjukan_mediator }}</td>
                </tr>
                <tr>
                    <td class=" font-bold">Tanggal mulai mediasi</td>
                    <td>:</td>
                    <td>{{ row.mediasi.dimulai_mediasi }}</td>
                </tr>
                <tr>
                    <td class=" font-bold">Hasil mediasi</td>
                    <td>:</td>
                    <td>{{ row.mediasi.hasil_mediasi }}</td>
                </tr>
                <tr>
                    <td class=" font-bold">Isi kesepakatan</td>
                    <td>:</td>
                    <td>{{ row.mediasi.isi_kesepakatan_perdamaian }}</td>
                </tr>
                </div>
            </table>
        </div>
    </FlowbiteLayout>
</template>
