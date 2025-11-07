<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    app_user:{
        type:Object
    }
});

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
            <p>Selamat datang <span class=" font-semibold">{{ $page.props.auth.user.name }}</span>. Anda sedang mengakses aplikasi sebagai 
                <span v-for="role in $page.props.auth.permissions" class=" font-bold">{{ role.information }} </span>
            </p>
        </div>
    </FlowbiteLayout>
</template>
