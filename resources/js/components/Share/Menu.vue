<template>
    <li class="nav-item d-flex align-items-center mt-3 d-lg-none">
        <Link :class="{'select-highlight': '' === currentSlug}" class="nav-link" :href="route('home.index')">
            ទំព័រដើម
        </Link>
    </li>
    <li class="nav-item d-flex align-items-center" v-for="(menu, index) in menuItems"
        :key="index">
        <Link :class="{'select-highlight': menu.slug === currentSlug}" class="nav-link" :href="route('categories', menu.slug)">
            {{ menu.name }}
        </Link>
    </li>
</template>

<script setup>

import {Link, usePage} from '@inertiajs/vue3';
import {computed, ref} from 'vue';

const menuItems = computed(() => usePage().props.menu_item);

const currentSlug = computed(() => {
    const url = window.location.href;
    const urlSplit = url.split('/');
    return urlSplit[urlSplit.length - 1] ?? '';
});


</script>
