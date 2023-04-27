<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FrontendLayout from '@/Layouts/Frontend.vue';
    import HeroSection from '@/Components/Frontend/Hero.vue';
    import Category from '@/Components/Frontend/Category.vue';

    defineProps({
    categories: Object,
  });
</script>

<template>
    <Head title="Welcome" />
    <FrontendLayout>
    <!---Hero Section-->
    <HeroSection/>

    <!--Category Section-->
    <Category :categories="categories"/>

    </FrontendLayout>
</template>



