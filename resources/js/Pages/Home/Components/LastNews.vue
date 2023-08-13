<script setup>

</script>

<template>
    <div class="latest-news mt-5">
        <div class="text-center">
            <h3>ព័ត៌មានចុងក្រោយ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <div class="row mt-3 gy-3">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4" v-for="item in 3">
                <div class="bg-white p-3 shadow">
                    <img class="w-100" src="https://storage.googleapis.com/amis_website/posts/WeeklyPrice/26.jpg" alt="news-thumbnail">
                    <p class="text-green fs-18">ស្ថានភាពផលិតកម្ម និងតម្លៃទីផ្សារកសិផលសំខាន់ៗ</p>
                    <hr class="w-25 text-green"/>
                    <p>ការិយាល័យទីផ្សារកសិកម្ម សូមជូនតារាងតម្លៃសំខាន់ៗប្រចាំសប្ដាហ៍ទី២ ខែមិថុនា ឆ្នាំ២០២៣</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
