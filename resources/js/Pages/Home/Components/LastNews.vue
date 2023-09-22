<script setup>
import LvSkeleton from 'lightvue/skeleton';
import axios from 'axios';
import {onMounted, ref} from "vue";
import {Link} from '@inertiajs/vue3';

const isLoading = ref(true);
const news = ref();


onMounted(async () => {
  loadData();
});

async function loadData() {
  isLoading.value = true;
  news.value = await getNews();
  isLoading.value = false;
}

async function getNews() {
  const response = await axios.get(route('home.latest-news'));
  return response.data;
}

</script>

<template>
  <div class="latest-news mt-5">
    <div class="text-center">
      <h3>ព័ត៌មានចុងក្រោយ</h3>
      <div class="small-hr my-1 d-inline-flex"/>
    </div>

    <div v-if="news?.length" class="row mt-3 gy-3">
      <div v-for="post in news" class="col-12 col-sm-12 col-md-6 col-lg-4">
        <Link :href="route('news.detail' , post.id)">
          <div class="bg-white p-3 shadow">
            <img class="w-100" :src="getImage(post.image)"
                 alt="news-thumbnail">
            <p class="text-green fs-18 text-truncate-2">{{ post.title }}</p>
            <hr class="w-25 text-green text-truncate-3"/>
            <p>{{ post.excerpt }}</p>
          </div>
        </Link>

      </div>
    </div>
    <div v-else>
      <LvSkeleton
          primaryColor="#f2f2f2"
          secondaryColor="#ffffff"
          width="100%"
          height="200"
      />
    </div>

  </div>
</template>

<style scoped>

</style>
