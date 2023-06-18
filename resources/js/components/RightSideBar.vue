<template>
    <div class="right-side-popular">
        <h4>តាមដានបន្ថែមទៀត</h4>
        <a v-if="themes.facebook_link !== null && themes.facebook_link !== ''" :href="themes.facebook_link"
           class="btn btn-primary rounded rounded-4 w-100 p-3 mb-2 d-flex align-items-center">
            <i class="fa-brands fa-facebook me-1 fs-4"></i>
            Facebook
        </a>
        <a v-if="themes.instagram_link !== null && themes.instagram_link !== ''" :href="themes.instagram_link"
           class="btn btn-warning rounded rounded-4 w-100 p-3 mb-2 d-flex align-items-center text-white">
            <i class="fa-brands fa-instagram me-1 fs-4"></i>
            Instagram
        </a>
        <a v-if="themes.twitter_link !== null && themes.twitter_link !== ''" :href="themes.twitter_link"
           class="btn btn-info rounded rounded-4 w-100 p-3 mb-2 d-flex align-items-center text-white">
            <i class="fa-brands fa-twitter me-1 fs-4"></i>
            Twitter
        </a>
        <a v-if="themes.youtube_link !== null && themes.youtube_link !== ''" :href="themes.youtube_link"
           class="btn btn-danger rounded rounded-4 w-100 p-3 d-flex align-items-center text-white">
            <i class="fa-brands fa-youtube me-1 fs-4"></i>
            Youtube
        </a>
        <h4 class="mt-3">អត្ថបទពេញនិយម</h4>
        <ul class="list-unstyled">
            <li v-for="post in popularNews" class="mb-3">
                <Link :href="route('detail', post.id)">
                    <div class="d-flex">
                        <img :src="getImage(post.image)" alt="news image">
                        <div class="d-block ms-2">
                            <p class="fw-bold text-truncate-2 text-black">{{ post.title }}</p>
                            <p class="text-grey fs-14 text-truncate-1">{{ post.excerpt }}</p>
                        </div>
                    </div>
                </Link>
            </li>
        </ul>
    </div>
</template>

<script setup>

import {computed} from "vue";
import {usePage, Link} from "@inertiajs/vue3";

const themes = computed(() => usePage().props.themes);
const popularNews = computed(() => usePage().props.popular_news);

</script>
