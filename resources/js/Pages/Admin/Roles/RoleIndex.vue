<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps(['roles'])
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-4 sm:px-4 bg-gray-100 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <Link :href="route('roles.create')" :active="route().current('roles.index')"
                                    class="py-2.5 px-5 mr-2 mb-2 border border-gray-500 focus:outline-none text-purple-500 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-purple-200 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Add New</Link>

                                <select v-model="perPage" @change="getDepartments" id="countries"
                                    class="p-2 pl-10 w-40 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-500 focus:ring-2 focus:ring-purple-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="5">5 Per Page</option>
                                    <option value="10">10 Per Page</option>
                                    <option value="15">15 Per Page</option>
                                </select>
                            </div>

                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input v-model="search" type="text" id="table-search"
                                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-500 focus:ring-2 focus:ring-purple-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for items">
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-3">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    <tr v-for="role in roles" :key="role.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ role.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ role.name }}
                                        </td>
                                        <td class="px-6 py-4">

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
