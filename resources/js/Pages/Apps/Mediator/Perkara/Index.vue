<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import DataMediasi from './Partials/DataMediasi.vue';
import DataPerkara from './Partials/DataPerkara.vue';
import EmptyData from './Partials/EmptyData.vue';
import Review from './Partials/Review.vue';
import Mediator from './Partials/Mediator.vue';
import AverageReview from './Partials/AverageReview.vue';

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
console.log('data ', props.data)
console.log('can ',usePage().props.auth.can)
console.log('review ', props.review);
console.log('mediator ', props.mediator.mediator);
</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <AverageReview v-if="$page.props.auth.can.melihat_average_review && props.review.reviews.length" :review="props.review.reviews" />
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Detail perkara :</u></p>
            <div class="relative overflow-x-auto">
                <DataPerkara v-if="Object.keys(props.data).length" :data="props.data" :user_type="props.user_type"/>
                <EmptyData v-else />
            </div>
            <hr/>
            <p><u>Detail Mediasi:</u></p>
            <DataMediasi v-if="props.data.mediasi !== null" :data="props.data"/>
            <EmptyData v-else />
        </div>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <div class="flex justify-left items-center mb-2">
                <p><u>Detail Mediator :</u></p>
            </div>
            <Mediator v-if="$page.props.auth.can.menilai_mediator && props.mediator.mediator !== null" :mediator="props.mediator.mediator" />
            <EmptyData v-else />

            <div class="flex">
                <Link v-if="$page.props.auth.can.menilai_mediator && props.mediator.mediator !== null" :href="route('mediasi.penilaian.create', {app_id:$page.props.auth.app_id, perkara_id:props.mediator.id})" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4">Berikan review</Link>
                <Link 
                    v-else 
                    :href="route('mediasi.show_mediator', {
                        app_id:$page.props.auth.app_id, 
                        perkara_id:props.mediator.id
                        })" 
                    class="
                        text-white 
                        bg-green-700 
                        hover:bg-green-800 
                        focus:ring-4 
                        focus:ring-green-300 
                        font-medium 
                        rounded-lg 
                        text-sm 
                        px-5
                        py-2.5 
                        me-2 
                        mb-2 
                        dark:bg-green-600 
                        dark:hover:bg-green-700 
                        focus:outline-none 
                        dark:focus:ring-green-800 
                        mt-4" 
                    >
                    Pilih mediator
                </Link>
            </div>

            <p class="mt-4"><u>Review Anda :</u></p>
            <Review v-if="props.review !== null" :data="props.review" />
            <EmptyData v-else />
        </div>
    </FlowbiteLayout>
</template>
