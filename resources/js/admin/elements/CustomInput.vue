<template>
    <div>
        <label :for="name" class="block text-sm py-1 capitalize">{{ name }}</label>
        <div class="rounded overflow-hidden flex w-full bg-gray-200">
            <label v-if="icon" :for="name" class="w-12 h-12 flex justify-center items-center text-center"><i :class="icon"></i></label>
            <input :required="required ? '' : null" :type="type ?? 'text'" :step="step" :min="min" :max="max" :name="name" :id="name" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="border-0 h-12 focus:bg-gray-100 bg-transparent flex-1 focus:ring-0 focus:outline-none">
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'name', 'icon', 'type', 'step', 'min', 'max', 'modelValue', 'required'
    ]
}
</script>