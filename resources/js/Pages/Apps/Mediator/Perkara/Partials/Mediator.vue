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
<p>
    <b>Nama :</b> {{ props.mediator.nama }}</br>
    <b>Tempat lahir :</b> {{ props.mediator.tempat_lahir }}</br>
    <b>Tanggal lahir :</b> {{ props.mediator.tgl_lahir }}</br>
    <b>Alamat: </b>{{ props.mediator.alamat }}
</p>
</template>