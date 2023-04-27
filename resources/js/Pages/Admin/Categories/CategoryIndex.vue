<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue'
import { ref, watch, defineProps } from "vue";
import { router } from '@inertiajs/vue3'

import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from '@/Components/Modal.vue';
import { usePermission } from '@/Composable/Permission'


const showConfirmDeletePostModal = ref(false)
const form = useForm({})
const { hasPermission } = usePermission();

const confirmDeletePost = () => {
    showConfirmDeletePostModal.value = true;
}

const closeModal = () => {
    showConfirmDeletePostModal.value = false;
}

const deletePost = (id) => {
    form.delete(route('categories.destroy', id), {
        onSuccess: () => closeModal()
    })
}

const props = defineProps({
    categories: Object,
    filters: Object,
    total: Number,
});

const search = ref(props.filters.search);
const perPage = ref(5);
watch(search, (value) => {
    router.get(
        "categories",
        { search: value, perPage: perPage.value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

function getCategories() {
    router.get(
        "categories",
        { perPage: perPage.value, search: search.value },
        {
            preserveState: true,
            replace: true,
            onSuccess: (data) => {
                // Set the total number of posts
                props.total = data.total;
            },
        }
    );
}

function changePage(page) {
    router.get(
        "categories",
        { perPage: perPage.value, search: search.value, page },
        {
            preserveState: true,
            replace: true,
        }
    );
}



</script>

<template>
    <Head title="Category" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-4 sm:px-4 bg-gray-100 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <template v-if="hasPermission('create post')">
                                    <Link :href="route('categories.create')" :active="route().current('categories.index')"
                                        class="py-2.5 px-5 mr-2 mb-2 border border-gray-500 focus:outline-none text-purple-500 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-purple-200 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                    Add New</Link>
                                </template>

                                <select v-model="perPage" @change="getCategories" id="countries"
                                    class="p-2 pl-5 w-40 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-500 focus:ring-2 focus:ring-purple-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories.data" :key="category.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ category.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ category.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img :src="category.image" class="w-12 h-12 rounded-full shadow-lg">
                                    </td>
                                    <td class="flex py-4 px-6 space-x-3">
                                        <template v-if="hasPermission('update post')">
                                            <Link :href="route('categories.edit', category.id)" class="hover:bg-purple-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-6 h-6">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                                <path
                                                    d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                            </svg>

                                            </Link>
                                        </template>
                                        <template v-if="hasPermission('delete post')">
                                            <button @click="confirmDeletePost" class="hover:bg-red-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-6 h-6">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                        clip-rule="evenodd" />
                                                </svg>


                                            </button>
                                        </template>
                                        <Modal :show="showConfirmDeletePostModal" @close="closeModal">
                                            <div class="p-6">
                                                <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this
                                                    Category?</h2>
                                                <div class="mt-6 flex space-x-4">
                                                    <DangerButton @click="deletePost(category.id)">Delete</DangerButton>
                                                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                                </div>
                                            </div>
                                        </Modal>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="flex justify-between">
                            <Pagination :currentPage="categories.current_page" :lastPage="categories.last_page"
                            :onPageChange="page => changePage(page)" />
                        <Pagination :links="categories.links" :total="total" />
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
