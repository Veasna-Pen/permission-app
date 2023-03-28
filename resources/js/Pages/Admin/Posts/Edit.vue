<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    title: props.post.title,
})




</script>

<template>
    <Head title="Update Post" />

    <AdminLayout>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                <div class="bg-white sm:rounded-lg">
                    <div class="p-4 sm:px-4 bg-gray-100 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <Link :href="route('posts.index')"
                                    class="py-2.5 px-5 mr-2 mb-2 border border-gray-500 focus:outline-none text-purple-500 bg-white hover:bg-gray-100 focus:ring-2 focus:ring-purple-200 font-medium rounded-lg text-sm dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Back</Link>
                            </div>
                        </div>
                    </div>

                    <div class="sm:px-4 pt-5 bg-slate-100 shadow-lg rounded-lg">
                        <form @submit.prevent="form.put(route('posts.update', post.id))">
                            <div>
                                <InputLabel for="title" value="Title" />

                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus
                                    autocomplete="title" />

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>


                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="m-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
