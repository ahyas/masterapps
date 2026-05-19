<script setup>
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    mediator:{
        type:Object
    },
    jumlah_keberhasilan:{
        type:Object
    }
});
console.log(props.jumlah_keberhasilan);
</script>

<template>
<p>
     {{ props.mediator.nama !== null ? props.mediator.nama : "-" }}
</p>
<!-- <p>
    <b>Tempat lahir :</b> {{ props.mediator.tempat_lahir !== null ? props.mediator.tempat_lahir : "-"  }}
</p>
<p>
    <b>Tanggal lahir :</b> {{ props.mediator.tgl_lahir !== null ? props.mediator.tgl_lahir : "-" }}
</p>
<p>
    <b>Alamat: </b>{{ props.mediator.alamat !== null ? props.mediator.alamat : "-" }}

</p> -->
</template>