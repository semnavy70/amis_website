<template>
    <div class="intro-section" v-bind:style="{ backgroundImage: 'url(' + background + ')' }">
        <div class="highlight-bg">
            <div class="container">
                <div class="title">
                    <h2 class="text-white">{{title}}</h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    title: String,
    background: String,
    background_color: String,
});

</script>

<style scoped>
.intro-section{
    height: 300px;
    background-size: cover;
    .highlight-bg{
        background-color: v-bind(background_color);
        height: 100%;
        width: 100%;
        >.container{
            height: 100%;
            display: table;
            width: 100%;
            .title{
                display: table-cell;
                vertical-align: middle;
                text-align: left;
            }
        }
    }

}

</style>
