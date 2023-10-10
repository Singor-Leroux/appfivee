<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-yellow-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden"
        @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Bienvenue !</h1>
          <InputError :message="form.errors.password" />

          <div class="mt-6 mx-auto w-24 border-b-2" />
          <div>
            <text-input v-model="form.username" :error="form.errors.username"
              class="mt-10" label="Username" type="text" autofocus
              autocapitalize="off" autocomplete="username" />
            <InputError :message="form.errors.username" />
          </div>

          <div class="relative">
            <text-input-with-icon v-model="form.password"
              :error="form.errors.password" class="mt-6 relative" label="Password"
              :type="showPassword ? 'text' : 'password'"
              autocomplete="current-password">
              <span class="absolute right-2 top-8 cursor-pointer">
                <Icon @click="showPassword = !showPassword" v-if="!showPassword"
                  name="eye-closed" />
                <Icon @click="showPassword = !showPassword" v-else
                  name="eye-opened" />
              </span>
            </text-input-with-icon>
            <InputError :message="form.errors.password" />
          </div>
          <label class=" flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1"
              type="checkbox" />
            <span class="text-sm">Remember Me</span>
          </label>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-yellow ml-auto"
            type=" submit">Se connecter</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import Logo from '../../Shared/Logo.vue'
import TextInput from '../../Shared/TextInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'
import Icon from '@/Shared/Icon.vue'
import TextInputWithIcon from '@/Shared/TextInputWithIcon.vue'
import InputError from '@/Shared/InputError.vue'

export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
    Icon,
    TextInputWithIcon,
    InputError
  },
  data() {
    return {
      form: this.$inertia.form({
        username: '',
        password: '',
        remember: false,
      }),
      showPassword: false,
    }
  },
  methods: {
    login() {
      this.form.post('/in/login')
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    }
  },
}
</script>