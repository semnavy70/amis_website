<template>
    <img class="w-100 mt-5" src="/assets/img/footer-img.svg" alt="footer-frame">
    <div class="footer p-3">
        <div class="container">
            <div class="row align-items-start">

                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <h4>តំណទៅទំព័រសំខាន់ៗ</h4>
                    <hr class="w-25 border-2 opacity-75">
                    <ul>
                        <!--<FooterMenuItem
                            name="កម្មវិធីផ្សព្វផ្សាយបចេ្ចកទេសកសិកម្មថ្មីដែលធន់ទៅនឹងការប្រែប្រួលអាកាសធាតុ"
                            address="https://aspirekh.org/"
                        />-->
                        <FooterMenuItem
                            name="ក្រសួងកសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ"
                            address="https://www.maff.gov.kh/"
                        />
                        <FooterMenuItem
                            name="បណ្ណាល័យអេឡិចត្រូនិចក្រសួងកសិកម្ម រុក្ខាប្រមាញ់និងនេសាទ"
                            address="https://elibrary.maff.gov.kh/"
                        />
                        <!--<FooterMenuItem
                            name="ក្រុមប្រឹក្សាស្តារអភិវឌ្ឍន៍វិស័យកសិកម្ម និងជនបទ"
                            address="https://card.gov.kh/"
                        />-->
                        <!--<FooterMenuItem
                            name="ក្រសួងផែនការ"
                            address="https://www.mop.gov.kh/"
                        /> 
                        <FooterMenuItem
                            name="ផ្សេងៗ ទៀត"
                            :url="route('page.detail', {slug: 'links'})"
                        />-->
                    </ul>
                </div>

                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <h4>ព័ត៌មានទីផ្សារកសិកម្ម</h4>
                    <hr class="w-25 border-2 opacity-75">
                    <ul>
                        <FooterMenuItem
                            name="សេវាព័ត៌មានទីផ្សារកសិកម្ម"
                            :url="route('news.detail', 81)"
                        />
                        <FooterMenuItem
                            name="ព័ត៌មានទីផ្សារ"
                            :url="route('news.detail', 82)"
                        />
                        <FooterMenuItem
                            name="ការអភិវឌ្ឍទីផ្សារកសិកម្ម"
                            :url="route('news.detail', 83)"
                        />
                        <FooterMenuItem
                            name="ទិន្នន័យផលិតកម្មកសិកម្ម"
                            :url="route('page.detail', {slug: 'production'})"
                        />
                    </ul>
                </div>

                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <h4>ការិយាល័យទីផ្សារកសិកម្ម</h4>
                    <hr class="w-25 border-2 opacity-75">
                    <ul>
                        <FooterMenuItem
                            name="អំពីការិយាល័យទីផ្សារកសិកម្ម"
                            :url="route('news.detail', 73)"
                        />
                        <FooterMenuItem
                            name="ប្រវតិ្ត"
                            :url="route('news.detail', 74)"
                        />
                        <FooterMenuItem
                            name="សកម្មភាព"
                            :url="route('news.detail', 75)"
                        />
                        <FooterMenuItem
                            name="បុគ្គលិកការិយាល័យទីផ្សារកសិកម្មនៅតាមខេត្ត"
                            :url="route('news.detail', 76)"
                        />
                        <FooterMenuItem
                            name="មន្រ្ដីការិយាល័យកណ្ដាល"
                            :url="route('news.detail', 77)"
                        />
                        <FooterMenuItem
                            name="បុគ្គលិកប្រមូល ចែកចាយតម្លៃ និងទីតាំង"
                            :url="route('news.detail', 78)"
                        />
                    </ul>
                </div>

                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <h5>អាសយដ្ឋាន</h5>
                    <hr class="w-25 border-2 opacity-75">
                    <p>
                            <span>
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                        #200, មហាវិថីព្រះនរោត្តម, សង្កាត់ទន្លេបាសាក់, ខណ្ឌចំការមន, រាជធានីភ្នំពេញ, ប្រទេសកម្ពុជា
                    </p>
                    <p>
                        <i class="fas fa-mobile"></i>
                        <a class="text-white ms-1" href="https://t.me/camgrimarket">តេលេក្រាម៖ សេវាព័ត៌មានទីផ្សារកសិកម្ម</a>
                    </p>
                    <p class="d-flex">
                        <i class="fas fa-envelope mt-1"></i>
                        <a class="text-white ms-1" href="https://amis.maff.gov.kh/page/contact-us">
                            <span class="text-break">agrimarketinfo@gmail.com</span>
                        </a>
                    </p>
                    <p>
                        <i class="fab fa-facebook-square"></i>
                        <a class="text-white ms-1" href="https://www.facebook.com/profile.php?id=100009150599278">AMIS
                            Facebook </a>
                    </p>
                    <p>
                        <i class="fas fa-users"></i>
                        ចំនួនអ្នកទស្សនា: 364
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="copy-right text-center text-white p-3">
        <p class="mb-0">Copyrights © 2023 All Rights Reserved</p>
    </div>

</template>

<script setup>
import FooterMenuItem from "@/Components/Menu/FooterMenuItem.vue";

</script>
