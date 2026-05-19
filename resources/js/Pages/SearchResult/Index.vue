<script setup>
import ErrorAlert from '@/Components/ErrorAlert.vue';
import SuccessAlert from '@/Components/SuccessAlert.vue';
import FlowbiteHomeLayout from '@/Layouts/FlowbiteHomeLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

    const props = defineProps({
        keyword:{
            type:String
        },
        perkara_pihak:{
            type:Object
        },
        perkara_pihak_mediator:{
            type:Object
        },
        user_type:{
            type:String
        }
    });

    console.log(props.perkara_pihak_mediator);
</script>

<template>
    <Head title="Search result" />

    <FlowbiteHomeLayout>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class=" font-bold">Pencarian perkara nomor: {{ props.keyword }}</p>
            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 content-start">
                <div v-if="props.perkara_pihak_mediator === null" class="p-4 border border-gray-200 bg-white rounded-lg">
                    <ErrorAlert>Data perkara tidak ditemukan. Pastikan tidak ada kesalahan ketik.</ErrorAlert>
                </div>
                <div v-else class="p-4 border border-gray-200 bg-white rounded-lg">
                    <SuccessAlert>Data ditemukan. Pilih salah satu user untuk mengisi survey!</SuccessAlert>
                    <p class="mb-1 mt-2"><u>Detail perkara :</u></p>
                    <div class="relative overflow-x-auto">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <th class=" text-left">No.</th>
                                    <th class=" text-left">Nomor perkara</th>
                                    <th class=" text-left">Tanggal pendaftaran</th>
                                    <th class=" text-left">Pihak</th>
                                    <th class=" text-left">Hasil Mediasi</th>
                                    <th class=" text-left">Tanggal keputusan mediasi</th>
                                    <!--<th v-if="props.user_type == 'pihak'" class=" text-left">Mediator</th>-->
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{ props.perkara_pihak_mediator.nomor_perkara }}</td>
                                    <td>{{ props.perkara_pihak_mediator.tgl_pendaftaran }}</td>
                                    <td>
                                        <ul class="list-disc" v-for="pihak in props.perkara_pihak_mediator.pihaks">
                                            <li class=" list-inside">
                                                <Link :href="route('pihak.authenticate', {pihak_id:pihak.id})">{{ pihak.nama }}</Link>
                                            </li> 
                                        </ul>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="inline-flex">
                    <Link class=" text-gray-700 px-3 py-2.5 me-2 font-semibold" :href="route('home')">Kembali</Link>
                </div>
            </div>
        </div>
    </FlowbiteHomeLayout>
</template>