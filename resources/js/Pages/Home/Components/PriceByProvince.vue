<script setup>
import {computed, onMounted, ref} from "vue";
import axios from "axios";
import {useForm} from "@inertiajs/vue3";
import LvSkeleton from "lightvue/skeleton";

const data = ref(null);
const now = new Date();
const isLoading = ref(true);
const form = useForm({
  dataSeries: "WP",
});

onMounted(async () => {
  updatePrice();
});

const requestUrl = computed(() => {
  return route('home.monthly', [form.dataSeries, 2]);
});

async function getMonthlyPrice() {
  console.log({requestUrl: requestUrl.value});
  const response = await axios.get(requestUrl.value);
  return response.data;
}

async function updatePrice() {
  isLoading.value = true;
  data.value = null;
  data.value = await getMonthlyPrice();
  isLoading.value = false;
}

function getKhmerMonth(date) {
  const khmerMonths = [
    "មករា", "កុម្ភៈ", "មីនា", "មេសា", "ឧសភា", "មិថុនា",
    "កក្តដា", "សីហា", "កញ្ញា", "តុលា", "វិច្ឆិកា", "ធ្នូ"
  ];

  const month = date.getMonth();
  return khmerMonths[month];
}

function download() {

}
</script>

<template>
  <div class="daily-price-month margin-top">

    <div class="text-center">
      <h3>តម្លៃមធ្យមតាមខេត្តប្រចាំខែ {{ getKhmerMonth(now) }}</h3>
      <div class="small-hr my-1 d-inline-flex"/>
    </div>

    <div class="row my-3">

      <div class="col-auto">
        <div class="form-check">
          <input
              class="form-check-input" type="radio" value="WP" id="WP"
              v-model="form.dataSeries"
              @change="updatePrice"
              :disabled="isLoading"
          >
          <label class="form-check-label" for="WP">
            តម្លៃលក់ដុំ
          </label>
        </div>
      </div>
      <div class="col-auto">
        <div class="form-check">
          <input
              class="form-check-input"
              type="radio" value="RP" id="RP"
              v-model="form.dataSeries"
              @change="updatePrice"
              :disabled="isLoading"
          >
          <label class="form-check-label" for="RP">
            តម្លៃលក់រាយ
          </label>
        </div>
      </div>

      <div class="col-auto">
        <div v-if="data?.length" role="button" class="text-primary" @click="download">
          ទាញយក<i class="fa-solid fa-print ms-2"></i>
        </div>
      </div>
    </div>

    <div>
      <div v-if="!isLoading" class="w-100 overflow-x-auto">
        <table v-if="data?.length" class="table table-striped table-hover mt-2" style="font-size: 11px;">
          <thead>
          <tr class="table-success">
            <th scope="col" class="text-left">ខេត្ត</th>
            <th scope="col" class="text-left" style="min-width: 200px">ផ្សារ</th>
            <th scope="col" class="text-center" style="min-width: 120px" v-for="commodity in data[0].commodity">
              {{ commodity.name }}
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="item in data">
            <td class="text-left">{{ item.region.name_kh }}</td>
            <td class="text-left">{{ item.market.name_kh }}</td>
            <td class="text-center" v-for="commodity in item.commodity">
            <span>
                {{ commodity.p === 0 ? "" : formatPrice(commodity.new) }}
                 <i v-if="commodity.diff>0" class="fa fa-caret-up text-danger" aria-hidden="true"></i>
                  <i v-if="commodity.diff<0" class="fa fa-caret-down text-success" aria-hidden="true"></i>
            </span>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <lv-skeleton primaryColor="#f2f2f2" secondaryColor="#ffffff" width="100%" :height="500"/>
      </div>
    </div>

  </div>
</template>

<style scoped>
.margin-top {
  margin-top: 250px;
}
</style>
