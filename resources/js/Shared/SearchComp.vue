<template>
  <div>
    <input v-model="searchTerm" @input="handleSearch"
      placeholder="Rechercher..." />
    <ul>
      <li v-for="(result, index) in searchResults" :key="index"
        v-html="highlightSearchResult(result)"></li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchTerm: "",
      searchResults: [
        "Chaine de caractères 1",
        "Chaine de caractères 2",
        "Autre chaine de caractères",
      ]
    };
  },
  methods: {
    handleSearch() {
      // Implémentez ici la logique de recherche, mettez à jour this.searchResults avec les résultats
      // Pour cet exemple, supposons que vous avez déjà les résultats de la recherche dans un tableau searchResults.
      this.searchResults = this.data.filter(item =>
        item.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
    highlightSearchResult(result) {
      // Mettez en surbrillance la sous-portion de la chaîne de caractères correspondante
      const regex = new RegExp(this.searchTerm, "gi");
      return result.replace(regex, match => `<strong>${match}</strong>`);
    }
  }
};
</script>
