<template>
  <v-container fluid>
    <v-app-bar
        dense
    >
      <v-app-bar-nav-icon  @click.stop="drawer = !drawer" class="hidden-md-and-up"></v-app-bar-nav-icon>
      <div class="hidden-sm-and-down">
          <v-btn
              color="primary"
              class="mr-3"
              v-for="item in menu"
              :to="item.link"
          >
            {{ item.text }}
          </v-btn>
      </div>
      <v-spacer/>
      <v-switch
          label="Dark mode"
          hide-details
          v-model="$vuetify.theme.dark"
      ></v-switch>

    </v-app-bar>
    <v-navigation-drawer
        @click.stop="drawer = !drawer"
        v-model="drawer"
        absolute
        temporary
    >
      <v-list
          nav
          dense
      >
        <v-list-item-group
        >
          <v-list-item v-for="item in menu" :to="item.link">
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item>

        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

  </v-container>
</template>

<script>
export default {
  data: () => ({
    menu: [
      {link: '/', text: 'Main'},
      {link: '/products', text: 'Products table'},
      {link: '/categories', text: 'Categories table'},
    ],
    drawer: null
  }),
}
</script>

<style scoped>

</style>