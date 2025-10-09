<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Validasi akun" />
    <FlowbiteLayout>
        <template #header>
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success alert!</span> Change a few things up and try submitting again.
            </div>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p>Validasi akun</p>
        </div>
    </FlowbiteLayout>
</template>