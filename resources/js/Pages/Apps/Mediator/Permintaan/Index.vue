<script setup>
    import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import DataPerkara from '../Perkara/Partials/DataPerkara.vue';
    import EmptyData from '../Perkara/Partials/EmptyData.vue';
    import DataList from './Partials/DataList.vue';
    const props = defineProps({
        data:{
            type:Object
        },
        user_type:{
            type:String
        }
    });

</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p>Permintaan masuk</p>
            <div class="relative overflow-x-auto">
                <DataList v-if="Object.keys(props.data).length" :data="props.data" />
                <EmptyData v-else />
            </div>
        </div>
    </FlowbiteLayout>
</template>