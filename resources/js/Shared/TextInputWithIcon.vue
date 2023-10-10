<template>
  <div :class="$attrs.class">
    <label v-if="label" :for="id"
      class="block text-sm font-medium leading-6 text-gray-900">{{ label
      }}</label>
    <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }"
      class="block w-full round-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-600 sm:text-sm sm:leading-6"
      :class="{ error: error }" :type="type" :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)" />
    <slot />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>
<script>
import { v4 as uuid } from 'uuid';
import Icon from './Icon.vue';

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`;
      }
    },
    type: {
      type: String,
      default: 'text',
    },
    error: String,
    label: String,
    modelValue: String,
  },
  emits: ['update:modelValue'],
  methods: {
    focus() {
      this.$refs.input.focus();
    },
    select() {
      this.$refs.input.select();
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end);
    }
  },
  components: { Icon }
}
</script>