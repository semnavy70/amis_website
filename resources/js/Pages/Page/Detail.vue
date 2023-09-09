<template>
    <App>
        <IntroSection
            :title="page.title"
            background="https://camagrimarket.org/assets/img/rice.jpg"
            background_color="#000000b0"
        />
        <div class="container">
            <BreadCrumb/>
            <div class="row mt-4">

                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <h3 class="d-inline-flex text-green align-items-center">
                        <i class="fa-solid fa-share me-2"></i>
                        {{ page.title }}
                    </h3>
                    <div v-html="page.body"></div>

                    <div v-if="slug === 'contact-us'">
                        <ContactUsForm/>
                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="relate-news">
                        <h5 class="relate-title">អត្ថបទទាក់ទង</h5>
                        <hr class="w-25">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="item in related">
                                <Link :href="route('page.detail' , item.slug)">
                                    {{ item.title }}
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
import IntroSection from "@/Components/IntroSection.vue";
import BreadCrumb from "@/Components/BreadCrumb.vue";
import {Link} from "@inertiajs/vue3";
import ContactUsForm from "../../Components/Form/ContactUsForm.vue";

defineProps({
    page: Object,
    related: Array,
    slug: String,
})

</script>

