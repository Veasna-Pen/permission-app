<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';


defineProps(['users'])
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-6 sm:px-4 bg-gray-50 border-b border-gray-200">
                        <div class="text-3xl font-bold text-green-700">
                           User Page
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
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ user.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.email }}
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
        </div>
</AdminLayout>
</template>
