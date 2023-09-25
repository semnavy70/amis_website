<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="slider-section">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="https://storage.googleapis.com/amis_website/slide-shows/October2018/gX6zICgHroFbYfxD5NwG.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img
                        src="https://storage.googleapis.com/amis_website/slide-shows/October2018/cnUSqdAc2q97foRIEnIw.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img
                        src="https://storage.googleapis.com/amis_website/slide-shows/October2018/YBeN7VpPI2sQ908O3gUg.jpg"
                        class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container pop-on-slide-menu shadow">
            <div class="row text-center py-4 gy-3">
                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                    <Link :href="route('news.index')">
                        <div class="bg-carrot-news d-inline-block p-4 rounded mb-3">
                            <img src="/assets/img/icons/news-icon.png" width="36" alt="">
                        </div>
                        <h5 class="title">ព័ត៌មាន & ព្រឹត្តិការណ៍</h5>
                    </Link>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                    <a href="https://market.camagrimarket.org/kh">
                        <div class="bg-green-online-market d-inline-block p-4 rounded mb-3">
                            <img src="/assets/img/icons/online-market.png" width="36" alt="">
                        </div>
                        <h5 class="title">ទីផ្សារអនឡាញ</h5>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                    <a href="https://market.camagrimarket.org/kh/trader">
                        <div class="bg-red-business-network d-inline-block p-4 rounded mb-3">
                            <img src="/assets/img/icons/record.png" width="36" alt="">
                        </div>
                        <h5 class="title">បណ្តាញអាជីវកម្ម</h5>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                    <Link :href="route('document.detail', {slug: 'monthly-price-bulletin'})">
                        <div class="bg-carrot-news d-inline-block p-4 rounded mb-3">
                            <img src="/assets/img/icons/information.png" width="36" alt="">
                        </div>
                        <h5 class="title">បណ្ណាល័យ</h5>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
