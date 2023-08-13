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
                        <tr v-if="documents.length"
                            v-for="item in documents"
                            class="align-middle"
                            @click="openDocument(item.source)"
                            role="button"
                        >
                            <th scope="row">{{ item.kh_created_at }}</th>
                            <td>
                                {{ item.title }}
                            </td>
                            <td>
                                <a v-if="item.type === 'pdf'"
                                   role="button" class="btn btn-primary px-3"
                                   @click="openDocument(item.source)"
                                >
                                    ទាញយក<i class="fa-regular fa-circle-down ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        <tr v-else class="text-center">
                            <td colspan="3">មិនមានទិន្នន័យ!</td>
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
import IntroSection from "@/Components/IntroSection.vue";
import BreadCrumb from "@/Components/BreadCrumb.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    detail: Object,
    documents: Array,
    categories: Array,
});

function openDocument(source) {
    window.open(source, "_blank");
}

</script>

<style scoped>

</style>
