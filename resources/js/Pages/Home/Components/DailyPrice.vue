<script setup>

</script>

<template>
    <div class="daily-price mt-5">
        <div class="text-center">
            <h3>តម្លៃផលិតផលប្រចាំថ្ងៃ</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <a class="btn btn-primary" href="#">
            ទាញយក<i class="fa-solid fa-print ms-2"></i>
        </a>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg6">
                <table class="table table-striped table-hover mt-2">
                    <thead>
                    <tr>
                        <th scope="col">ប្រភេទទំនិញ</th>
                        <th scope="col" class="text-center">កាលបរិច្ឆេទនៃរបាយការណ៍</th>
                        <th scope="col" class="text-center">តម្លៃ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in 10">
                        <td>អំពៅលេខ ២</td>
                        <td class="text-center">26/06/2023</td>
                        <td class="text-center">18,000.00 KHR/BUN <i class="fa-solid fa-caret-up"></i><i
                            class="fa-solid fa-caret-down"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg6">
                <table class="table table-striped table-hover mt-2">
                    <thead>
                    <tr>
                        <th scope="col">ប្រភេទទំនិញ</th>
                        <th scope="col" class="text-center">កាលបរិច្ឆេទនៃរបាយការណ៍</th>
                        <th scope="col" class="text-center">តម្លៃ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in 10">
                        <td>ក្រូចពោធិ៍សាត់</td>
                        <td class="text-center">26/06/2023</td>
                        <td class="text-center">11,500.00 KHR/DZN <i class="fa-solid fa-caret-up"></i><i
                            class="fa-solid fa-caret-down"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-end">
            <a href="#" class="text-primary text-end">
                មើលបន្ថែម<i class="fa-solid fa-angles-right fs-14"></i>
            </a>
        </div>
    </div>
</template>

<style scoped>

</style>
