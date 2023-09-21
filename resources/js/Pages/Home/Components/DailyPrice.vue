<script setup>
import {onMounted, ref} from "vue";
import LvSkeleton from 'lightvue/skeleton';
import axios from "axios";

const body = ref(null);
const parentWidth = window.innerWidth;

onMounted(async () => {
    body.value = await getDailyPrice();
});

async function getDailyPrice() {
    const response = await axios.get(route('home.latest-product') + "?locale=2");
    return response.data;
}

function convertHTMLTableToCSV(tableHTML) {
    const table = document.createElement('table');
    table.innerHTML = tableHTML;
    const rows = table.querySelectorAll('tr');
    const csv = [];
    for (let i = 0; i < rows.length; i++) {
        const row = [];
        const cols = rows[i].querySelectorAll('td, th');
        for (let j = 0; j < cols.length; j++) {
            row.push(cols[j].textContent.trim());
        }

        csv.push(row.join(','));
    }

    return csv.join('\n');
}


async function downloadCSV() {
    const response = await axios.get(route('home.latest-product-export') + "?locale=2");
    const tableHTML = response.data;

    const csvData = convertHTMLTableToCSV(tableHTML);
    const blob = new Blob([csvData], {type: 'text/csv'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'table-data.csv';
    a.style.display = 'none';

    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

</script>

<template>
    <div class="daily-price mt-5">
        <div class="text-center">
            <h3>តម្លៃផលិតផលប្រចាំថ្ងៃ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <a class="text-primary" role="button" @click="downloadCSV()">
            ទាញយក<i class="fa-solid fa-print ms-2"></i>
        </a>
        <div v-if="body" v-html="body"></div>
        <lv-skeleton v-else primaryColor="#f2f2f2" secondaryColor="#ffffff" width="100%" :height="300"/>
    </div>
</template>

<style scoped>
</style>
