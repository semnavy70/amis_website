<template>
    <App>
        <IntroSection
            :title="detail.name"
            background="https://camagrimarket.org/assets/img/banner4dWritePro.png"
            background_color="#000000b0"
        />
        <div class="container">
            <BreadCrumb :title="detail.name"/>
            <div class="row mt-4">
                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <h3 class="d-inline-flex text-green align-items-center">
                        <i class="fa-solid fa-share me-2"></i>
                        {{ detail.name }}
                    </h3>

                    <p v-html="detail.description"></p>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="table-secondary">
                            <th scope="col" class="py-3">កាលបរិច្ឆេទ</th>
                            <th scope="col" class="py-3">ចំណងជើង</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in documents" class="align-middle">
                            <th scope="row">០៤ មេសា ២០២០</th>
                            <td>
                                <a href="#">
                                    {{ item.title }}
                                </a>
                            </td>
                            <td>
                                <a v-if="item.type === 'pdf'" href="#" class="btn btn-primary px-3">
                                    ទាញយក<i class="fa-regular fa-circle-down ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="relate-news">
                        <h5 class="relate-title">ប្រភពឯកសារ</h5>
                        <hr class="w-25">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="item in categories">
                                <Link :href="route('document.detail' , item.slug)">
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<script setup>
import App from "@/Layouts/App.vue";
import IntroSection from "@/components/IntroSection.vue";
import BreadCrumb from "@/components/BreadCrumb.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    detail: Object,
    documents: Array,
    categories: Array,
})

</script>

<style scoped>

</style>
