<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    mediator:{
        type:Object
    },
    perkara_id:{
        type:String
    },
    reviews:{
        type:Object
    },
    nilai_mediator:{
        type:Object
    }
});
console.log(props.mediator);

// Group & count
const summary = computed(() => {
  const result = {}

    props.mediator.forEach(mediator => {
        props.nilai_mediator.forEach(nilai => {
            //start::mendefinisikan kustom kolom ditampilkan
            if (!result[mediator.id]) {
                result[mediator.id] = {
                    id: mediator.id, 
                    nama:mediator.nama, 
                    jumlah_perkara: mediator.jumlah_perkara, 
                    berhasil: 0, 
                    gagal: 0,
                    tingkat_keberhasilan:0,
                    rating_pihak:0
                };
            }
            //end::mendefinisikan kolom ditampilkan

            //start::perhitungan dan kalkulasi kolom
            if(mediator.id == nilai.mediator_id){

                if (nilai.hasil_mediasi === 'D' || nilai.hasil_mediasi === 'T') {
                    result[mediator.id].berhasil += nilai.count_mediasi;
                } else if (nilai.hasil_mediasi === 'S' || nilai.hasil_mediasi === 'Y1' || nilai.hasil_mediasi === 'Y2') {
                    result[mediator.id].gagal += nilai.count_mediasi;
                }

                if(mediator.total_reviews !== null){
                    result[mediator.id].rating_pihak = (mediator.total_reviews / mediator.length_review).toFixed(2);
                }

                if(result[mediator.id].berhasil > 0){
                    result[mediator.id].tingkat_keberhasilan = (result[mediator.id].berhasil /(result[mediator.id].berhasil + result[mediator.id].gagal)*100).toFixed(2);
                }
            }
            //end::perhitungan dan kalkulasi kolom
        });
    })

  return result
});



</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <h4>Daftar mediator</h4>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Daftar Mediators :</u></p>
        <div class="grid grid-cols-4 md:grid-cols-3 gap-4 over">
                

        <div v-for="item in summary" class="bg-neutral-primary-soft block max-w-sm p-6 border border-default rounded-base shadow-xs">
            <Link :href="route('mediasi.detail_mediator', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id,mediator_id:item.id})">
                <img class="rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="" />
            </Link>
            <Link :href="route('mediasi.detail_mediator', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id,mediator_id:item.id})">
                <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">{{ item.nama }}</h5>
            </Link>
            <p class="text-body">Jumlah perkara ditangani: {{item.jumlah_perkara}}</p>
            <p class="text-body text-green-700">Berhasil: {{ item.berhasil }}</p>
            <p class="text-body text-red-700">Gagal: {{ item.gagal }}</p>
            <p class="text-body text-blue-700">Tingkat keberhasilan: 
                <span v-if="item.tingkat_keberhasilan > 0">
                    {{ item.tingkat_keberhasilan }} %
                </span>
                <span v-else>
                    -
                </span>
            </p>
                    
            <p class="mb-6 text-body">Rating para pihak: 
                <span class="font-semibold" v-if="item.rating_pihak > 0">{{ item.rating_pihak }} of 5</span>
                <span class="font-semibold" v-else> - </span>
            </p>
            <Link :href="route('mediasi.detail_mediator', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id,mediator_id:item.id})" class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Read more
                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
            </Link>
        </div>


        </div>

        </div>

    </FlowbiteLayout>
</template>
