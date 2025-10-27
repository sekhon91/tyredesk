// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";
export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
  ssr: false,
  nitro: {
    preset: "static",
  },

  css: ["~/assets/css/tailwind.css"],

  vite: {
    plugins: [tailwindcss()],
  },

  modules: ["@hypernym/nuxt-gsap", "@formkit/nuxt", "nuxt-auth-sanctum"],

  /** gsap */
  gsap: {
    composables: true,
    extraPlugins: {
      scrollTrigger: true,
    },
  },

  /** formkit */
  formkit: {
    autoImport: true,
  },

  /** Sanctum */
  sanctum: {
    baseUrl:
      process.env.NUXT_APP_PLATFORM === "app"
        ? process.env.NUXT_MOBILE_API_BASE
        : process.env.NUXT_API_BASE,
    mode: process.env.NUXT_APP_PLATFORM == "app" ? "token" : "cookie",
    redirectIfAuthenticated: true,
    redirectIfUnauthenticated: true,
    endpoints: {
      login: "/login",
      logout: "/logout",
      user: "/user",
    },
    redirect: {
      onLogin: "/",
      onLogout: "/auth/login",
      onAuthOnly: "/auth/login",
    },
  },

  /** Run time configs */
  runtimeConfig: {
    authMode: process.env.AUTH_MODE || "token",
    platform: process.env.NUXT_APP_PLATFORM || "web",
    public: {
      platform: process.env.NUXT_APP_PLATFORM || "web",
    },
  },
});
