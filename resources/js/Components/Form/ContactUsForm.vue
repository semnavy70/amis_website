<script setup>

</script>

<template>
  <div class="mt-3 bg-white p-5 shadow rounded">
    <div class="form">
      <div class="row mb-3">
        <label for="name" class="col-3 col-form-label">ឈ្មោះ</label>
        <div class="col">
          <input type="text" placeholder="ឈ្មោះ" class="form-control" id="name">
        </div>
      </div>
      <div class="row mb-3">
        <label for="email" class="col-3 col-form-label">សារអេឡិកត្រូនិច</label>
        <div class="col">
          <input type="email" placeholder="សារអេឡិកត្រូនិច" class="form-control" id="email">
        </div>
      </div>
      <div class="row mb-3">
        <label for="message" class="col-3 col-form-label">សារ</label>
        <div class="col">
          <textarea class="form-control" placeholder="សារ" id="floatingTextarea2"></textarea>
        </div>
      </div>
      <!--      <div class="row mb-3">-->
      <!--        <label for="question" class="col-3 col-form-label">តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា?</label>-->
      <!--        <div class="col">-->
      <!--          <input type="text" placeholder="តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា" class="form-control" id="question">-->
      <!--        </div>-->
      <!--      </div>-->
      <div class="text-end">
        <a class="btn btn-outline-success px-5" href="#">
          បញ្ជូន
        </a>
      </div>
    </div>
  </div>
</template>
