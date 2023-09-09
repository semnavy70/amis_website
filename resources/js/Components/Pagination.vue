<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    links: Array,
});

function cleanLabelPagination(label) {
    label = label.replace("Previous", "ថយក្រោយ");
    label = label.replace("Next", "បន្ទាប់");
    label = label.replace("«", "");
    label = label.replace("»", "");

    return label;
}


function navigate(url) {
    const page = getParameterByName('page', url);
    const queryArray = queryConvert();
    const newQuery = queryArray.concat({page: page});
    const serializeParam = serialize(newQuery);
    const newUrl = window.location.origin + window.location.pathname + "?" + serializeParam;

    Inertia.get(newUrl, {}, {preserveScroll: true});
}

function queryConvert() {
    let queryStr = window.location.search,
        queryArr = queryStr.replace('?', '').split('&'),
        queryParams = [];

    for (let q = 0, qArrLength = queryArr.length; q < qArrLength; q++) {
        const qArr = queryArr[q].split('=');
        const key = qArr[0];
        if (key === "page") {
            continue;
        }
        const value = qArr[1];
        const obj = {};
        obj[key] = value;

        queryParams.push(obj);
    }


    return queryParams;
}

function getParameterByName(name, url) {
    name = name.replace(/[\[\]]/g, '\\$&');
    let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function serialize(obj) {
    const str = [];
    for (const p of obj) {
        const key = Object.keys(p)[0];
        const value = p[key];
        str.push(encodeURIComponent(key) + "=" + encodeURIComponent(value));
    }

    return str.join("&");
}

</script>

<template>
    <!--    <nav class="mt-4">-->
    <!--                <ul class="pagination justify-content-center">-->
    <!--                    <li class="page-item"><a class="page-link" href="#">ថយក្រោយ</a></li>-->
    <!--                    <li class="page-item"><a class="page-link" href="#">1</a></li>-->
    <!--                    <li class="page-item"><a class="page-link" href="#">2</a></li>-->
    <!--                    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
    <!--                    <li class="page-item"><a class="page-link text-green" href="#">បន្ទាប់</a></li>-->
    <!--                </ul>-->
    <!--            </nav>-->
    <!--    -->

    <nav class="mt-4">
        <ul v-if="links.length > 3" class="pagination justify-content-center">
            <li class="page-item" v-for="link in links">
                <Link class="page-link" :class="link.active ? 'active' : ''" @click="navigate(link.url)"
                      v-html="cleanLabelPagination(link.label)"
                      v-if="link.url"
                />
                <span class="page-link" v-else v-html="cleanLabelPagination(link.label)"></span>
            </li>
        </ul>
    </nav>
</template>
