<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-10 bg-gray-50 border-b border-gray-200">
                        <div class="text-3xl font-bold text-green-700">
                            User Page
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </AdminLayout>
</template>
