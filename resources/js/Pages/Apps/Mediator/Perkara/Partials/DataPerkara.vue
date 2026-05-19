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
console.log('mediasi ',props.data.mediasi)
</script>

<template>
    <table class="w-full">
        <tbody>
            <tr>
                <th class=" text-left">No.</th>
                <th class=" text-left">Nomor perkara</th>
                <th class=" text-left">Tanggal pendaftaran</th>
                <th class=" text-left">Pihak</th>
                <th class=" text-left" v-if="$page.props.auth.can.akses_mediator">Hasil Mediasi</th>
                <th class=" text-left" v-if="$page.props.auth.can.akses_mediator">Tanggal keputusan mediasi</th>
                <!--<th v-if="props.user_type == 'pihak'" class=" text-left">Mediator</th>-->
            </tr>
            <tr v-if="$page.props.auth.can.menilai_mediator">
                <td>1</td>
                <td>{{ props.data.nomor_perkara }}</td>
                <td>{{ props.data.tgl_pendaftaran }}</td>
                <td>
                    <ul class="list-item list-disc" v-for="pihak in props.data.pihaks">
                        <li >
                            {{ pihak.nama }}<br></br> <!--(<span class=" font-semibold" v-if="pihak.jenis_kelamin == 'L'">Laki-laki</span><span class=" font-semibold" v-else>Perempuan</span>)-->
                            <span v-if="$page.props.auth.can.melihat_detail_review && props.data.reviews.length > 0" v-for="review in props.data.reviews" :key="review.id">
                                <span v-if="pihak.id == review.user_id">
                                    <span :class="review.rating <= 3 ? 'text-red-700' : 'text-blue-800'"><b>Rating :</b> {{ review.rating }} dari 5<br>
                                    <b>Testimony :</b> {{ review.testimony }}</span>
                                </span>
                            </span>
                        </li> 
                    </ul>
                </td>
                <td>
                    <span class="text-red-600" v-if="props.data.mediasi == null || props.data.mediasi.hasil_mediasi == null">N/A</span><span v-else>{{ props.data.mediasi.hasil_mediasi }}</span>
                </td>
                <td>
                    <span class="text-red-600" v-if="props.data.mediasi == null || props.data.mediasi.keputusan_mediasi == null">N/A</span><span v-else>{{ props.data.mediasi.keputusan_mediasi }}</span>
                </td>
            </tr>
            <tr v-else v-for="(perkara, index) in props.data" :key="perkara.id">
                <td>{{ index + 1 }}</td>
                <td>{{ perkara.nomor_perkara }}</td>
                <td>{{ perkara.tgl_pendaftaran }}</td>
                <td>
                    <ul class="list-item list-disc" v-for="pihak in perkara.pihaks">
                        <li >{{ pihak.nama }}</li>
                        <span v-for="review in perkara.reviews" :key="review.id">
                            <span v-if="pihak.id == review.user_id">
                                <span :class="review.rating <= 3 ? 'text-red-700' : 'text-blue-800'"><b>Rating :</b> {{ review.rating }} dari 5<br>
                                <b>Testimony :</b> {{ review.testimony }}</span>
                                <br></br>
                            </span>
                        </span>
                    </ul>
                </td>
                <td>
                    <span class='text-red-500' v-if="perkara.mediasi?.hasil_mediasi == null">
                        N/A
                    </span>
                    <span v-else>{{ perkara.mediasi.hasil_mediasi }}</span></td>
                <td>
                    <span class='text-red-500' v-if="perkara.mediasi?.keputusan_mediasi == null">
                        N/A
                    </span>
                    <span v-else>
                        {{ perkara.mediasi.keputusan_mediasi }}
                    </span>
                </td>
            </tr>
            
        </tbody>
    </table>
</template>