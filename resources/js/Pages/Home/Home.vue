<template>
  <App>
    <Slide/>
    <div class="container">
      <Welcome/>
      <LastUpdate/>
      <DailyPrice/>
      <AveragePriceTrend/>
      <PriceByProvince/>
      <LastNews/>
      <AnounceProduct/>
    </div>
  </App>
</template>

<script setup>
import App from "@/Layouts/App.vue";
import DailyPrice from "@/Components/Home/DailyPrice.vue";
import AveragePriceTrend from "@/Components/Home/AveragePriceTrend.vue";
import PriceByProvince from "@/Components/Home/PriceByProvince.vue";
import LastNews from "@/Components/Home/LastNews.vue";
import Slide from "@/Components/Home/Slide.vue";
import Welcome from "@/Components/Home/Welcome.vue";
import LastUpdate from "@/Components/Home/LastUpdate.vue";
import AnounceProduct from "@/Components/Home/AnounceProduct.vue";

</script>

<style scoped>

</style>
