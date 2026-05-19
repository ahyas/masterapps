<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import FlowbiteHomeLayout from '@/Layouts/FlowbiteHomeLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const form = useForm({
    keyword:''
});

const submit = () => {
    return form.post(route('perkara.search'));
}

</script>

<template>
    <Head title="Welcome" />
    <FlowbiteHomeLayout>

        <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4">
            <p class=" font-bold">Pencarian perkara :</p>
            <div class="p-4 border border-gray-200 bg-white rounded-lg mt-4 content-start">
                <section>
                    <form class="max-w-lg" @submit.prevent="submit">
                        <div class="mb-5">
                            <InputLabel for="keyword" value="Masukan kata kunci" />

                            <TextInput
                                id="keyword"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.keyword"
                                required
                                placeholder="Masukan nomor perkara"
                            />

                            <InputError class="mt-2" :message="form.errors.keyword" />
                            
                        </div>
                        <div class="inline-flex">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                        </div>
                    </form>

            
                </section>
            </div>
        </div>
    </FlowbiteHomeLayout>
    
</template>
