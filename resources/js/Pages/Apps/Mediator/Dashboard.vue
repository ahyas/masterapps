<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    user:{
        type:Number
    }
});

</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard 
            </h2>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            Welcome <b><span>{{ props.user }}</span></b> 
        </div>
    </FlowbiteLayout>
</template>
