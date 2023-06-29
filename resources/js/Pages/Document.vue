<template>
    <App>
        <IntroSection
            title="ព្រឹត្តិបត្រព័ត៌មានតម្លៃ"
            background="https://camagrimarket.org/assets/img/banner4dWritePro.png"
            background_color="#000000b0"
        />
        <div class="container">
            <BreadCrumb/>
            <div class="row mt-4">
                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <h3 class="d-inline-flex text-green align-items-center">
                        <i class="fa-solid fa-share me-2"></i>
                        របាយការណ៍តម្លៃ ពីការិយាល័យទីផ្សារកសិកម្ម
                    </h3>
                    <p>សូមជ្រើសយករបាយការណ៍ប្រចាំខែ ឫប្រចាំឆ្នាំ នៅផ្នែកខាងក្រោមនេះ។ របាយការណ៍ទាំងអស់នេះ ត្រូវបានដាក់បន្ថែមជាប្រចាំ ហើយលោកអ្នកអាចទាញយកបាន ជាឯកសារ PDF។</p>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="table-secondary">
                            <th scope="col" class="py-3">កាលបរិច្ឆេទ</th>
                            <th scope="col" class="py-3">ចំណងជើង</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in 5" class="align-middle">
                            <th scope="row">០៤ មេសា ២០២០</th>
                            <td>
                                <a href="#">
                                    ព្រឹត្តិបត្រព័ត៌មានតម្លៃប្រចាំខែកុម្ភៈ ឆ្នាំ២០២០
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary px-3">
                                    ទាញយក<i class="fa-regular fa-circle-down ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <RelateNews
                        main_title="ប្រភពឯកសារ"
                        title="វីដេអូឯកសារដាំដំណាំផ្សេងៗ"
                    />
                </div>
            </div>
        </div>
        <div class="text-center" style="margin-top: 40vh">
             <a href="https://camagrimarket.org/document/monthly-price-bulletin"><h1>Document</h1></a>
        </div>
    </App>
</template>

<script setup>
import App from "../Layouts/App.vue";
import IntroSection from "../components/IntroSection.vue";
import RelateNews from "../components/RelateNews.vue";
import BreadCrumb from "../components/BreadCrumb.vue";
</script>

<style scoped>

</style>
