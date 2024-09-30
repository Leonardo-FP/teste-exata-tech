<script setup>
    import { ref } from "vue";
    import Drawer from 'primevue/drawer';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';

    const visible = ref(false);
</script>

<template>
    <div class="card flex justify-center py-2">
        <Drawer v-model:visible="visible">
            <template #container="{ closeCallback }">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between px-6 pt-4 shrink-0">
                        <span class="inline-flex items-center gap-2">
                      
                            <svg width="35" height="40" style="background-color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm141.4 389.4c-37.8 37.8-88 58.6-141.4 58.6s-103.6-20.8-141.4-58.6C68.8 359.6 48 309.4 48 256s20.8-103.6 58.6-141.4C144.4 76.8 194.6 56 248 56s103.6 20.8 141.4 58.6c37.8 37.8 58.6 88 58.6 141.4s-20.8 103.6-58.6 141.4zM328 164c-25.7 0-55.9 16.9-59.9 42.1-1.7 11.2 11.5 18.2 19.8 10.8l9.5-8.5c14.8-13.2 46.2-13.2 61 0l9.5 8.5c8.5 7.4 21.6 .3 19.8-10.8-3.8-25.2-34-42.1-59.7-42.1zm-160 60c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm194.4 64H133.6c-8.2 0-14.5 7-13.5 15 7.5 59.2 58.9 105 121.1 105h13.6c62.2 0 113.6-45.8 121.1-105 1-8-5.3-15-13.5-15z"/></svg>

                            <span class="font-semibold text-2xl text-primary">SB ADMIN²</span>
                        </span>
                        <span>
                            <Button type="button" @click="closeCallback" icon="pi pi-times" rounded outlined></Button>
                        </span>
                    </div>
                    <div class="overflow-y-auto">
                        <ul class="list-none p-4 m-0">
                            <ul class="list-none p-0 m-0 overflow-hidden">
                                <li>
                                    <a v-ripple class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple" :href="route('dashboard')" :active="route().current('dashboard')">
                                        <i class="pi pi-home mr-2"></i>
                                        <span class="font-medium">Dashboard</span>
                                    </a>
                                </li>
                                <li v-if="hasPermission('view users')">
                                    <a v-ripple class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple" :href="route('users')" :active="route().current('users')">
                                        <i class="pi pi-users mr-2"></i>
                                        <span class="font-medium">Users</span>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        <hr class="mb-4 mx-4 border-t border-0 border-surface-200 dark:border-surface-700" />
                        <a v-ripple class="m-4 flex items-center cursor-pointer p-4 gap-2 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                            <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" shape="circle" />
                            <span class="font-bold">{{ $page.props.auth.user.name }}</span>
                        </a>
                    </div>
                </div>
            </template>
        </Drawer>
        <Button icon="pi pi-bars" @click="visible = true" />
    </div>
</template>

<script>
    export default {
        computed: {
            user() {
            return this.$page.props.auth.user;
            },
            permissions() {
            if (!this.user || this.user.roles.length === 0) return [];

            const permissionsSet = this.user.roles.reduce((acc, role) => {
                role.permissions.forEach(perm => acc.add(perm.name));
                return acc;
            }, new Set());

            return Array.from(permissionsSet); 
            }
        },
        methods: {
            hasPermission(permission) {
            return this.permissions.includes(permission);
            }
        }
    }
</script>
