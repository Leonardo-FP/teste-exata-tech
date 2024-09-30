<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Button from 'primevue/button';
    import Dialog from 'primevue/dialog';

    const props = defineProps(['users']);
    const visible = ref(false);

    function formatDate(date) {
        if (!date) return ''; 
        const dateObj = new Date(date);
        return dateObj.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    }

    const selectedUserId = ref(null);
    const selectedUserName = ref(null);

    function openDialog(id, name) {
        selectedUserId.value = id;
        selectedUserName.value = name;
        visible.value = true;
    }

    function deleteUser() {
        router.delete(`/users/${selectedUserId.value}`, {
            onSuccess: () => {
                visible.value = false;  
            },
            onError: (errors) => {
                console.error('Error deleting user:', errors);
            }
        });
    }
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>

                <Button label="Create User" icon="pi pi-user-plus" class="p-button-success" @click="$inertia.visit(route('users.create'))" />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <DataTable paginator :rows="10" :rowsPerPageOptions="[10, 20, 30, 50, 100]" :value="users" tableStyle="min-width: 50rem">
                    <Column field="id" header="Id"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="email" header="Email"></Column>
                    <Column header="Created at">
                        <template #body="slotProps">
                            {{ formatDate(slotProps.data.created_at) }}
                        </template>
                    </Column>
                    <Column header="Edit">
                        <template #body="slotProps">
                            <Button 
                                label="Edit" 
                                icon="pi pi-user-edit" 
                                class="p-button-warning" 
                                @click="$inertia.visit(route('users.edit', slotProps.data.id))" 
                            />
                        </template>
                    </Column>
                    <Column header="Delete">
                        <template #body="slotProps">
                            <Button 
                                label="Delete" 
                                icon="pi pi-user-minus" 
                                severity="danger"
                                @click="openDialog(slotProps.data.id, slotProps.data.name)" 
                            />

                            <Dialog v-model:visible="visible" modal header="Are you sure?" :style="{ width: '25rem' }">
                                <span class="text-surface-500 dark:text-surface-400 block mb-8">User: {{ selectedUserName }}</span>
                                <span class="text-red-600 dark:text-surface-400 block mb-8">Deleting a user is an irreversible action</span>
                                <div class="flex justify-between gap-2">
                                    <Button class="w-full" type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                                    <Button class="w-full" type="button" label="Delete" severity="danger" @click="deleteUser"></Button>
                                </div>
                            </Dialog>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
        
        
    </AuthenticatedLayout>
</template>
