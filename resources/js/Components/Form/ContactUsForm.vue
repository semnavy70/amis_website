<script setup>
import {useForm} from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

const form = useForm({
  name: null,
  email: null,
  message: null,
});

function submit() {
  form.post(route('client.contact-us'), {
    preserveScroll: true,
    onSuccess: () => {
      // form.reset();
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
      Toast.fire({
        icon: 'success',
        title: "បានបញ្ជូនបែបបទ",
      });
    },
  });
}
</script>

<template>
  <div class="mt-3 bg-white p-5 shadow rounded">
    <form @submit.prevent="submit()">
      <div class="form">
        <div class="row mb-3">
          <label for="name" class="col-3 col-form-label">ឈ្មោះ</label>
          <div class="col">
            <input type="text" required placeholder="ឈ្មោះ" class="form-control" id="name" v-model="form.name">
          </div>
        </div>
        <div class="row mb-3">
          <label for="email" class="col-3 col-form-label">សារអេឡិកត្រូនិច</label>
          <div class="col">
            <input type="email" required placeholder="សារអេឡិកត្រូនិច" class="form-control" id="email"
                   v-model="form.email">
          </div>
        </div>
        <div class="row mb-3">
          <label for="message" class="col-3 col-form-label">សារ</label>
          <div class="col">
            <textarea class="form-control" required placeholder="សារ" id="floatingTextarea2"
                      v-model="form.message"></textarea>
          </div>
        </div>
        <!--      <div class="row mb-3">-->
        <!--        <label for="question" class="col-3 col-form-label">តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា?</label>-->
        <!--        <div class="col">-->
        <!--          <input type="text" placeholder="តើវេបសាយនេះប្រើប្រាស់ប៉ុន្មានភាសា" class="form-control" id="question">-->
        <!--        </div>-->
        <!--      </div>-->
        <div class="text-end">
          <button type="submit" class="btn btn-outline-success px-5" href="#">
            បញ្ជូន
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
