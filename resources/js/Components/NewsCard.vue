<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
  post: Object,
});

</script>

<template>
  <div class="news-card">
    <Link :href="route('news.detail' , post.id)">
      <div class="bg-white p-3 shadow">
        <img class="w-100" :src="getImage(post.image)" alt="">
        <p class="text-green fs-18 my-2 text-truncate-2">{{ post.title }}</p>
        <div class="small-hr my-2"/>
        <p class="mt-2 fs-14">
          <i class="fa-solid fa-user me-1"></i>
          <span>{{ post.by }}</span>
          <span> | {{ post.kh_created_at }}</span>
        </p>
        <p class="fs-16 text-truncate-3">{{ post.excerpt }}</p>
        <div class="text-end">
          <Link :href="route('news.detail' , post.id)" class="text-green">
            អានបន្ត<i class="fa-solid fa-angles-right"></i>
          </Link>
        </div>
      </div>
    </Link>
  </div>
</template>

<style scoped>

</style>
