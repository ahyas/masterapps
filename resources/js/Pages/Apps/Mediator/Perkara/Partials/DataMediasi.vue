<script setup>
const props = defineProps({
    data:{
        type:Object
    }
});
console.log('detail mediasi: ',props.data);
</script>

<template>
    <table v-for="row in props.data" :key="row.id" class="mb-4">
        <tbody v-if="row.mediasi">
            <tr>
                <td colspan="3">
                    <p><u>Detail mediasi :</u></p>
                </td>
            </tr>
            <tr>
                <td class=" font-bold">Tanggal penetapan mediator</td>
                <td>:</td>
                <td>{{ row.mediasi.penetapan_penunjukan_mediator }}</td>
            </tr>
            <tr>
                <td class=" font-bold">Tanggal mulai mediasi</td>
                <td>:</td>
                <td>{{ row.mediasi.dimulai_mediasi }}</td>
            </tr>
            <tr>
                <td class=" font-bold">Hasil mediasi</td>
                <td>:</td>
                <td>{{ row.mediasi.hasil_mediasi }}</td>
            </tr>
        </tbody>
    </table>
</template>