
<template>
    <Head title="Home" />
    <div class="min-h-screen bg-slate-50">
        <!-- Header -->
        <header class="bg-green-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center justify-between h-20">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-white flex items-center justify-center"
                        >
                            <svg
                                class="w-8 h-8 text-green-700"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2L2 7v5c0 5.5 3.8 10.7 10 12 6.2-1.3 10-6.5 10-12V7L12 2z"
                                />
                            </svg>
                        </div>

                        <div class="text-white">
                            <h1 class="text-2xl font-bold">
                                SMART MEDIATOR
                            </h1>
                            <p class="text-sm text-green-100">
                                Pengadilan Agama Boyolali
                            </p>
                        </div>
                    </div>

                    <Link
                        :href="route('login')"
                        class="text-white hover:text-green-200 font-medium"
                    >
                        Log in
                    </Link>
                </div>
            </div>
        </header>

        <!-- Hero -->
        <section class="bg-gradient-to-b from-green-800 to-green-700">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="text-white">
                        <div
                            class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 mb-6"
                        >
                            <span class="text-sm">
                                Sistem Penilaian Kinerja Mediator
                            </span>
                        </div>

                        <h2
                            class="text-4xl lg:text-5xl font-bold leading-tight"
                        >
                            Wujudkan Pelayanan Mediasi yang
                            Profesional dan Berkualitas
                        </h2>

                        <p
                            class="mt-6 text-lg text-green-100 leading-relaxed"
                        >
                            Smart Mediator merupakan sarana bagi para pihak
                            untuk memberikan penilaian dan masukan terhadap
                            layanan mediasi yang telah diterima di Pengadilan
                            Agama Boyolali.
                        </p>
                    </div>

                    <!-- Search Card -->
                    <div>
                        <div
                            class="bg-white rounded-2xl shadow-2xl p-8 border border-slate-100"
                        >
                            <div class="mb-6">
                                <h3
                                    class="text-2xl font-bold text-slate-800"
                                >
                                    Pencarian Perkara
                                </h3>

                                <p class="text-slate-600 mt-2">
                                    Masukkan nomor perkara untuk memberikan
                                    penilaian terhadap mediator yang menangani
                                    perkara Anda.
                                </p>
                            </div>

                            <form  @submit.prevent="submit">
                                <div class="space-y-4">
                                    <TextInput
                                        id="keyword"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.keyword"
                                        required
                                        placeholder="Masukan nomor perkara"
                                    />

                                    <InputError class="mt-2" :message="form.errors.keyword" />

                                    <button
                                        type="submit"
                                        class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-4 rounded-lg transition"
                                    >
                                        Cari Perkara
                                    </button>
                                </div>
                            </form>

                            <div
                                class="mt-6 border-t pt-4 text-sm text-slate-500"
                            >
                                Pastikan nomor perkara sesuai dengan yang
                                tercantum pada dokumen resmi pengadilan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-slate-800">
                        Tujuan Smart Mediator
                    </h3>
                    <p class="text-slate-600 mt-3">
                        Mendukung peningkatan kualitas pelayanan mediasi secara
                        berkelanjutan.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-xl p-8 shadow-sm border border-slate-200"
                    >
                        <div
                            class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4"
                        >
                            📊
                        </div>

                        <h4 class="font-bold text-lg text-slate-800 mb-2">
                            Evaluasi Pelayanan
                        </h4>

                        <p class="text-slate-600">
                            Mengukur kualitas pelayanan mediator berdasarkan
                            pengalaman para pihak.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-xl p-8 shadow-sm border border-slate-200"
                    >
                        <div
                            class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4"
                        >
                            ⚖️
                        </div>

                        <h4 class="font-bold text-lg text-slate-800 mb-2">
                            Transparansi
                        </h4>

                        <p class="text-slate-600">
                            Mendorong akuntabilitas dan keterbukaan dalam
                            pelaksanaan mediasi.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-xl p-8 shadow-sm border border-slate-200"
                    >
                        <div
                            class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4"
                        >
                            🤝
                        </div>

                        <h4 class="font-bold text-lg text-slate-800 mb-2">
                            Peningkatan Mutu
                        </h4>

                        <p class="text-slate-600">
                            Menjadi dasar perbaikan berkelanjutan terhadap
                            kualitas layanan mediasi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-green-900 text-green-100">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <div class="text-center">
                    <h4 class="font-semibold">
                        Pengadilan Agama Boyolali
                    </h4>

                    <p class="text-sm mt-2 text-green-200">
                        Smart Mediator © 2026
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

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