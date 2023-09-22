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
        <div v-for="(product, index) in products" :key="index" class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
          <div class="product-thumb">
            <div class="image">
              <div class="pro-list">
                <a :href="'https://market.camagrimarket.org/kh/feed-detail/' + product.id" target="_blank">
                  <div class="text-center">
                    <img :src="image_helper.methods.getMarketImage(product.thumnail)" alt="image" title="image"
                         class="pro-img img-responsive"/>
                  </div>
                </a>
                <div class="user-profile">
                  <!--  "product.user_profile||-->
                  <img src="/assets/img/user-market.jpg" class="profile" alt="">
                </div>
                <div class="user-name">
                  <h4 class="name">{{ product.user_first_name }} {{ product.user_last_name }}</h4>
<!--                  <p class="date-time" v-text="product.date">Yesterday at 6:20 pm</p>-->
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
                    <p class="price">តម្លៃ :<span>{{ product.price + '/' + product.unit_name }}</span>
                    </p>
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>{{ product.collect_date.substr(0, 10) }}</p>
                  </div>
                  <div class="col-md-6 col-xs-6 pl">
                    <p class="qty">ចំនួន :<span>{{ product.quantity }} {{ product.unit_name }}</span></p>
                    <a :href="'https://market.camagrimarket.org/kh/feed-detail/' + product.id" target="_blank"
                       class="read-more">
                      <p>អានបន្ថែម<i class="fa fa-arrow-right" aria-hidden="true"></i></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

.product-thumb .image .pro-list {
  position: relative;
  overflow: hidden;
}

.product-thumb .image .pro-list .user-profile .profile {
  top: 12px;
  left: 12px;
  width: 52px;
  height: 52px;
  border: 1px solid #fff;
  border-radius: 50%;
  position: absolute;
}

.product-thumb .image .pro-list .user-name {
  bottom: 0;
  left: 14px;
  position: absolute;
}

.product-thumb .image .pro-list .user-name .name {
  font-size: 14px;
}

.product-thumb .image .pro-list .user-name .date-time {
  font-size: 10px;
}

.product-thumb .image .pro-list .onhover1 {
  position: absolute;
}

.product-thumb .image .pro-list a::before {
  content: "";
  background: #707070;
  opacity: 0.3;
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  margin: 0 auto;
}

.user-type {
  background: #0088AA;
  padding: 5px 8px;
  height: 28px;
  border: none;
  color: #fff;
  font-size: 13px;
  width: 80px;
}

#triangle-bottomright {
  width: 0;
  height: 0;
  margin-right: 80px;
  border-bottom: 28px solid #0088AA;
  border-left: 20px solid transparent;
}

.read-more {
  font-weight: 400;
  font-size: 13px;
  color: #0088AA;
}


.product-thumb .caption h4 {
  font-size: 13px;
  padding-top: 5px;
}

.product-thumb .caption .price {
  font-size: 11px;
}

.product-thumb .caption p {
  font-size: 11px;
}

.product-thumb .caption .qty {
  font-size: 11px;
}

.product-thumb .caption .qty span {
  font-size: 11px;
}

.product-thumb .caption .read-more {
  font-size: 12px;
}

.product-thumb .caption .fa-arrow-right {
  font-size: 9px;
}

.product-thumb .caption .pl {
  margin-top: 7px;
  padding-left: 5px;
  text-align: right;
}

.product-thumb .caption .price {
  font-size: 13px;
  font-weight: 400;
  color: #282828;
  margin: 5px 0 0;
}

.product-thumb .caption .price span {
  color: #f61c00;
  padding-left: 5px;
  font-weight: 500;
  text-decoration: none;
}

.product-thumb .caption .fa-calendar {
  color: #000;
  font-size: 12px;
  padding-right: 5px;
}

.pro-img {
  height: 175px !important;
}

.product {
  margin: 100px;
}

</style>
