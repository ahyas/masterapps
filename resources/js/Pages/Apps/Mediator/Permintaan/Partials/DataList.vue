<script setup>
const props = defineProps({
    data:{
        type:Object
    }
});
console.log(props.data)
</script>

<template>
    <table class="w-full">
        <thead>
            <tr>
                <th class=" text-left">No.</th>
                <th class=" text-left">Nomor perkara</th>
                <th class=" text-left">Tanggal pendaftaran</th>
                <th class=" text-left">Pihak</th>
                <th class=" text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in props.data" :key="row.id">
                <td>{{ index + 1 }}</td>
                <td>{{ row.nomor_perkara }}</td>
                <td>{{ row.tgl_pendaftaran }}</td>
                <td>
                    <ul class=" list-disc">
                        <li v-for="pihak in row.pihaks">
                            {{ pihak.nama }}
                        </li>
                    </ul>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</template>