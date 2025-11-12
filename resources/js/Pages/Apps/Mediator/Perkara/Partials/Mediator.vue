<script setup>
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    mediator:{
        type:Object
    },
    perkara_id:{
        type:Number
    }
});
</script>

<template>
<p class="mb-1"><u>Detail Mediator</u></p>
<p><b>Nama :</b> {{ props.mediator.nama }}</p>
<p><b>Tempat lahir :</b> {{ props.mediator.tempat_lahir }}</p>
<p><b>Tanggal lahir :</b> {{ props.mediator.tgl_lahir }}</p>
<p class=" mb-2">{{ props.mediator.alamat }}</p>
<Link :href="route('mediasi.penilaian.create', {app_id:$page.props.auth.app_id, perkara_id:perkara_id})" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4">Review</Link>
</template>