<template>
    <v-container fluid>
      <v-app-bar
          color="deep-purple accent-4"
          dense
      >
          <v-btn
              outlined
              class="ml-3"
            >
            <router-link to="/">Main</router-link>
          </v-btn>
          <v-btn outlined class="ml-3">
            <router-link to="/products">Products table</router-link>
          </v-btn>
          <v-btn outlined class="ml-3">
            <router-link to="/categories">Categories table</router-link>
          </v-btn>
        <v-spacer/>
        <v-app-bar-nav-icon @click="drawer = true"
                            class="d-flex d-sm-none"
        ></v-app-bar-nav-icon>
      </v-app-bar>
    </v-container>
</template>

<script>
export default {
  data: () => {
    items: ['Main','Products table', 'Categories table']
  }
}
</script>

<style scoped>

</style>