<template>
    <App>
        <div class="text-center" style="margin-top: 40vh">
             <ul>
                 <li>
                     <a href="#">Home</a>
                 </li>
                 <li>
                     <a :href="route('news.index')">News</a>
                 </li>
                 <li>
                     <a :href="route('document.index',{slug:'slug'})">Document</a>
                 </li>
                 <li>
                     <a :href="route('other_page.index',{slug:'slug'})">Page</a>
                 </li>
                 <li>
                     <a :href="route('contact_us.index')">Contact Us</a>
                 </li>
                 <li>
                     <a :href="route('search.index')">Search</a>
                 </li>
             </ul>
        </div>
    </App>
</template>

<script setup>

import App from "../Layouts/App.vue";
</script>

<style scoped>

</style>
