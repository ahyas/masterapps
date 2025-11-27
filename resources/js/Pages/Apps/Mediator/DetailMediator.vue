<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    mediator:{
        type:Object
    }
});
console.log(props.mediator);

const saveMediator = (mediator_id) => {
    console.log(mediator_id);
};
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
            <PrimaryButton @click="saveMediator(props.mediator.id)">Pilih mediator</PrimaryButton>
        </div>

    </FlowbiteLayout>
</template>
