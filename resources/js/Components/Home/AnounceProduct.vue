<script setup>
import LvSkeleton from 'lightvue/skeleton';
import axios from 'axios';
import {onMounted, ref} from "vue";
import image_helper from "@/Helpers/image_helper";

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

    <div class="content-news pt-4">

      <div v-if="products?.length" class="row">
        <div v-for="(product, index) in products" :key="index" class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
          <div class="product-thumb shadow">
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
              </div>

              <div class="caption px-3 py-2 text-center">
                <div class="row">
                    <div class="col-6">
                        <h4>{{ product.type === 0 ? "លក់" : "ទិញ" }} : {{ product.commodity_name }}</h4>
                    </div>
                    <div class="col-6">
                        <h4>ប្រភេទ : {{ product.user_type_name }}</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="price">
                            តម្លៃ :<span>{{ product.price + '/' + product.unit_name }}</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <h4>ចំនួន :<span>{{ product.quantity }} {{ product.unit_name }}</span></h4>
                    </div>
                    <div class="col-6">
                        <h4>ថ្ងៃទី : {{ product.collect_date.substr(0, 10) }}</h4>
                    </div>
                    <div class="col-6">
                        <a :href="'https://market.camagrimarket.org/kh/feed-detail/' + product.id" target="_blank"
                           class="read-more">
                            <h4>អានបន្ថែម <i class="fa fa-arrow-right" aria-hidden="true"></i></h4>
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
  width: 48px;
  height: 48px;
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


.read-more {
  font-weight: 400;
  color: #0088AA;
}


.product-thumb .caption h4 {
  font-size: 13px;
  padding-top: 5px;
  text-align: left;
}



.product-thumb .caption .price {
  font-weight: 400;
  color: #282828;
}

.product-thumb .caption .price span {
  color: #f61c00;
  padding-left: 5px;
  font-weight: 500;
  text-decoration: none;
}

.pro-img {
  height: 175px !important;
}


</style>
