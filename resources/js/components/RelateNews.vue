<template>
    <div class="relate-news">
        <h5 class="relate-title">{{ main_title ?? "អត្ថបទទាក់ទង" }}</h5>
        <hr class="w-25">
        <ul class="list-group">
            <li class="list-group-item" v-for="item in list">
                <Link :href="route('news.detail' , item.id)">
                    {{ item.title }}
                </Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    main_title: String,
    list: String,
});

</script>

<style>
.relate-news {
    .relate-title {
        font-size: 24px;
    }

    .list-group {
        .list-group-item {
            ::before {
                content: "\f101";
                font-family: FontAwesome, sans-serif;
                display: inline-block;
                font-size: 14px;
                padding-right: 4px;
            }

        }
    }
}
</style>
