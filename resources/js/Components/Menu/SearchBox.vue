<script setup>

import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const emit = defineEmits(['submit']);

const isOpen = ref(false);
let search = ref("");

function closeModal() {
  isOpen.value = false;
}

function openModal() {
  isOpen.value = true;
}

function submit() {
  Inertia.get(route('search.index'), {search: search.value}, {
    replace: true,
    preserveState: true
  });
}

</script>

<template>

  <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fa-solid fa-magnifying-glass"></i>
  </a>

  <!-- Modal Search -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form>
            <input
                name="search"
                type="search"
                class="form-control"
                id="search-input"
                placeholder="ស្វែងរក..."
                v-model="search"
                @keydown.enter="submit"
            />
          </form>
        </div>
      </div>
    </div>
  </div>

</template>
