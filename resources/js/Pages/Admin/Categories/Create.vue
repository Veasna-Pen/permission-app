<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue'

const form = useForm({
    name: '',
    image: null,
});

const imageUrl = computed(() => {
    if (form.image) {
        return URL.createObjectURL(form.image);
    }
});
</script>

<template>
    <Head title="Add New Category" />

    <AdminLayout>
        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white sm:rounded-lg">
                    <div class="p-4 sm:px-4 bg-gray-100 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <Link :href="route('categories.index')"
                                    class="py-2.5 px-5 mr-2 mb-2 border border-gray-500 focus:outline-none text-purple-500 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-purple-200 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Back
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="sm:px-4 pt-5 bg-slate-100 shadow-lg rounded-lg">
                        <form @submit.prevent="form.post(route('categories.store'))">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                    autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel class="w-20 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" for="image" value="Image">
                                </InputLabel>
                                <div class="flex items-center space-x-4">
                                    <TextInput id="image" type="file" class="hidden mt-1 block w-full"
                                        @input="form.image = $event.target.files[0]" />
                                    <img :src="imageUrl" class="h-25 w-20 object-contain" v-if="imageUrl" />
                                </div>
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="m-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
