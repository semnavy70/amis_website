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
  const response = await axios.get(route('home.highlight-news'));
  return response.data;
}

</script>

<template>
  <div v-if="news != null" class="row gy-3">
    <Link :href="route('news.detail' , news.id)">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 bg-white p-3 rounded-4">
        <div class="text-center">
          <h4 class="text-green text-truncate-2">{{ news.title }}</h4>
          <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <img class="w-100 py-2"
             :src="getImage(news.image)"
             alt=""
        />
      </div>
    </Link>
  </div>
  <div v-else>
    <LvSkeleton
        primaryColor="#f2f2f2"
        secondaryColor="#ffffff"
        width="100%"
        height="200"
    />
  </div>
</template>

<style scoped>

</style>


<!--    <div class="col-12 col-sm-12 col-md-6 col-lg-6 bg-white p-3 rounded-4">-->
<!--      <div class="text-center">-->
<!--        <h4 class="text-green">ស្ថានភាពផលិតកម្ម និងតម្លៃទីផ្សារកសិផលសំខាន់ៗ</h4>-->
<!--        <div class="small-hr my-1 d-inline-flex"/>-->
<!--      </div>-->
<!--      <div class="container mt-3">-->
<!--        <div class="row g-4">-->
<!--          <div class="col-4">-->
<!--            <img class="w-100"-->
<!--                 src="https://storage.googleapis.com/amis_website/posts/WeeklyPrice/26.jpg"-->
<!--                 alt="">-->
<!--          </div>-->
<!--          <div class="col-8 text-end">-->
<!--            <p class="text-start">ការិយាល័យទីផ្សារកសិកម្ម-->
<!--              សូមជូនតារាងតម្លៃសំខាន់ៗប្រចាំសប្ដាហ៍ទី២ ខែមិថុនា ឆ្នាំ២០២៣</p>-->
<!--            <a href="#" class="text-primary text-end">-->
<!--              អានបន្ត<i class="fa-solid fa-angles-right fs-14"></i>-->
<!--            </a>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
