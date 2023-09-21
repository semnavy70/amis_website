<script setup>
import {onMounted, ref} from "vue";
import LvSkeleton from 'lightvue/skeleton';
import axios from "axios";

const prefixUrl = "https://tmp.camagrimarket.org/api/website/report/";
const body = ref(null);
const parentWidth = window.innerWidth;

onMounted(async () => {
    body.value = await getDailyPrice();
});

async function getDailyPrice() {
    const response = await axios.get(route('home.latest-product') + "?locale=2");
    return response.data;
}
</script>

<template>
    <div class="daily-price mt-5">
        <div class="text-center">
            <h3>តម្លៃផលិតផលប្រចាំថ្ងៃ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <a class="text-primary" href="#">
            ទាញយក<i class="fa-solid fa-print ms-2"></i>
        </a>
        <div v-if="body" v-html="body"></div>
        <lv-skeleton v-else primaryColor="#f2f2f2" secondaryColor="#ffffff" width="100%" :height="300"/>
    </div>
</template>

<style scoped>

</style>
