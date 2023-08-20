<template>
    <App>
        <IntroSection
            title="ព័ត៌មាន & ព្រឹត្តិការណ៍"
            background="https://camagrimarket.org/assets/img/news.jpg"
            background_color="#fe660140"
        />

        <div class="container mt-3">
            <BreadCrumb title="ព័ត៌មាន & ព្រឹត្តិការណ៍"/>

            <div class="news-section mt-5">
                <div class="row gy-4">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4" v-for="post in paginate.data">
                        <NewsCard :post="post"/>
                    </div>
                </div>
            </div>

            <Pagination v-if="paginate.total" :links="paginate.links"></Pagination>
        </div>
    </App>
</template>

<script setup>
import App from "@/Layouts/App.vue";
import IntroSection from "@/Components/IntroSection.vue";
import Pagination from "@/Components/Pagination.vue";
import NewsCard from "@/Components/NewsCard.vue";
import BreadCrumb from "@/Components/BreadCrumb.vue";

defineProps({
    paginate: Object,
});
</script>

<style scoped>

</style>
