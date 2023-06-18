<template>
    <div class="master-layout">
        <Header/>
        <div class="container" style="min-height: 50vh;">
            <slot/>
        </div>
        <Footer/>
    </div>
</template>

<script setup>

import Header from "../Components/Share/Header.vue";
import Footer from "../Components/Share/Footer.vue";
</script>

