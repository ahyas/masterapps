<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    mediator:{
        type:Object
    },
    perkara_id:{
        type:String
    },
    mediator_id:{
        type:String
    }
});
console.log(props.perkara_id, props.mediator_id);

</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <h4>Detail mediator</h4>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Detail Mediator :</u></p>

            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 mb-4">
                <p>{{ props.mediator }}</p>
            </div>
            <Link :href="route('mediasi.detail_mediator.pilih', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id, mediator_id:props.mediator_id})">Pilih</Link>
        </div>

    </FlowbiteLayout>
</template>
