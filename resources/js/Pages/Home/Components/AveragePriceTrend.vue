<script setup>

</script>

<template>
    <div class="trend-price mt-5">
        <div class="text-center">
            <h3>និន្នាការតម្លៃមធ្យម</h3>
            <div class="small-hr my-1 d-inline-flex"/>
        </div>
        <form class="mt-3">
            <div class="bg-white border rounded p-4">
                <div class="row gy-3">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="type" class="form-label">ប្រភេទ</label>
                        <select class="form-select" aria-label="Type">
                            <option selected>ដំណាំផ្សេងទៀត</option>
                            <option value="1">ត្រី</option>
                            <option value="2">ធញ្ញជាតិ</option>
                            <option value="3">បន្លែ</option>
                            <option value="4">ផ្លែឈើ</option>
                            <option value="5">សាច់</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-one" class="form-label">ទំនិញទី១</label>
                        <select class="form-select" aria-label="Product one">
                            <option value="70008" selected>កៅស៊ូកក</option>
                            <option value="15016">ជ័រកៅស៊ូទឹក (កំពង់ចាម)</option>
                            <option value="15018">ជ័រកៅស៊ូទឹក (កំពង់ធំ)</option>
                            <option value="15020">ជ័រកៅស៊ូទឹក (ក្រចេះ)</option>
                            <option value="15017">ជ័រកៅស៊ូទឹក (ត្បូងឃ្មុំ)</option>
                            <option value="15021">ជ័រកៅស៊ូទឹក (មណ្ឌលគិរី)</option>
                            <option value="15019">ជ័រកៅស៊ូទឹក (រតនគិរី)</option>
                            <option value="15014">ជ័រកៅស៊ូស្ងួត (កំពង់ចាម)</option>
                            <option value="15012">ជ័រកៅស៊ូស្ងួត (កំពង់ធំ)</option>
                            <option value="15015">ជ័រកៅស៊ូស្ងួត (ក្រចេះ)</option>
                            <option value="15011">ជ័រកៅស៊ូស្ងួត (ត្បូងឃ្មុំ)</option>
                            <option value="15013">ជ័រកៅស៊ូស្ងួត (រតនគិរី)</option>
                            <option value="70003">ថ្នាំជក់</option>
                            <option value="70007">ទឹកឃ្មុំ</option>
                            <option value="70001">អំពៅលេខ ១</option>
                            <option value="70002">អំពៅលេខ ២</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-two" class="form-label">ទំនិញទី២</label>
                        <select class="form-select" aria-label="Product one">
                            <option value="70008">កៅស៊ូកក</option>
                            <option value="15016">ជ័រកៅស៊ូទឹក (កំពង់ចាម)</option>
                            <option value="15018">ជ័រកៅស៊ូទឹក (កំពង់ធំ)</option>
                            <option value="15020">ជ័រកៅស៊ូទឹក (ក្រចេះ)</option>
                            <option value="15017">ជ័រកៅស៊ូទឹក (ត្បូងឃ្មុំ)</option>
                            <option value="15021">ជ័រកៅស៊ូទឹក (មណ្ឌលគិរី)</option>
                            <option value="15019">ជ័រកៅស៊ូទឹក (រតនគិរី)</option>
                            <option value="15014">ជ័រកៅស៊ូស្ងួត (កំពង់ចាម)</option>
                            <option value="15012">ជ័រកៅស៊ូស្ងួត (កំពង់ធំ)</option>
                            <option value="15015">ជ័រកៅស៊ូស្ងួត (ក្រចេះ)</option>
                            <option value="15011">ជ័រកៅស៊ូស្ងួត (ត្បូងឃ្មុំ)</option>
                            <option value="15013">ជ័រកៅស៊ូស្ងួត (រតនគិរី)</option>
                            <option value="70003" selected>ថ្នាំជក់</option>
                            <option value="70007">ទឹកឃ្មុំ</option>
                            <option value="70001">អំពៅលេខ ១</option>
                            <option value="70002">អំពៅលេខ ២</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <label for="product-two" class="form-label">ទំនិញទី៣</label>
                        <select class="form-select" aria-label="type">
                            <option value="233" selected>ជ័រកៅស៊ូទឹក (កំពង់ចាម)</option>
                            <option value="15013">ជ័រកៅស៊ូស្ងួត (រតនគិរី)</option>
                            <option value="70003" selected>ថ្នាំជក់</option>
                            <option value="70007">ទឹកឃ្មុំ</option>
                            <option value="70001">អំពៅលេខ ១</option>
                            <option value="70002">អំពៅលេខ ២</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
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
        </div>
        <div class="bg-info text-center" style="width: 100%; height: 200px">
            <h4>High Chart Box</h4>
        </div>
    </div>
</template>

<style scoped>

</style>
