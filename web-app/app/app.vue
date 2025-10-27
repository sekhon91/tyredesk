<template>
  <div>
    <div class="py-30 px-5 h4 flex gap-10">
      <nuxt-link to="/">Home</nuxt-link>
      <nuxt-link to="/about">About</nuxt-link>
      <nuxt-link to="/auth/login">Login</nuxt-link>
      <span
        class="cursor-pointer text-red-300 underline"
        @click="logoutHandler()"
        >Logout</span
      >
    </div>
    <NuxtPage />
    <!-- <NuxtRouteAnnouncer /> -->
    <!-- <NuxtWelcome /> -->
  </div>
</template>
<script setup lang="ts">
const { logout } = useSanctumAuth();

const logoutHandler = async () => {
  await logout();
};
</script>
