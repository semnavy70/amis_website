<template>
    <App>
        <IntroSection
            title="ទាក់ទងមកយើង"
            background="https://camagrimarket.org/assets/img/rice.jpg"
            background_color="#000000b0"
        />
        <div class="contact-us ">
            <div class="container">
                <BreadCrumb/>
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                        <p class="lh-base">
                            សូមរកមើលសេចក្តីពិស្តារ អំពីអាសយដ្ឋានទំនាក់ទំនង សម្រាប់ ការិយាល័យពាក់ព័ន្ធដែលស្ថិតនៅក្រោមចំណុះក្រសួងកសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទនៅខាងក្រោមនេះ។
                        </p>
                        <p class="lh-base">
                            លោកអ្នកអាចរកមើលសេចក្តីពិស្តារ អំពីអាសយដ្ឋានទំនាក់ទំនង របស់ស្ថាប័នពាក់ព័ន្ធផ្សេងៗ នៃព័ត៌មានទីផ្សារកសិកម្ម តាមរយៈរបាភ្ជាប់ទៅទំព័រផ្សេងៗ ដែលស្ថិតនៅផ្នែកខាងឆ្វេង នៃទំព័រនេះ។
                        </p>
                        <h3 class="d-inline-flex text-green align-items-center">
                            <i class="fa-solid fa-share me-2"></i>
                            ការិយាល័យទីផ្សារកសិកម្ម
                        </h3>
                        <p>បន្ទប់លេខ ២.៧ ជាន់ទី១នៃអាគារនាយកដ្ឋានផែនការ និងស្ថិតិ ក្រសួងកសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ លេខ២០០ មហាវិថីព្រះនរោត្តម សង្កាត់ទន្លេបាសាក់ ខណ្ឌចំការមន ភ្នំពេញ កម្ពុជា។</p>
                        <p>ប្រអប់សំបុត្រលេខ ១២៣០១</p>
                        <ul class="contact-by">
                            <li>ទូរស័ព្ទ:<a href="callto:+85523216060">+855 (0) 23 216 060/060 96 5100</a></li>
                            <li>ទូរសារ: +855 (0) 23 216 060</li>
                            <li>អ៊ីមែល:<a href="mailto:agrimarketinfo@gmail.com">agrimarketinfo@gmail.com</a></li>
                            <li>ហ្វេសបុកៈ <a href="https://www.facebook.com/ការិយាល័យទីផ្សារកសិកម្ម-261717890860228/">ការិយាល័យទីផ្សារកសិកម្ម</a></li>
                        </ul>
                        <h3 class="d-inline-flex text-green align-items-center mt-5">
                            <i class="fa-solid fa-share me-2"></i>
                            សំណុំបែបបទសំណួរ
                        </h3>
                        <div class="mt-3 bg-white p-5 shadow rounded">
                            <div class="form">
                                <div class="row mb-3">
                                    <label for="name" class="col-3 col-form-label">ឈ្មោះ</label>
                                    <div class="col">
                                        <input type="text" placeholder="ឈ្មោះ" class="form-control" id="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-3 col-form-label">សារអេឡិកត្រូនិច</label>
                                    <div class="col">
                                        <input type="email" placeholder="សារអេឡិកត្រូនិច" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="message" class="col-3 col-form-label">សារ</label>
                                    <div class="col">
                                        <textarea class="form-control" placeholder="សារ" id="floatingTextarea2">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="question" class="col-3 col-form-label">តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា?</label>
                                    <div class="col">
                                        <input type="text" placeholder="តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា" class="form-control" id="question">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a class="btn btn-outline-success px-5" href="#">
                                        បញ្ជូន
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <RelateNews
                            title="ស្ថានភាពផលិតកម្ម និងតម្លៃទីផ្សារកសិផលសំខាន់ៗ"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center d-none" style="margin-top: 40vh">
             <a href="https://camagrimarket.org/page/contact-us"><h1>ContactUs</h1></a>
        </div>
    </App>
</template>

<script setup>

import App from "../Layouts/App.vue";
import IntroSection from "../components/IntroSection.vue";
import BreadCrumb from "../components/BreadCrumb.vue";
import RelateNews from "../components/RelateNews.vue";
</script>

<style scoped>
</style>
