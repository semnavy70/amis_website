<template>
    <li class="nav-item">
        <Link v-if="url"
              class="nav-link"
              :class="{'active': isRoute(activeRoute)}"
              :href="url"
        >
            {{ name }}
        </Link>
        <a v-else-if="address"
              class="nav-link"
              :href="address"
        >
            {{ name }}
        </a>
    </li>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    name: String,
    activeRoute: String,
    url: String,
    address: String,
});

</script>
