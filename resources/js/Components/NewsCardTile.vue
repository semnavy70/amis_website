<script setup>

import route from "../../../vendor/tightenco/ziggy/src/js";
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    id: Number,
    title: String,
    short_description: String,
    categories: String,
    first_name: String,
    last_name: String,
    created_at: String,
    slug: String,
    image: String,
});

</script>
<template>
    <div class="news-card-tile mb-3 text-start">
        <Link :href="route('detail', id)">
            <div class="d-flex">
                <img :src="getImage(image)" alt="news image">
                <div class="d-block ms-3">
                    <span class="text-danger d-block">{{ categories }}</span>
                    <span class="text-primary me-2">{{ first_name }} {{ last_name }} |</span>
                    <span class="text-grey">{{ khmerDateFormat(created_at) }}</span>
                    <p class="text-dark fw-bold title text-truncate-3 my-1">{{ title }}</p>
                    <p class="text-truncate-2 text-grey fs-14 d-none d-lg-block">{{ short_description }}</p>
                </div>
            </div>
        </Link>
    </div>
</template>
