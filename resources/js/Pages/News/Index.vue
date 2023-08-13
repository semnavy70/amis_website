<template>
    <App>
        <IntroSection
            title="ព័ត៌មាន & ព្រឹត្តិការណ៍"
            background="https://camagrimarket.org/assets/img/news.jpg"
            background_color="#fe660140"
        />
        <div class="container mt-3">
            <div class="bg-white p-3 shadow">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <Link href="/">ទំព័រដើម</Link>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">ព័ត៌មាន & ព្រឹត្តិការណ៍</li>
                    </ol>
                </nav>
            </div>
            <div class="news-section mt-5">
                <div class="row gy-4">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4" v-for="post in paginate.data">
                        <Link :href="route('news.detail' , post.id)">
                            <div class="bg-white p-3 shadow">
                                <img class="w-100" :src="getImage(post.image)" alt="">
                                <p class="text-green fs-18 mb-1">{{ post.title }}</p>
                                <div class="small-hr my-2"/>
                                <p class="mt-2 fs-14">
                                    <i class="fa-solid fa-user me-1"></i>
                                    <span>{{ post.by }}</span>
                                    <span> | {{ post.kh_created_at }}</span>
                                </p>
                                <p class="fs-16">{{ post.excerpt }}</p>
                                <div class="text-end">
                                    <Link :href="route('news.detail' , post.id)" class="text-green">
                                        អានបន្ត<i class="fa-solid fa-angles-right"></i>
                                    </Link>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>

            <Pagination v-if="paginate.total" :links="paginate.links"></Pagination>
        </div>
    </App>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import App from "@/Layouts/App.vue";
import IntroSection from "@/Components/IntroSection.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    paginate: Object,
})
</script>

<style scoped>

</style>
