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

    console.log('perkara_pihak_mediator ',props.perkara_pihak_mediator);
</script>
<template>

    <div class="bg-green-800 text-white">
        <div class="max-w-5xl py-10 px-6">
            <h1 class="text-3xl font-bold">
                Hasil Pencarian Perkara
            </h1>

            <p class="text-green-100 mt-2">
                Silakan pilih identitas Anda untuk mengisi survei mediator.
            </p>
        </div>
    
        <div v-if="props.perkara_pihak_mediator === null" class="p-4 bg-white">
            <ErrorAlert>Data perkara tidak ditemukan. Pastikan tidak ada kesalahan ketik.</ErrorAlert>
            <br>
            <Link class=" text-gray-700 font-semibold" :href="route('home')">Kembali</Link>
        </div>

        <div v-else class=" bg-white">
            <div class="bg-green-50 border border-green-200 p-5">
            
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        ✓
                    </div>

                    <div>
                        <h3 class="font-semibold text-green-800">
                            Perkara ditemukan
                        </h3>

                        <p class="text-green-700">
                            Pilih nama Anda untuk melanjutkan pengisian survei.
                        </p>
                    </div>
                </div>
            </div>

            <div class=" p-8">
                <h2 class="font-bold text-xl mb-6 text-gray-800">
                    Informasi Perkara
                </h2>

                <dl class="grid md:grid-cols-2 gap-6 bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                    <div>
                        <dt class="text-slate-500">
                            Nomor Perkara
                        </dt>

                        <dd class="font-semibold text-gray-600">
                            {{ props.perkara_pihak_mediator.nomor_perkara }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-slate-500">
                            Tanggal Pendaftaran
                        </dt>

                        <dd class="font-semibold text-gray-600">
                            {{ props.perkara_pihak_mediator.tgl_pendaftaran }}
                        </dd>
                    </div>

                </dl>
            </div>

            <div class=" p-8">
                <h2 class="font-bold text-xl mb-6 text-gray-800">
                    Informasi Mediator
                </h2>

                <dl class="grid md:grid-cols-2 gap-6 bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                    <div>
                        <dt class="text-slate-500">
                            Nama mediator
                        </dt>

                        <dd class="font-semibold text-gray-600">
                            {{ props.perkara_pihak_mediator.mediator.nama }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-slate-500">
                            Tempat/Tgl. Lahir
                        </dt>

                        <dd class="font-semibold text-gray-600">
                            {{ props.perkara_pihak_mediator.mediator.tempat_lahir }} / {{ props.perkara_pihak_mediator.mediator.tgl_lahir }}
                        </dd>
                    </div>

                </dl>
            </div>

            <div class="grid md:grid-cols-2 gap-6 p-8">
                <h2 class="font-bold text-xl text-gray-800">
                    Informasi Pihak
                </h2>
                <div
                    v-for="pihak in props.perkara_pihak_mediator.pihaks"
                    :key="pihak.id"
                    class="bg-white border rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-green-600 transition"
                >
                    <div class="text-center">
                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center text-3xl"
                        >
                            {{ pihak.jenis_kelamin === 'P' ? '👩' : '👨' }}
                        </div>

                        <h3
                            class="font-bold text-xl mt-4 mb-4 text-gray-800"
                        >
                            {{ pihak.nama }}
                        </h3>

                        <Link
                            :href="route('pihak.authenticate', {pihak_id:pihak.id})"
                            class="mt-6 w-full bg-green-700 hover:bg-green-800 text-white py-3 px-3 rounded-lg font-medium"
                        >
                            Masuk Sebagai <span class=" font-bold">{{ pihak.nama }}</span> untuk mengisi survey
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>