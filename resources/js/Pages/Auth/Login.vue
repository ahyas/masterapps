<script setup>
    import Checkbox from '@/Components/Checkbox.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
        test: {
            type: String,
        },
    });

    console.log('test ',props.test);

    const form = useForm({
        login: '',
        password: ''
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>

<template>
    <Head title="Login" />
    <div class="min-h-screen flex">
        <!-- Left Side -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-green-800 relative overflow-hidden"
        >
            <div
                class="absolute inset-0 bg-gradient-to-br from-green-900 to-green-700"
            ></div>

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <div
                    class="inline-flex items-center gap-3 mb-6"
                >
                    <div>
                        <Link href="/">
                        
                            <img :src="`${$page.props.auth.domain}/image/logo_pa.png`" width="80px" />
                        </Link>
                    </div>

                    <div>
                        <h2 class="font-bold text-xl">
                            Pengadilan Agama Boyolali
                        </h2>
                        <h2 class="text-green-100">
                            Kelas IA
                        </h2>
                    </div>
                </div>

                <h1 class="text-5xl font-bold leading-tight">
                    SMART
                    MEDIATOR
                </h1>

                <p class="mt-2 text-lg text-green-100 leading-relaxed">
                    Sistem Penilaian dan Evaluasi Kinerja Mediator
                    untuk meningkatkan kualitas pelayanan mediasi
                    di Pengadilan Agama Boyolali.
                </p>


            </div>

            <!-- Decoration -->
            <div
                class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-white/5"
            ></div>

            <div
                class="absolute top-20 right-20 w-48 h-48 rounded-full bg-white/5"
            ></div>
        </div>

        <!-- Login Form -->
        <div
            class="flex-1 flex items-center justify-center bg-slate-100 px-6"
        >
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">

                    <h2
                        class="text-3xl font-bold text-slate-800"
                    >
                        Login
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Masukkan akun Anda untuk melanjutkan
                    </p>
                </div>

                <!-- Card -->
                <div
                    class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8"
                >
                    <form class="space-y-5" @submit.prevent="submit">
                        <div>
                            <label
                                class="block text-sm font-medium text-slate-700 mb-2"
                            >
                                Username
                            </label>

                            <TextInput
                                id="login"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.login"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.login" />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-slate-700 mb-2"
                            >
                                Password
                            </label>

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <PrimaryButton
                            class=" bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg transition"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </PrimaryButton>
                    </form>
                </div>

                <div
                    class="text-center mt-6 text-sm text-slate-500"
                >
                    © 2026 Pengadilan Agama Boyolali
                </div>
            </div>
        </div>
    </div>
</template>