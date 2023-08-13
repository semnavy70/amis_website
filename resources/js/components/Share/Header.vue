<template>
    <div class="bg-app-bar">
        <div class="container py-2">
            <ul class="list-group list-unstyled list-group-horizontal justify-content-end">
                <li>
                    <a href="#">
                        <img src="/assets/img/flag-kh.png" alt="kh-flag" width="30">
                    </a>
                </li>
                <li class="px-2 text-white">|</li>
                <li>
                    <a href="#">
                        <img src="/assets/img/flag-en.png" alt="en-flag" width="30">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="header border-bottom sticky-top">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="logo" src="/assets/img/amis-logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">ទំព័រដើម</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :href="route('news.index')">ព័ត៌មាន & ព្រឹត្តិការណ៍</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://market.camagrimarket.org" target="_self" style="" class="nav-link">
                                ទីផ្សារអនឡាញ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">បណ្តាញអាជីវកម្ម</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                បណ្ណាល័យ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" :href="route('document.index',{slug:'slug'})">ព្រឹត្តិបត្រព័ត៌មានតម្លៃ</a></li>
                                <li><a class="dropdown-item" href="#">ឯកសារផ្សេងៗ</a></li>
                                <li><a class="dropdown-item" href="#">វីដេអូឯកសារដាំដំណាំផ្សេងៗ</a></li>
                                <li><a class="dropdown-item" href="#">ប្រព័ន្ធព័ត៌មានតម្លៃតាមសារជាអក្ស (SMS)</a></li>
                                <li><a class="dropdown-item" href="#">កូដទីផ្សារ និងកូដផលិតផល</a></li>
                                <li><a class="dropdown-item" href="#">របៀបចុះឈ្មោះប្រើប្រព័ន្ធសារជាអក្សរ (SMS)</a></li>
                                <li><a class="dropdown-item" href="#">ផលិតកម្ម</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ការិ.ទីផ្សារ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">ការិយាល័យទីផ្សារកសិកម្ម</a></li>
                                <li><a class="dropdown-item" :href="route('other_page.index', 23)">សេវាព័ត៌មានទីផ្សារកសិកម្ម</a></li>
                                <li><a class="dropdown-item" href="#">CamAgriMarket Privacy Policy</a></li>
                                <li><a class="dropdown-item" :href="route('contact_us.index')">ទាក់ទងមកយើង</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</template>

<script setup>



import route from "../../../../vendor/tightenco/ziggy/src/js";
</script>
