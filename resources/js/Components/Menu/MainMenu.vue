<template>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <MenuItem
                name="ទំព័រដើម"
                :url="route('home.index')"
                activeRoute="home"
            />
            <MenuItem
                name="ព័ត៌មាន & ព្រឹត្តិការណ៍"
                :url="route('news.index')"
                activeRoute="news"
            />
            <MenuItem
                name="ទីផ្សារអនឡាញ"
                address="https://market.camagrimarket.org"
            />
            <MenuItem
                name="បណ្តាញអាជីវកម្ម"
                address="https://market.camagrimarket.org"
            />

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    បណ្ណាល័យ
                </a>
                <ul class="dropdown-menu">
                    <SubMenuItem
                        name="ព្រឹត្តិបត្រព័ត៌មានតម្លៃ"
                        :url="route('document.detail', {slug: 'monthly-price-bulletin'})"
                    />
                    <SubMenuItem
                        name="ឯកសារផ្សេងៗ"
                        :url="route('document.detail', {slug: 'other-documents'})"
                    />
                    <SubMenuItem
                        name="ឯកសារកសិកម្ម"
                        :url="route('document.detail', {slug: 'ឯកសារកសិកម្ម'})"
                    />
                    <SubMenuItem
                        name="វីដេអូឯកសារដាំដំណាំផ្សេងៗ"
                        :url="route('document.detail', {slug: 'video-documentaries'})"
                    />

                    <SubMenuItem
                        name="ប្រព័ន្ធព័ត៌មានតម្លៃតាមសារជាអក្ស (SMS)"
                        :url="route('page.detail', {slug: 'sms-how-it-works'})"
                    />
                    <SubMenuItem
                        name="កូដទីផ្សារ និងកូដផលិតផល"
                        :url="route('page.detail', {slug: 'sms-service-market'})"
                    />
                    <SubMenuItem
                        name="របៀបចុះឈ្មោះប្រើប្រព័ន្ធសារជាអក្សរ (SMS)"
                        :url="route('page.detail', {slug: 'sms-subscribe'})"
                    />
                    <SubMenuItem
                        name="ផលិតកម្ម"
                        :url="route('page.detail', {slug: 'production'})"
                    />
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    ការិ.ទីផ្សារ
                </a>
                <ul class="dropdown-menu">
                    <SubMenuItem
                        name="ការិយាល័យទីផ្សារកសិកម្ម"
                        :url="route('page.detail', {slug: 'info-about-us'})"
                    />
                    <SubMenuItem
                        name="សេវាព័ត៌មានទីផ្សារកសិកម្ម"
                        :url="route('page.detail', {slug: 'info-agri-market'})"
                    />
                    <SubMenuItem
                        name="CamAgriMarket Privacy Policy"
                        :url="route('page.detail', {slug: 'camagrimarket'})"
                    />
                    <SubMenuItem
                        name="ទាក់ទងមកយើង"
                        :url="route('page.detail', {slug: 'contact-us'})"
                    />
                </ul>
            </li>
            <li class="nav-item">
                <SearchBox/>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import SubMenuItem from "@/Components/Menu/SubMenuItem.vue";
import MenuItem from "@/Components/Menu/MenuItem.vue";
import SearchBox from "@/Components/Menu/SearchBox.vue";


</script>

<style scoped>

</style>
