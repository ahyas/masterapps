<script setup>
const props = defineProps({
    mediasi:{
        type:Object
    }
});
console.log('detail mediasi: ',props.mediasi);
</script>

<template>
    <tr>
        <td colspan="3">
            <p><u>Detail mediasi :</u></p>
        </td>
    </tr>
    <tr>
        <td class=" font-bold">Tanggal penetapan mediator</td>
        <td>:</td>
        <td>{{ props.mediasi.penetapan_penunjukan_mediator }}</td>
    </tr>
    <tr>
        <td class=" font-bold">Tanggal mulai mediasi</td>
        <td>:</td>
        <td>{{ props.mediasi.dimulai_mediasi }}</td>
    </tr>
    <tr>
        <td class=" font-bold">Hasil mediasi</td>
        <td>:</td>
        <td>{{ props.mediasi.hasil_mediasi }}</td>
    </tr>
</template>