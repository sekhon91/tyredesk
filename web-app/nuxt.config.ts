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
      process.env.NUXT_AUTH_MODE === "token"
        ? process.env.NUXT_MOBILE_API_BASE
        : process.env.NUXT_API_BASE,
    mode: process.env.NUXT_AUTH_MODE == "token" ? "token" : "cookie",
    redirectIfAuthenticated: true,
    redirectIfUnauthenticated: true,
    endpoints: {
      login:
        process.env.NUXT_AUTH_MODE === "token"
          ? "/app-otp-verification"
          : "/web-otp-verification",
      logout:
        process.env.NUXT_AUTH_MODE === "token" ? "/app-logout" : "/web-logout",
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
  },
});
