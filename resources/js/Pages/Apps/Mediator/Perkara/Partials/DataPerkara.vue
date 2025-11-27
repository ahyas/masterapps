<script setup>
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    data:{
        type:Object
    },
    user_type:{
        type:String
    }
})
</script>

<template>
    <table class="w-full">
        <tbody>
            <tr>
                <th class=" text-left">Nomor perkara</th>
                <th class=" text-left">Tanggal pendaftaran</th>
                <th class=" text-left">Pihak</th>
                <!--<th v-if="props.user_type == 'pihak'" class=" text-left">Mediator</th>-->
            </tr>
            <tr>
                <td>{{ props.data.nomor_perkara }}</td>
                <td>{{ props.data.tgl_pendaftaran }}</td>
                <td>
                    <ul class="list-item list-disc" v-for="pihak in props.data.pihaks">
                        <li >
                            {{ pihak.nama }}<br></br> <!--(<span class=" font-semibold" v-if="pihak.jenis_kelamin == 'L'">Laki-laki</span><span class=" font-semibold" v-else>Perempuan</span>)-->
                            <span v-if="$page.props.auth.can.melihat_detail_review" v-for="review in perkara.reviews" :key="review.id">
                                <span v-if="pihak.id == review.user_id">
                                    <span :class="review.rating <= 3 ? 'text-red-700' : 'text-blue-800'"><b>Rating :</b> {{ review.rating }} dari 5<br>
                                    <b>Testimony :</b> {{ review.testimony }}</span>
                                </span>
                            </span>
                        </li> 
                    </ul>
                </td>
            </tr>
            
        </tbody>
    </table>
</template>