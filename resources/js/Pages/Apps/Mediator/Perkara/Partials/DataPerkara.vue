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
                <th v-if="props.user_type == 'pihak'" class=" text-left">Mediator</th>
            </tr>
            
            <tr v-for="perkara in props.data" :key="perkara.id">
                <td>{{ perkara.nomor_perkara }}</td>
                <td>{{ perkara.tgl_pendaftaran }}</td>
                <td>
                    <ul class="list-item list-disc" v-for="pihak in perkara.pihaks">
                        <li >
                            {{ pihak.nama }}<br></br> <!--(<span class=" font-semibold" v-if="pihak.jenis_kelamin == 'L'">Laki-laki</span><span class=" font-semibold" v-else>Perempuan</span>)-->
                            <span v-if="$page.props.auth.can.melihat_detail_review" v-for="review in perkara.reviews" :key="review.id">
                                <span v-if="pihak.id == review.user_id" class=" text-green-800">
                                    <span><b>Rating :</b> {{ review.rating }} dari 5</span><br>
                                    <span><b>Testimony :</b> {{ review.testimony }}</span>
                                </span>
                            </span>
                        </li> 
                    </ul>
                </td>
                <td v-if="'mediator' in perkara">
                    <span v-if="Object.keys(perkara.mediator).length == 0">
                        <Link :href="route('home')" class="text-blue-600 dark:text-blue-500 hover:underline">
                            Pilih
                        </Link>
                    </span>
                    <span v-else>
                        {{ perkara.mediator.nama }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>