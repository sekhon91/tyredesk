<template>
  <div>
    <div class="px-10 h-screen flex items-center justify-center">
      <transition @enter="onEnter" @leave="onLeave" mode="out-in">
        <!-- Login Form -->
        <template v-if="!loginForm.formSubmitted">
          <div class="form-container">
            <h4 class="mb-20 border-b border-gray-200 pb-5">OTP Login</h4>
            <FormKit
              type="form"
              id="login_form"
              :actions="false"
              @submit="loginHandler"
              #default="{ value }"
              :errors="loginForm.errors"
            >
              <!-- EMAIL -->
              <FormKit
                type="email"
                name="email"
                validation="required|email"
                validation-label="Email"
                placeholder="Email"
              />
              <!-- SUBMIT -->
              <FormKit
                type="submit"
                label="Continue"
                input-class="btn btn--black w-full"
                :disabled="loginForm.processing"
              />
            </FormKit>
          </div>
        </template>
        <!-- Verify OTP -->
        <template v-else>
          <div class="form-container">
            <h4 class="mb-20 border-b border-gray-200 pb-5 text-center">
              Verify One time password
            </h4>
            <FormKit
              type="form"
              id="otp_form"
              :actions="false"
              @submit="otpHandler"
              #default="{ value }"
              :errors="otpForm.errors"
            >
              <!-- EMAIL -->
              <FormKit
                type="text"
                name="otp"
                validation="required"
                validation-label="OTP"
                placeholder="OTP"
              />
              <!-- SUBMIT -->
              <FormKit
                type="submit"
                label="Log In"
                input-class="btn btn--black w-full"
                :disabled="otpForm.processing"
              />
            </FormKit>

            <div class="flex justify-center mt-10">
              <span
                class="font-normal underline cursor-pointer"
                @click="loginForm.formSubmitted = false"
                >< Back</span
              >
            </div>
          </div>
        </template>
      </transition>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive } from "vue";

definePageMeta({
  middleware: ["sanctum:guest"],
});

/** Login form */
const loginForm = reactive({
  processing: <boolean>false,
  errors: <any>[],
  formData: <any>null,
  formSubmitted: <boolean>false,
});
//@ts-ignore
const config = useRuntimeConfig();
//@ts-ignore
const client = useSanctumClient();
const loginHandler = async (formData: any) => {
  try {
    loginForm.processing = true;
    loginForm.errors = [];
    loginForm.formData = formData;

    /** Set Platform */
    formData.platform = config.public.platform;

    /** Login request */
    await client("/login-otp", {
      method: "POST",
      body: formData,
    });
    /** Redirect Set login submitted */
    loginForm.formSubmitted = true;
  } catch (error: any) {
    if (
      error.response &&
      error.response._data &&
      error.response._data.message
    ) {
      loginForm.errors = [error.response._data.message];
    } else {
      loginForm.errors = ["An unexpected error occurred."];
    }
  }

  loginForm.processing = false;
};
/** Login form */
const otpForm = reactive({
  processing: <boolean>false,
  errors: <any>[],
});

/** OTP Handler */
const { login } = useSanctumAuth();
const otpHandler = async (formData: any) => {
  try {
    otpForm.processing = true;
    otpForm.errors = [];

    /** Login */
    const res = await login({
      email: loginForm.formData.email || "",
      otp: formData.otp,
      platform: config.public.platform,
    });
  } catch (error: any) {
    if (
      error.response &&
      error.response._data &&
      error.response._data.message
    ) {
      otpForm.errors = [error.response._data.message];
    } else {
      otpForm.errors = ["An unexpected error occurred."];
    }
  }

  otpForm.processing = false;
};

/** Form Animations */
const onEnter = (el: any) => {
  useGsap.from(el, {
    opacity: 0,
    y: -20,
    duration: 0.3,
    ease: "power2.out",
  });
};

const onLeave = (el: any, done: any) => {
  useGsap.to(el, {
    opacity: 0,
    y: 20,
    duration: 0.3,
    ease: "power2.in",
    onComplete: done,
  });
};
</script>

<style scoped lang="css">
@reference "~/assets/css/tailwind.css";

.form-container {
  @apply bg-white px-10 py-20 rounded-[10px] w-full max-w-[400px] relative;
}
</style>
