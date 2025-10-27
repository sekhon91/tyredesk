<template>
  <div class="px-10">
    <h1 class="mb-20">About Page</h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
      <template v-for="(n, index) in 4" :key="index">
        <div
          class="w-full aspect-video rounded-[20px] flex items-center justify-center text-4xl font-bold text-white"
          :class="{
            'bg-purple-300': index == 0,
            'bg-amber-300': index == 1,
            'bg-green-300': index == 2,
            'bg-blue-300': index == 3,
          }"
        >
          <h2>{{ index }}</h2>
        </div>
      </template>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ["sanctum:auth"],
});
</script>
