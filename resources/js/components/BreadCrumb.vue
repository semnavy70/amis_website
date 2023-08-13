<template>
    <div class="bg-white p-3 shadow mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <Link href="/">ទំព័រដើម</Link>
                </li>
                <li v-if="title" class="breadcrumb-item active" aria-current="page">{{ title }}</li>
            </ol>
        </nav>
    </div>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    title: String,
})

</script>
