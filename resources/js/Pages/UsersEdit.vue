<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps(['user']);

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '', 
});

function submit() {
    form.put(route('users.update', props.user.id)); 
}
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>

                <Button label="Back" icon="pi pi-step-backward-alt" class="p-button-success" @click="$inertia.visit(route('users'))" />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="flex flex-col gap-4 text-gray-800">

                            <div>
                                <label for="name">Name</label>
                                <InputText id="name" v-model="form.name" class="w-full" />
                            </div>

                            <div>
                                <label for="email">Email</label>
                                <InputText type="email" id="email" v-model="form.email" class="w-full" />
                            </div>

                            <div>
                                <label for="password">Password</label>
                                <InputText type="password" id="password" v-model="form.password" placeholder="Leave blank to keep current password" class="w-full" />
                            </div>

                            <Button label="Save" type="submit" class="p-button-success mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
