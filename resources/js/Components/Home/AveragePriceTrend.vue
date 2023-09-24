<script setup>
import VueHighcharts from 'vue3-highcharts';
import LvSkeleton from 'lightvue/skeleton';
import axios from 'axios';
import {computed, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import DatePicker from "@/Components/DatePicker.vue";

const seriesData = ref([
  {
    name: "---------"
  },
]);
const isLoading = ref(true);
const categories = ref();
const commodities = ref();
const endDate = ref((new Date()));
const startDate = ref(new Date());
startDate.value.setFullYear(endDate.value.getFullYear() - 1);

const form = useForm({
  category: null,
  commodityCode: null,
  dataSeries: "WP",
})

onMounted(async () => {
  loadData();
});


async function loadData() {
  isLoading.value = true;
  categories.value = await getCategories();
  if (categories.value && categories.value.length > 0) {
    form.category = categories.value.find(item => item.is_default).code;
    await getCommoditiesByCategory();
  }
  isLoading.value = false;
}

async function getCommoditiesByCategory() {
  isLoading.value = true;
  form.commodityCode = null;
  commodities.value = null;

  const commoditiesList = await getCommodities(form.category);
  commodities.value = commoditiesList;
  form.commodityCode = commoditiesList.find(item => item.is_default)?.code ?? commoditiesList[0].code;

  await updateChart();
  isLoading.value = false;
}

async function getCategories() {
  const response = await axios.get(route('home.categories') + "?language=1");
  return response.data;
}

async function getCommodities(categoryCode) {
  const response = await axios.get(route('home.commodities', categoryCode) + `?language=1`);
  return response.data;
}

async function updateStartDate(newDate) {
  startDate.value = newDate;
  await updateChart();
}

async function updateEndDate(newDate) {
  endDate.value = newDate;
  await updateChart();
}

function formatDateForSQL(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');

  return `${year}-${month}-${day}`;
}

const requestUrl = computed(() => {
  const commodityParam = `commodityCode=${form.commodityCode}`;
  const dataSeriesParam = `dataseries=${form.dataSeries}`;
  const dateParam = `startDate=${formatDateForSQL(startDate.value)}&endDate=${formatDateForSQL(endDate.value)}`;
  return route('home.price') + `?locale=2&${commodityParam}&${dataSeriesParam}&${dateParam}`;
});

async function updateChart() {
  isLoading.value = true;
  console.log({requestUrl: requestUrl.value});

  const response = await axios.get(requestUrl.value);
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
  isLoading.value = false;
}

const chartOptions = computed(() => {
  return {
    chart: {
      type: 'line',
    },
    title: {
      text: (form.dataSeries === 'WP') ? 'តម្លៃលក់ដុំ' : 'តម្លៃលក់រាយ',
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
  };
});

function onUpdated() {
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
            <select
                class="form-select"
                aria-label="Type"
                v-model="form.category"
                @change="getCommoditiesByCategory()"
                :disabled="isLoading"
            >
              <option v-for="item in categories" :value="item.code">
                {{ item.name }}
              </option>
            </select>
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3">
            <label for="product-one" class="form-label">ទំនិញ</label>
            <select
                class="form-select"
                v-model="form.commodityCode"
                @change="updateChart"
                :disabled="isLoading"
            >
              <option v-for="item in commodities" :value="item.code">{{ item.name }}</option>
            </select>
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3">
            <label for="product-two" class="form-label">ចាប់ពី</label>
            <DatePicker
                v-model="startDate"
                @update:modelValue="updateStartDate"
                :disabled="isLoading"
            />
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3">
            <label for="product-two" class="form-label">ដល់</label>
            <DatePicker
                v-model="endDate"
                @update:modelValue="updateEndDate"
                :disabled="isLoading"
            />
          </div>
        </div>
      </div>
    </form>
    <div class="row my-3">
      <div class="col-auto">
        <div class="form-check">
          <input
              class="form-check-input"
              type="radio"
              value="WP"
              id="WP"
              v-model="form.dataSeries"
              @change="updateChart"
              :disabled="isLoading"
          >
          <label class="form-check-label" for="wp">
            តម្លៃលក់ដុំ
          </label>
        </div>
      </div>
      <div class="col-auto">
        <div class="form-check">
          <input
              class="form-check-input"
              type="radio"
              value="RP"
              id="RP"
              v-model="form.dataSeries"
              @change="updateChart"

              :disabled="isLoading"
          >
          <label class="form-check-label" for="rp">
            តម្លៃលក់រាយ
          </label>
        </div>
      </div>
    </div>

    <div>
      <div v-if="!isLoading" class="text-center" style="width: 100%;">
        <VueHighcharts
            type="chart"
            :options="chartOptions"
            :redrawOnUpdate="true"
            :oneToOneUpdate="false"
            :animateOnUpdate="true"
            @updated="onUpdated"
        />
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

  </div>
</template>

<style scoped>
</style>
