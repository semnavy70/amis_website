<script setup>
import {onMounted, ref} from "vue";
import LvSkeleton from 'lightvue/skeleton';
import axios from "axios";

const list = ref(null);
const parentWidth = window.innerWidth;

onMounted(async () => {
    const result = await getDailyPrice();
    const numColumns = 6;
    if (result.length <= 6) {
        list.value = [result];
        return;
    }

    const numRows = Math.ceil(result.length / numColumns);
    const twoDimArray = [];
    for (let i = 0; i < numRows; i++) {
        const row = [];
        for (let j = 0; j < numColumns; j++) {
            const index = i * numColumns + j;
            if (index < result.length) {
                row.push(result[index]);
            }
        }
        twoDimArray.push(row);
    }
    list.value = twoDimArray;
});


async function getDailyPrice() {
    const response = await axios.get(route('home.latest-product') + "?locale=2");
    return response.data;
}

async function downloadCSV() {
    await axios.get(route('home.latest-product-export') + "?locale=2");
}

function getStatusIcon(value) {
    if (!value) {
        return "<span></span>";
    }

    let classes = 'fa-sort-up';
    let styles = 'color:green;';

    if (value === "OVER") {
        classes = 'fa-sort-down';
        styles = 'color:red;';
    }

    return ` <span class="fa ${classes}" style="${styles}"></span>`;
}

</script>

<template>
    <div class="daily-price mt-5">
        <div class="text-center">
            <h3>តម្លៃផលិតផលប្រចាំថ្ងៃ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <a v-if="list?.length" class="text-primary" role="button" @click="downloadCSV()">
            ទាញយក<i class="fa-solid fa-print ms-2"></i>
        </a>
        <div v-if="list?.length" class="row">
            <div v-for="items in list" class="col-md-6 col-sm-12 col-xs-12">
                <table class="table table-striped" id="daily">
                    <thead>
                    <tr>
                        <th>ប្រភេទទំនិញ</th>
                        <th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th>
                        <th style="text-align:right;">តម្លៃ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td>{{ item.name }}</td>
                        <td style="text-align:center;">{{ item.date }}</td>
                        <td style="text-align:right;">
                            <span>{{ item.price }}</span>
                            <span v-html="getStatusIcon(item.status)"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <lv-skeleton v-else primaryColor="#f2f2f2" secondaryColor="#ffffff" width="100%" :height="300"/>
    </div>
</template>

<style scoped>
</style>
