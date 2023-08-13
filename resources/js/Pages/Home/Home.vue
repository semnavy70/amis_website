<template>
    <App>
        <Slide/>
        <div class="container">
            <Welcome/>
            <LastUpdate/>
            <AveragePriceTrend/>
            <DailyPrice/>
            <PriceByProvince/>
            <LastNews/>
            <Partner/>
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
</script>

<style scoped>

</style>
