<template>
  <v-container>
    <v-row class="d-flex">
      <v-text-field v-model="title"/>
      <v-btn @click="addProduct">Добавить</v-btn>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    title: '',
  }),
  methods: {
    addProduct() {
      let product = {
        id: Date.now(),
        title: this.title,
      }
      this.$emit('addProduct', product);
    }
  }
}
</script>

<style scoped>

</style>