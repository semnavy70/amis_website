<template>
    <div class="bg-app-bar">
        <div class="container py-2">
            <ul class="list-group list-unstyled list-group-horizontal justify-content-end">
                <li>
                    <a href="#">
                        <img src="/assets/img/flag-kh.png" alt="kh-flag" width="30">
                    </a>
                </li>
                <li class="px-2 text-white">|</li>
                <li>
                    <a href="#">
                        <img src="/assets/img/flag-en.png" alt="en-flag" width="30">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="header border-bottom sticky-top">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="logo" src="/assets/img/amis-logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <MainMenu/>
            </div>
        </nav>
    </div>

</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import MainMenu from "@/Components/Menu/MainMenu.vue";


</script>
