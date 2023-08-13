<script setup>

</script>

<template>
    <div class="daily-price-month mt-5">
        <div class="text-center">
            <h3>តម្លៃមធ្យមតាមខេត្តប្រចាំខែ មិថុនា</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <div class="row my-3">
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        តម្លៃលក់ដុំ
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        តម្លៃលក់រាយ
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <a href="#" class="text-primary">
                    ទាញយក<i class="fa-solid fa-print ms-2"></i>
                </a>
            </div>
        </div>
        <div class="w-100 overflow-x-auto">
            <table class="table table-striped table-hover mt-2">
                <thead>
                <tr class="table-success">
                    <th scope="col">ខេត្ត</th>
                    <th scope="col" class="text-center">ផ្សារ</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                    <th scope="col" class="text-center">ស្រូវចម្រុះ (KHR/KGS)</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in 10">
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                    <td>អំពៅលេខ ២</td>
                    <td class="text-center">26/06/2023</td>
                    <td class="text-center">18,000.00 KHR/BUN</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
