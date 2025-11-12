<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    perkara_id:{
        type:String
    },
    mediator:{
        type:Object
    },
});

const form = useForm({
    rating:null,
    testimony:'',
    mediator_id:props.mediator.id,
});

const submit = () => {
    form.post(route('mediasi.penilaian.store', {app_id:usePage().props.auth.app_id, perkara_id:props.perkara_id}))
}
console.log(props.mediator);
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
            <p><u>Penilaian mediator :</u></p>
            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 content-start">
                <section>
                    <form class="max-w-lg" @submit.prevent="submit">
                        <label class="block mb-2 font-semibold">Your Rating:</label>
                        <div class="flex space-x-1 mb-3">
                            <button
                            v-for="i in 5"
                            :key="i"
                            type="button"
                            @click="form.rating = i"
                            :class="[
                                'text-2xl',
                                i <= form.rating ? 'text-yellow-500' : 'text-gray-400'
                            ]"
                            >
                            ★
                            </button>
                        </div>
                        <div class="mb-5">
                            <label for="kode" class="block mb-2 font-semibold">Testimoni</label>
                            <textarea 
                            id="message" 
                            v-model="form.testimony"
                            rows="4" 
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Write your thoughts here..."></textarea>
                            
                        </div>
                        <div class="inline-flex">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                            <Link class=" text-red-700 px-3 py-2.5 me-2 mb-2 font-semibold" :href="route('mediasi.index', {app_id: $page.props.auth.app_id})">Kembali</Link>
                        </div>
                    </form>

            
                </section>
            </div>
        </div>
    </FlowbiteLayout>
</template>
