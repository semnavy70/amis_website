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
                        <li class="breadcrumb-item"><a href="#">ទំព័រដើម</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ព័ត៌មាន & ព្រឹត្តិការណ៍</li>
                    </ol>
                </nav>
            </div>
            <div class="news-section mt-5">
                <div class="row gy-4">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4" v-for="item in 6">
                        <a :href="route('news.detail' , '12')">
                            <div class="bg-white p-3 shadow">
                                <img class="w-100" src="https://storage.googleapis.com/amis_website/posts/WeeklyPrice/36.jpg" alt="">
                                <p class="text-green fs-18 mb-1">ស្ថានភាពផលិតកម្ម និងតម្លៃទីផ្សារកសិផលសំខាន់ៗ</p>
                                <div class="small-hr my-2"/>
                                <p class="mt-2 fs-14">
                                    <i class="fa-solid fa-user me-1"></i>
                                    <span>Administrator</span>
                                    <span>| ថ្ងៃ អង្គារ ទី ២៧ ខែ មិថុនា ឆ្នាំ ២០២៣</span>
                                </p>
                                <p class="fs-16">ការិយាល័យទីផ្សារកសិកម្ម សូមជូនតារាងតម្លៃសំខាន់ៗប្រចាំសប្ដាហ៍ទី៣ ខែមិថុនា ឆ្នាំ២០២៣</p>
                                <div class="text-end">
                                    <a href="#" class="text-green">
                                        អានបន្ត<i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">ថយក្រោយ</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link text-green" href="#">បន្ទាប់</a></li>
                </ul>
            </nav>
        </div>
    </App>
</template>

<script setup>

import App from "../../Layouts/App.vue";
import IntroSection from "../../components/IntroSection.vue";
</script>

<style scoped>

</style>
