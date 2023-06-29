<template>
    <div class="master-layout">
        <Header/>
        <slot/>
        <Footer/>
    </div>
</template>
<script setup>

import Header from "../Components/Share/Header.vue";
import Footer from "../Components/Share/Footer.vue";
</script>
<style>

</style>

