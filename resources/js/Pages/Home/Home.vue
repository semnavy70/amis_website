<template>
    <App>
        <Slide/>
        <div class="container">
            <Welcome/>
            <LastUpdate/>
            <DailyPrice/>
<!--            <AveragePriceTrend/>-->
<!--            <PriceByProvince/>-->
<!--            <LastNews/>-->
<!--            <AnounceProduct/>-->
        </div>

    </App>
</template>

<script setup>

import App from "../../Layouts/App.vue";
import AveragePriceTrend from "./Components/AveragePriceTrend.vue";
import DailyPrice from "./Components/DailyPrice.vue";
import PriceByProvince from "./Components/PriceByProvince.vue";
import LastNews from "./Components/LastNews.vue";
import Partner from "./Components/Partner.vue";
import Slide from "./Components/Slide.vue";
import Welcome from "./Components/Welcome.vue";
import LastUpdate from "./Components/LastUpdate.vue";
import AnounceProduct from "./Components/AnounceProduct.vue";
</script>

<style scoped>

</style>
