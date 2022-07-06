<template>
  <v-container>
    <!--    <v-data-table v-for="product in products" :product="product">-->
    <!--      -->
    <!--    </v-data-table>-->
    <ProductsTable />

  </v-container>
</template>

<script>
import ProductsTable from "@/components/ProductsPage/ProductsTable";

export default {
  components: {
    ProductsTable,
  },
}
</script>

<style scoped>

</style>