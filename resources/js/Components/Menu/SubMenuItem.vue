<template>
    <li>
        <Link v-if="url"
              class="dropdown-item"
              :class="{'active': isRoute(activeRoute)}"
              :href="url"
        >
            {{ name }}
        </Link>
        <a v-else-if="address"
           class="dropdown-item"
           :href="address"
        >
            {{ name }}
        </a>

        <!--        <Link class="dropdown-item" :href="route('page.detail', 'info-about-us')">-->
        <!--            ទាក់ទងមកយើង-->
        <!--        </Link>-->
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
