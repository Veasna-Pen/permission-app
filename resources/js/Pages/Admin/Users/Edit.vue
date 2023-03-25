<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import VueMultiselect from 'vue-multiselect'
import { onMounted, watch } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    roles: Array,
    permissions: Array,
})

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    roles: [],
    permissions: [],
});

const submit = () => {
    form.put(route('users.update', props.user?.id));
};

onMounted(() => {
    form.permissions = props.user?.permissions;
    form.roles = props.user?.roles;
});

watch(
    () => props.user,
    () =>
    {
        form.permissions = props.user?.permissions,
        form.roles = props.user?.roles
    }
);

</script>

<template>
    <Head title="Add New User" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-4 sm:px-4 bg-gray-100 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <Link :href="route('users.index')"
                                    class="py-2.5 px-5 mr-2 mb-2 border border-gray-500 focus:outline-none text-purple-500 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-purple-200 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Back</Link>
                            </div>
                        </div>
                    </div>

                    <div class="sm:px-4 pt-5 bg-slate-100 shadow-lg rounded-lg">
                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                    autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                    autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="roles" value="Roles" />
                                <VueMultiselect v-model="form.roles" :options="roles" :multiple="true"
                                    :close-on-select="true" placeholder="Pick some" label="name" track-by="id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="permissions" value="Permissions" />
                                <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                                    :close-on-select="true" placeholder="Pick some" label="name" track-by="id" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="m-2" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="p-2 sm:px-4 mt-4 bg-slate-100 shadow-lg rounded-lg">
                    <div class="p-2 sm:px-4 bg-gray-100 font-medium border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1>Role</h1>
                            </div>
                        </div>
                    </div>
                    <!-- show role -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-2">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="userRole in user.roles" :key="userRole.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ userRole.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ userRole.name }}
                                    </td>
                                    <td class="flex py-4 px-6 space-x-2">
                                        <Link :href="route('users.roles.destroy', [user.id, userRole.id])"
                                            class="hover:bg-red-100" method="delete" as="button" type="button" preserve-scroll>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-2 sm:px-4 mt-4 bg-slate-100 shadow-lg rounded-lg">
                    <div class="p-2 sm:px-4 bg-gray-100 font-medium border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1>Permissions</h1>
                            </div>
                        </div>
                    </div>
                    <!-- show Permission -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-2">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="userPermission in user.permissions" :key="userPermission.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ userPermission.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ userPermission.name }}
                                    </td>
                                    <td class="flex py-4 px-6 space-x-2">
                                        <Link :href="route('users.permissions.destroy', [user.id, userPermission.id])"
                                            class="hover:bg-red-100" method="delete" as="button" type="button"  preserve-scroll>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
