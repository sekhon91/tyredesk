<template>
  <div>
    <h1>Hello World !</h1>

    <div class="text-center py-20">
      <div class="bg-gray-100 p-4 mb-2">{{ deviceInfo.id }}</div>
      <div class="bg-gray-100 p-4 mb-2">{{ deviceInfo.info }}</div>
      <div class="bg-gray-100 p-4 mb-2">{{ deviceInfo.battery }}</div>
      <div class="bg-gray-100 p-4 mb-2">{{ deviceInfo.languageCode }}</div>
      <div class="bg-gray-100 p-4 mb-2">{{ deviceInfo.languageTag }}</div>
      <div class="bg-gray-100 p-4 mb-2">
        {{ config }}
      </div>
      <div class="bg-blue-100 p-4 mb-2">{{ user }}</div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { Device } from "@capacitor/device";

definePageMeta({
  middleware: ["sanctum:auth"],
});

const config = useSanctumConfig();

const user = useSanctumUser();
onMounted(async () => {
  getDeviceInfo();
});
const deviceInfo = reactive({
  id: null,
  info: null,
  battery: null,
  languageCode: null,
  languageTag: null,
});

const getDeviceInfo = async () => {
  deviceInfo.id = await Device.getId();
  deviceInfo.info = await Device.getInfo();
  deviceInfo.battery = await Device.getBatteryInfo();
  deviceInfo.languageCode = await Device.getLanguageCode();
  deviceInfo.languageTag = await Device.getLanguageTag();
};
</script>
