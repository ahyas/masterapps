<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import DataMediasi from './Partials/DataMediasi.vue';
import DataPerkara from './Partials/DataPerkara.vue';
import EmptyData from './Partials/EmptyData.vue';
import Review from './Partials/Review.vue';
import Mediator from './Partials/Mediator.vue';

const props = defineProps({
    data:{
        type:Object
    },
    user_type:{
        type:String
    },
    review:{
        type:Object
    },
    test:{
        type:Object
    },
    mediator:{
        type:Object
    }
});
console.log('data ',props.data)
console.log('can ',usePage().props.auth.can)
console.log('review ', props.review);
console.log('mediator ', props.mediator);
</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success alert!</span> Change a few things up and try submitting again.
            </div>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Detail perkara :</u></p>
            <div class="relative overflow-x-auto">
                <DataPerkara v-if="props.data.length > 0" :data="props.data" :user_type="props.user_type"/>
                <EmptyData v-else />
            </div>
            <hr/>
            <DataMediasi v-if="props.data.length" :data="props.data"/>
            <EmptyData v-else />
            
        </div>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <Mediator v-if="$page.props.auth.can.menilai_mediator" :mediator="props.mediator.mediator" :perkara_id="props.mediator.id" />
            <Review v-if="props.review !== null" :data="props.review" />
            <EmptyData v-else />
        </div>
    </FlowbiteLayout>
</template>
