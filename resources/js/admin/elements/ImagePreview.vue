<template>
  <div>
    <!-- Drop Zone for Image Upload -->
    <div class="border-2 border-dashed border-gray-300 rounded-md p-4 flex flex-col items-center justify-center cursor-pointer hover:border-blue-500 transition-colors" @dragover.prevent @drop.prevent="handleDrop" @click="$refs.fileInput.click()">
      <p v-if="!previewUrl" class="text-gray-500">Drag and drop an image here, or click to select</p>
      <img v-if="previewUrl" :src="previewUrl" alt="Image Preview" class="max-h-40 mt-2 object-contain" />
    </div>

    <!-- Hidden File Input -->
    <input type="file" accept="image/*" @change="previewImage" ref="fileInput" class="hidden" />

    <!-- Remove Button -->
    <button v-if="previewUrl" @click="removeImage" class="mt-2 px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 transition">Remove Image</button>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: File,
      default: null,
    },
  },
  data() {
    return {
      previewUrl: null, // To hold the image URL for preview
    };
  },
  watch: {
    // Watch for changes in the file and emit the file object
    modelValue(newValue) {
      this.previewUrl = newValue ? URL.createObjectURL(newValue) : null; // Generate preview for file object
    },
    // Sync previewUrl to v-model (for the parent component)
    previewUrl(newValue) {
      if (newValue) {
        const file = this.$refs.fileInput.files[0];
        if (file) {
          this.$emit('update:modelValue', file); // Emit the actual file object
        }
      }
    },
  },
  methods: {
    // Preview the image before sending it to backend
    previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.previewUrl = URL.createObjectURL(file); // Show image preview
        this.$emit('update:modelValue', file); // Emit the file itself
      }
    },
    // Handle image drop (for drag-and-drop)
    handleDrop(event) {
      const file = event.dataTransfer.files[0];
      if (file && file.type.startsWith("image/")) {
        this.previewUrl = URL.createObjectURL(file); // Show image preview
        this.$emit('update:modelValue', file); // Emit the file object
      }
    },
    // Remove the image and clear the input
    removeImage() {
      this.previewUrl = null;
      this.$emit('update:modelValue', null); // Reset the model value to null
      this.$refs.fileInput.value = ''; // Reset the file input
    },
  },
};
</script>