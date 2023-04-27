<template>
    <Header />
    <main>
        <slot />
    </main>
    <Footer />
</template>

<script setup>
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";
</script>

