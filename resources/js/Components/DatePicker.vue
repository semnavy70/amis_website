<template>
  <div>
    <VueDatePicker
        v-bind="datepickerProps"
        v-model="date"
        @update:modelValue="handleInput"
        :maxDate="maxDate"
        :enableTimePicker="false"
        :autoApply="true"
        :clearable="false"
        :format="customDateFormat"
    />
  </div>
</template>

<script setup>
import {ref, computed} from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  ...VueDatePicker.props,
});
const emit = defineEmits(['update:modelValue']);
const date = ref(props.modelValue);
const maxDate = new Date();
const customDateFormat = 'dd-MM-yyyy';

const handleInput = (newValue) => {
  date.value = newValue;
  emit('update:modelValue', newValue);
};

const datepickerProps = computed(() => {
  return {
    ...props,
    modelValue: date.value,
  };
});

</script>
