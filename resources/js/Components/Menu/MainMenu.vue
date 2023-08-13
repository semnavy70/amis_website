<template>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <Link class="nav-link" :class="{'active': isRoute('home')}" href="/">
                    ទំព័រដើម
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link" :class="{'active': isRoute('news')}" :href="route('news.index')">
                    ព័ត៌មាន & ព្រឹត្តិការណ៍
                </Link>
            </li>
            <li class="nav-item">
                <a href="https://market.camagrimarket.org" target="_self" style="" class="nav-link">
                    ទីផ្សារអនឡាញ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://market.camagrimarket.org/kh/market">បណ្តាញអាជីវកម្ម</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    បណ្ណាល័យ
                </a>
                <ul class="dropdown-menu">

                    <li>
                        <Link class="dropdown-item"
                              :href="route('document.detail', {slug: 'monthly-price-bulletin'})">
                            ព្រឹត្តិបត្រព័ត៌មានតម្លៃ
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item"
                              :href="route('document.detail', {slug: 'other-documents'})">
                            ឯកសារផ្សេងៗ
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item"
                              :href="route('document.detail', {slug: 'ឯកសារកសិកម្ម'})">
                            ឯកសារកសិកម្ម
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item"
                              :href="route('document.detail', {slug: 'video-documentaries'})">
                            វីដេអូឯកសារដាំដំណាំផ្សេងៗ
                        </Link>
                    </li>

                    <li>
                        <p></p>
                    </li>

                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'sms-how-it-works')">
                            ប្រព័ន្ធព័ត៌មានតម្លៃតាមសារជាអក្ស (SMS)
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'sms-service-market')">
                            កូដទីផ្សារ និងកូដផលិតផល
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'sms-subscribe')">
                            របៀបចុះឈ្មោះប្រើប្រព័ន្ធសារជាអក្សរ (SMS)
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'production')">
                            ផលិតកម្ម
                        </Link>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    ការិ.ទីផ្សារ
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'info-about-us')">
                            ការិយាល័យទីផ្សារកសិកម្ម
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'info-agri-market')">
                            សេវាព័ត៌មានទីផ្សារកសិកម្ម
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'camagrimarket')">
                            CamAgriMarket Privacy Policy
                        </Link>
                    </li>
                    <li>
                        <Link class="dropdown-item" :href="route('page.detail', 'info-about-us')">
                            ទាក់ទងមកយើង
                        </Link>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<style scoped>

</style>
