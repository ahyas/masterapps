<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    mediator:{
        type:Object
    },
    perkara_id:{
        type:String
    },
    mediator_id:{
        type:String
    },
    jumlah_keberhasilan:{
        type:Number
    }
});
console.log(props.perkara_id, props.mediator_id);
console.log(props.jumlah_keberhasilan);
</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Detail Mediator :</u></p>

            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 mb-4">
                <p>Nama: <b>{{ props.mediator.nama }}</b><br></br>
                Tempat lahir: {{ props.mediator.tempat_lahir == null ? "-" : props.mediator.tempat_lahir }}<br>
                Tanggal lahir: {{ props.mediator.tgl_lahir == null ? "-" : props.mediator.tgl_lahir }}<br>
                Alamat: {{ props.mediator.alamat == null ? "-" : props.mediator.alamat}}
                </p>
            </div>
            <Link onclick="return confirm('Anda yakin?')" :href="route('mediasi.detail_mediator.pilih', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id, mediator_id:props.mediator_id})" class="text-white  bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 mt-4" >Pilih</Link>
            <Link :href="route('mediasi.show_mediator', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id})" class="font-semibold text-red-500 ml-3">Cancel</Link>
        </div>

    </FlowbiteLayout>
</template>
