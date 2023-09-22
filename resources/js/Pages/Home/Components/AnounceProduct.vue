<script setup>
import LvSkeleton from 'lightvue/skeleton';
import axios from 'axios';
import {onMounted, ref} from "vue";
import image_helper from "../../../Helpers/image_helper.js";

const isLoading = ref(true);
const products = ref();

onMounted(async () => {
  loadData();
});

async function loadData() {
  isLoading.value = true;
  products.value = await getProduct();
  isLoading.value = false;
}

async function getProduct() {
  const response = await axios.get(route('home.market-product'));
  return response.data;
}

</script>

<template>
  <section class="latest-news mt-5">
    <div class="text-center">
      <h3>ផលិតផល</h3>
      <div class="small-hr my-1 d-inline-flex"/>
    </div>

    <div class="content-news">

      <div v-if="products?.length" class="row">
        <div v-for="product in products" class="col-md-3 col-lg-3 col-sm-3 col-xs-12">

          <div class="product-thumb">

            <div class="image">
              <div class="pro-list">
                <a href="https://market.camagrimarket.org/">
                  <img :src="image_helper.methods.getMarketImage(product.thumnail)" alt="image" title="image"
                       class="pro-img img-responsive"/>
                </a>
                <div class="user-profile">
                  <img :src="product.user_profile||'/assets/img/user-market.jpg'" class="profile" alt="">
                </div>
                <div class="user-name">
                  <h4 class="name">{{ product.user_first_name }} {{ product.user_last_name }}</h4>
                  <p class="date-time" v-text="product.date">Yesterday at 6:20 pm</p>
                </div>
                <div class="onhover1" id="triangle-bottomright">
                  <div class="button-group">
                    <div class="user-type">{{ product.user_type_name }}</div>
                  </div>
                </div>
              </div>

              <div class="caption text-center">
                <div class="row">
                  <h4>{{ product.type === 0 ? "លក់" : "ទិញ" }} : {{ product.commodity_name }}</h4>
                  <div class="col-md-6 col-xs-6 pr">
                    <p class="price">តម្ល់ :<span v-text="product.price+'/'+product.unit_code">12000 / Kg</span>
                    </p>
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>{{ product.collect_date.substr(0, 10) }}</p>
                  </div>
                  <div class="col-md-6 col-xs-6 pl">
                    <p class="qty">ចំនួន :<span>{{ product.quantity }} {{ product.unit_code }}</span></p>
                    <a href="https://market.camagrimarket.org/" class="read-more">
                      <p>អានបន្ថែម<i class="fa fa-arrow-right" aria-hidden="true"></i></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--          <div class="product-thumb">-->
          <!--            <div class="image ">-->
          <!--              <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/1.png" alt="image"-->
          <!--                               title="image" class="img-responsive"></a>-->
          <!--            </div>-->
          <!--            <div class="caption">-->
          <!--              <div class="row">-->
          <!--                <div class="col-md-6">-->
          <!--                  <p>{{  product.commodity_name }}</p>-->

          <!--                </div>-->
          <!--                <div class="col-md-6">-->
          <!--                  <p class="price">ប៉េងបោះ</p>-->
          <!--                </div>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </div>-->
          <!--        </div>-->
        </div>
      </div>

      <div v-else>
        <LvSkeleton
            primaryColor="#f2f2f2"
            secondaryColor="#ffffff"
            width="100%"
            height="200"
        />
      </div>
    </div>

  </section>
</template>

<style scoped>
.pro-img {
  height: 175px !important;
}

.product {
  margin: 100px;
}
</style>
