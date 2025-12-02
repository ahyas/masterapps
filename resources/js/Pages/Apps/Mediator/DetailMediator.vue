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
    }
});
console.log(props.perkara_id, props.mediator_id);

</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <h4>Detail mediator</h4>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Detail Mediator :</u></p>

            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 mb-4">
                <p>Nama: <b>{{ props.mediator.nama }}</b><br></br>
                Tempat lahir: {{ props.mediator.tempat_lahir == null ? "-" : props.mediator.tempat_lahir }}<br>
                Tanggal lahir: {{ props.mediator.tgl_lahir == null ? "-" : props.mediator.tgl_lahir }}<br>
                Alamat: {{ props.mediator.alamat == null ? "-" : props.mediator.alamat}}
                </p>
            </div>
            <Link :href="route('mediasi.detail_mediator.pilih', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id, mediator_id:props.mediator_id})" class="font-medium text-fg-brand hover:underline">Pilih</Link>
        </div>

    </FlowbiteLayout>
</template>
