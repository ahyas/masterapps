<script setup>
import FlowbiteLayout from '@/Layouts/AppBukutamuLayout.vue';
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

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            Selamat datang <span class=" font-semibold">{{ $page.props.auth.user.name }}</span>. Anda sedang mengakses <span class=" font-semibold">{{$page.props.auth.user_apps.name}}</span> sebagai:
            <ul class="max-w-md font-semibold text-sm text-gray-800 list-disc list-inside dark:text-gray-400">
                <li v-for="role in $page.props.auth.permissions">
                    {{ role.name }}
                </li>
            </ul>
            {{ $page.props.auth.privilege }}
        </div>
    </FlowbiteLayout>
</template>
