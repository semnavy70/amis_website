<script setup>
import VueHighcharts from 'vue3-highcharts';
import axios from 'axios';
import {computed, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const seriesData = ref([
    {
        name: "---------"
    },
    {
        name: "---------"
    }, {
        name: "---------"
    }
]);
const categories = ref();
const commodities1 = ref();
const commodities2 = ref();
const commodities3 = ref();

const form = useForm({
    category: null,
    commodity1: null,
    commodity2: 0,
    commodity3: 0,
    dataSeries: "WP",
})

onMounted(async () => {
    categories.value = await getCategories();
    if (categories.value && categories.value.length > 0) {
        form.category = categories.value.find(c => c.is_default).code;
        const commodities = await getCommodities(categories.value[0].code);
        form.commodity1 = commodities.find(c => c.is_default)?.code;
        commodities1.value = commodities;
        commodities2.value = commodities;
        commodities3.value = commodities;
        await updateChart();
    }
});

async function getCategories() {
    const response = await axios.get(route('home.categories') + "?language=1");
    return response.data;
}

async function getCommodities(categoryCode) {
    const response = await axios.get(route('home.commodities', categoryCode) + `?language=1`);
    return response.data;
}

async function updateChart() {
    console.log(route('home.price') + `?maxAge=5&locale=2&commodityCode=${form.commodity1}&commodityCode1=${form.commodity2}&commodityCode2=${form.commodity3}&dataseries=${form.dataSeries}`);
    const response = await axios.get(route('home.price') + `?maxAge=5&locale=2&commodityCode=${form.commodity1}&commodityCode1=${form.commodity2}&commodityCode2=${form.commodity3}&dataseries=${form.dataSeries}`);
    const data = response.data;
    const result = [];
    for (const commodityPrice of data) {
        result.push({
            name: commodityPrice.name,
            data: commodityPrice.prices.map((price) => {
                return [Date.parse(price.date), parseInt(price.price)];
            })
        });
    }
    seriesData.value = result;
}

const chartOptions = computed(() => {
    return ({
        chart: {
            type: 'line',
        },
        title: {
            text: form.dataSeries === 'WP' ? 'តម្លៃលក់ដុំ' : 'តម្លៃលក់រាយ',
        },
        xAxis: {
            type: 'datetime',
        },
        yAxis: {
            title: {
                text: 'តម្លៃ(រៀល)',
            },
        },
        series: seriesData.value,
    });
});

function onUpdated() {
    console.log('Chart updated');
}

</script>

<template>
    <div class="trend-price mt-4">
        <div class="text-center">
            <h3>និន្នាការតម្លៃមធ្យម</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <form class="mt-3">
            <div class="bg-white border rounded p-4">
                <div class="row gy-3">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="type" class="form-label">ប្រភេទ</label>
                        <select class="form-select" aria-label="Type" v-model="form.category">
                            <option v-for="item in categories" :value="item.code">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-one" class="form-label">ទំនិញទី១</label>
                        <select class="form-select" v-model="form.commodity1" @change="updateChart">
                            <option v-for="item in commodities1" :value="item.code">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-two" class="form-label">ទំនិញទី២</label>
                        <select class="form-select" v-model="form.commodity2" @change="updateChart">
                            <option value="0">-----------</option>
                            <option v-for="item in commodities2" :value="item.code">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-two" class="form-label">ទំនិញទី៣</label>
                        <select class="form-select" v-model="form.commodity3" @change="updateChart">
                            <option value="0">-----------</option>
                            <option v-for="item in commodities3" :value="item.code">{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="row my-3">
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="WP" id="WP" v-model="form.dataSeries"
                           @change="updateChart">
                    <label class="form-check-label" for="wp">
                        តម្លៃលក់ដុំ
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="RP" id="RP" v-model="form.dataSeries"
                           @change="updateChart">
                    <label class="form-check-label" for="rp">
                        តម្លៃលក់រាយ
                    </label>
                </div>
            </div>
        </div>
        <div class="bg-info text-center" style="width: 100%; height: 200px">
            <vue-highcharts
                type="chart"
                :options="chartOptions"
                :redrawOnUpdate="true"
                :oneToOneUpdate="false"
                :animateOnUpdate="true"
                @updated="onUpdated"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
