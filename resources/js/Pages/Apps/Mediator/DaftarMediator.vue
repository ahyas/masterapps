<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';

const props = defineProps({
    mediator:{
        type:Object
    },
    perkara_id:{
        type:String
    }
});
console.log(props.mediator);
</script>

<template>
    <Head title="Dashboard < Mediator" />

    <FlowbiteLayout>
        <template #header>
            <h4>Daftar mediator</h4>
        </template>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class="mb-1"><u>Daftar Mediator :</u></p>

        <div class="grid grid-cols-4 md:grid-cols-3 gap-4 over">
                

        <div v-for="item in props.mediator" class="bg-neutral-primary-soft block max-w-sm p-6 border border-default rounded-base shadow-xs">
            <Link :href="route('mediasi.detail_mediator', {app_id:$page.props.auth.app_id, perkara_id:props.perkara_id,mediator_id:item.id})">
                <img class="rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="" />
            </Link>
            <a href="#">
                <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">{{ item.nama }}</h5>
            </a>
            <p class="mb-6 text-body">In today’s fast-paced digital landscape, fostering seamless collaboration among Developers and IT Operations.</p>
            <a href="#" class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Read more
                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
            </a>
        </div>


        </div>

        </div>

    </FlowbiteLayout>
</template>
