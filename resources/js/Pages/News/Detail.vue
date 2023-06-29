<template>
    <App>
        <div class="news-detail">
            <div class="container">
                <BreadCrumb/>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                        <p class="detail-title d-inline-flex text-green align-items-center">
                            <i class="fa-solid fa-share me-2"></i>
                            ការចុះពិនិត្យ តាមដានការប្រមូលផល និងតម្លៃស្រូវរបស់បងប្អូនប្រជាកសិករនៅខេត្តបាត់ដំបង
                        </p>
                        <hr>
                        <div class="bg-primary" style="height: 400px">
                            <h4 class="text-white">Detail section</h4>
                        </div>
                        <p class="mt-2 fs-14 mt-3">
                            <i class="fa-solid fa-user me-1"></i>
                            <span>Administrator</span>
                            <span>| ថ្ងៃ អង្គារ ទី ២៧ ខែ មិថុនា ឆ្នាំ ២០២៣</span>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <RelateNews
                            title="ស្ថានភាពផលិតកម្ម និងតម្លៃទីផ្សារកសិផលសំខាន់ៗ"
                        />
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<script setup>

import App from "../../Layouts/App.vue";
import RelateNews from "../../components/RelateNews.vue";
import BreadCrumb from "../../components/BreadCrumb.vue";
</script>

<style scoped>

</style>
