<script setup>
import EmptyData from './EmptyData.vue';

const props = defineProps({
    data:{
        type:Object
    }
});
console.log('detail mediasi: ',props.data);
</script>

<template>
    <table class="mb-4">
        <tbody>
            <tr>
                <td class=" font-bold">Tanggal penetapan mediator</td>
                <td>:</td>
                <td>{{ props.data.mediasi.penetapan_penunjukan_mediator }}</td>
            </tr>
            <tr>
                <td class=" font-bold">Tanggal mulai mediasi</td>
                <td>:</td>
                <td>{{ props.data.mediasi.dimulai_mediasi }}</td>
            </tr>
            <tr>
                <td class=" font-bold">Hasil mediasi</td>
                <td>:</td>
                <td>{{ props.data.mediasi.hasil_mediasi }}</td>
            </tr>
        </tbody>
    </table>
</template>