<template>
    <li v-if="address">
        <a :href="address">{{ name }}</a>
    </li>
    <li v-if="url">
        <Link :href="url">{{ name }}</Link>
    </li>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    name: String,
    url: String,
    address: String,
});
</script>
