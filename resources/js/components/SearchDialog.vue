<script setup>
import {TransitionRoot,} from '@headlessui/vue';
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
    Inertia.get("/search", {search: search.value}, {
        replace: true,
        preserveState: true
    });
}


</script>

<template>
    <slot name="action" :handler="{'open': openModal }">
    </slot>

    <TransitionRoot @keydown.esc="closeModal" appear :show="isOpen" name="modal" tabindex="0">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container" @keydown.esc="closeModal">
                    <div class="modal-body">
                        <div class="modal-dialog modal-lg text-end">
                            <div class="modal-content rounded rounded-4">
                                <div class="modal-body p-0">
                                    <input type="search" class="form-control p-3 rounded rounded-4"
                                           id="search" placeholder="ស្វែងរក..." v-model="search" autofocus
                                           @keydown.enter="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </TransitionRoot>

</template>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 50%;
    position: absolute;
    left: 50%;
    top: 20%;
    transform: translate(-50%, -50%);
}

.modal-body {
    margin: 0;
    position: relative;
}

.modal-body .form-control {
    height: 48px;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}


</style>
