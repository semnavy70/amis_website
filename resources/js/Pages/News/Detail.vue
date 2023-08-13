<template>
    <App>
        <div class="news-detail">
            <div class="container">
                <BreadCrumb/>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                        <p class="detail-title d-inline-flex text-green align-items-center">
                            <i class="fa-solid fa-share me-2"></i>
                            {{ post.title }}
                        </p>
                        <hr>

                        <div v-if="post.image">
                            <img :src="getImage(post.image)" alt="" class="w-100">
                        </div>

                        <div v-html="post.body"></div>
                        <!--                        <div class="bg-primary" style="height: 400px">-->
                        <!--                            <h4 class="text-white">Detail section</h4>-->
                        <!--                        </div>-->

                        <p class="mt-2 fs-14 mt-3">
                            <i class="fa-solid fa-user me-1"></i>
                            <span>{{ post.by }}</span>
                            <span> | {{ post.kh_created_at }}</span>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <RelateNews :list="related"/>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import App from "@/Layouts/App.vue";
import RelateNews from "@/components/RelateNews.vue";
import BreadCrumb from "@/components/BreadCrumb.vue";

defineProps({
    post: Object,
    related: Array,
});

</script>

<style scoped>

</style>
