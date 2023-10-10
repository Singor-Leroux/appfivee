<template>
  <div>
    <!-- Accueil -->
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
      <Icon name="dashboard" class="mr-2 w-4 h-4"
        :class="isUrl('') ? 'fill-white' : 'fill-yellow-400 group-hover:fill-white'" />
      <div
        :class="isUrl('') ? 'text-white' : 'text-yellow-300 group-hover:text-white'">
        Accueil</div>
      </Link>
    </div>
    <!-- Quiz -->
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/quiz">
      <Icon name="dashboard" class="mr-2 w-4 h-4"
        :class="isUrl('quiz') ? 'fill-white' : 'fill-yellow-400 group-hover:fill-white'" />
      <div
        :class="isUrl('quiz') ? 'text-white' : 'text-yellow-300 group-hover:text-white'">
        Quiz</div>
      </Link>
    </div>
    <!-- Gestion des candidatures -->
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
      <Icon name="dashboard" class="mr-2 w-4 h-4"
        :class="isUrl('candiatures') ? 'fill-white' : 'fill-yellow-400 group-hover:fill-white'" />
      <div
        :class="isUrl('candidatures') ? 'text-white' : 'text-yellow-300 group-hover:text-white'">
        Gestion des candidatures</div>
      </Link>
    </div>
    <!-- Autres -->
    <!-- <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
      <Icon name="dashboard" class="mr-2 w-4 h-4"
        :class="isUrl('') ? 'fill-white' : 'fill-yellow-400 group-hover:fill-white'" />
      <div
        :class="isUrl('') ? 'text-white' : 'text-yellow-300 group-hover:text-white'">
        Dashboard</div>
      </Link>
    </div> -->
  </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import Icon from './Icon.vue';

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substring(1);
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
}
</script>