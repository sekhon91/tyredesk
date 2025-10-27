import { Preferences } from "@capacitor/preferences";
import { Capacitor } from "@capacitor/core";
const tokenStorageKey = "sanctum.storage.token";

const capacitorStorage = {
  get: async () => {
    if (import.meta.server) return undefined;

    try {
      if (
        Capacitor.getPlatform() === "ios" ||
        Capacitor.getPlatform() === "android"
      ) {
        const { value } = await Preferences.get({ key: tokenStorageKey });
        return value ?? undefined;
      }

      return "";
    } catch (e) {
      return undefined;
    }
  },

  set: async (app: NuxtApp, token?: string) => {
    if (import.meta.server) return;

    try {
      if (
        Capacitor.getPlatform() === "ios" ||
        Capacitor.getPlatform() === "android"
      ) {
        if (!token) {
          await Preferences.remove({ key: tokenStorageKey });
          return;
        }

        await Preferences.set({
          key: tokenStorageKey,
          value: token,
        });

        return;
      }
    } catch (e) {
      console.log("Token set failed:", e);
    }

    // window.localStorage.setItem(tokenStorageKey, token);
  },
};

export default defineAppConfig({
  sanctum: {
    tokenStorage: capacitorStorage,
  },
});
