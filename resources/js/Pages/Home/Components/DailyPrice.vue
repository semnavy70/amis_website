<script setup>
import {onMounted, ref} from "vue";
import LvSkeleton from 'lightvue/skeleton';
import axios from "axios";

const list = ref(null);
const isLoading = ref(true);
const canNext = ref(true);
const page = ref(0);

onMounted(async () => {
    loadData();
});

async function loadData() {
    isLoading.value = true;
    await loadDailyPrice();
    isLoading.value = false;
}

async function loadDailyPrice() {
    const oldValue = list.value;
    list.value = null;
    canNext.value = true;

    const result = await getDailyPrice();
    if (result.length === 0) {
        canNext.value = false;
        if (page.value > 1) {
            page.value -= 1;
        }
        list.value = oldValue;
        return;
    }

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
    return list.value;
}


async function getDailyPrice() {
    const response = await axios.get(route('home.latest-product') + `?locale=2&page=${page.value}`);
    return response.data;
}

async function downloadCSV() {
    await axios.get(route('home.latest-product-export') + `?locale=2&page=${page.value}`);
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

async function next() {
    if (isLoading.value) {
        return;
    }
    isLoading.value = true;
    page.value += 1;
    await loadDailyPrice();
    isLoading.value = false;
}

async function back() {
    if (isLoading.value) {
        return;
    }
    isLoading.value = true;
    page.value -= 1;
    await loadDailyPrice();
    isLoading.value = false;
}

</script>

<template>
    <div class="daily-price mt-5">
        <div class="text-center">
            <h3>តម្លៃផលិតផលប្រចាំថ្ងៃ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>

        <!--Download-->
        <div class="text-end mb-2">
            <div v-if="list?.length"
                 class="text-primary"
                 role="button"
                 @click="downloadCSV()"
            >
                ទាញយក<i class="fa-solid fa-print ms-2"></i>
            </div>
            <div v-else>
                <LvSkeleton
                    primaryColor="#f2f2f2"
                    secondaryColor="#ffffff"
                    :width=80
                    :height=30
                />
            </div>
        </div>

        <!-- Table -->
        <div>
            <div v-if="list?.length" class="row">
                <div v-for="(items, index) in list" class="col-md-6 col-sm-12 col-xs-12">
                    <table class="table table-striped" :id="'daily-'+ index ">
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
            <div v-else>
                <LvSkeleton
                    primaryColor="#f2f2f2"
                    secondaryColor="#ffffff"
                    width="100%"
                    :height="300"
                />
            </div>
        </div>

        <!-- Paginate -->
        <div>
            <div v-if="list?.length" class="row">
                <div class="col-6">
                    <div
                        v-if="page > 0"
                        role="button"
                        class="text-start text-secondary"
                        @click="back()"
                    >
                        <i class="fas fa-angle-double-left"></i> ត្រឡប់
                    </div>
                </div>
                <div class="col-6">
                    <div
                        v-if="canNext"
                        role="button"
                        class="text-end text-secondary"
                        @click="next()"
                    >
                        បន្ទាប់ <i class="fas fa-angle-double-right"></i>
                    </div>
                </div>
            </div>
            <div v-else class="row mt-2">
                <div class="col-6">
                    <div class="text-start">
                        <LvSkeleton
                            primaryColor="#f2f2f2"
                            secondaryColor="#ffffff"
                            :width=70
                            :height=30
                        />
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-end">
                        <LvSkeleton
                            primaryColor="#f2f2f2"
                            secondaryColor="#ffffff"
                            :width=70
                            :height=30
                        />
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
</style>
