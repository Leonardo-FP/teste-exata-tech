<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, router } from '@inertiajs/vue3';
    import { reactive } from 'vue'
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';

    const form = reactive({
        name: null,
        email: null,
        password: null,
    })

    function submit() {
        router.post('/users/create', form)
    }
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>

                <Button label="Back" icon="pi pi-step-backward-alt" class="p-button-success" @click="$inertia.visit(route('users'))" />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="flex gap-4"> 
                            <div class="flex flex-col w-1/2 gap-2 text-gray-800"> 
                                <label for="username">Name</label>
                                <InputText type="text" id="username" v-model="form.name" />
                            </div>
                            <div class="flex flex-col w-1/2 gap-2 text-gray-800">
                                <label for="email">Email</label>
                                <InputText type="email" id="email" v-model="form.email" />
                            </div>
                        </div>
                        <div class="flex gap-4 mt-4"> 
                            <div class="flex flex-col w-1/2 gap-2 text-gray-800">
                                <label for="password">Password</label>
                                <InputText type="password" id="password" v-model="form.password" />
                            </div>
                        </div>
                        <Button class="mt-4" type="submit" label="Submit" />
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


