<template>
    <v-container fluid>
      <v-app-bar
          color="white accent-4"
          dense
          dark
      >
        <v-btn outlined class="ml-3">
          <router-link to="/">Main</router-link>
        </v-btn>
        <v-btn outlined class="ml-3">
          <router-link to="/products">Products table</router-link>
        </v-btn>
        <v-btn outlined class="ml-3">
          <router-link to="/categories">Categories table</router-link>
        </v-btn>
      </v-app-bar>
    </v-container>
</template>

<script>
export default {
}
</script>

<style scoped>

</style>