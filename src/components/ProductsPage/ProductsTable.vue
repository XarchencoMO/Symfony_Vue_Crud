<template>
  <v-data-table
      :headers="headers"
      :items="products"
      sort-by="id"
      elevation="1"
  >
    <template v-slot:top>
      <v-toolbar
          flat
      >
        <v-toolbar-title>Products Crud Controller</v-toolbar-title>
        <v-divider
            class="mx-4"
            inset
            vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
            >
              New Item
            </v-btn>
          </template>
<!--      Create/edit card-->
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>

                  <v-col
                      cols="12"
                      sm="12"
                      md="12"
                  >
                    <v-text-field
                        v-model="editedItem.name"
                        label="Product name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="12"
                      md="12"
                  >
<!--                    <v-text-field-->
<!--                    ></v-text-field>-->
                    <v-select
                        v-model="editedItem.categories"
                        :items="states"
                        item-text="name"
                        label="Categories"
                        multiple
                        chips
                        hint="select categories"
                        persistent-hint
                        return-object
                    ></v-select>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="12"
                      md="12"
                  >
                    <v-textarea
                        v-model="editedItem.description"
                        label="Description"
                    ></v-textarea>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
<!--      Delete dialog-->
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.categories="props">
      <span v-for="category in props.item.categories">{{ category.name }} </span>
    </template>
<!--    Actions in table-->
    <template v-slot:item.actions="{ item }">
      <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
          small
          @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
<!--    Empty table-->
    <template v-slot:no-data>
      <v-btn
          color="primary"
          @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import axios from "axios";

export default {
  data: () => ({
    url_products: "http://localhost:8000/api/products",
    url_categories: "http://localhost:8000/api/categories",
    dialog: false,
    dialogDelete: false,
    headers: [
      // { text: 'id', align: 'start', value: 'id',},
      { text: 'Product Name', value: 'name' },
      { text: 'Categories', value: 'categories'},
      { text: 'Description', value: 'description' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    products: [],
    editedIndex: -1,
    editedItem: {
      id: '',
      name: '',
      categories: [],
      description: '',
    },
    defaultItem: {
      id: '',
      name: '',
      categories: [],
      description: '',
    },
    category: {
      name: '',
    },
    states: [],
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
  },

  async created () {
    const products_response = await axios.get(this.url_products)
    const categories_response = await axios.get(this.url_categories)
    // console.log(products_response, categories_response)
    this.initialize(products_response.data,categories_response.data)
  },

  methods: {
    initialize (data_products,data_categories) {
      this.products = data_products;
      this.states = data_categories;
      // this.states = data_categories.flatMap(({ name }) => name );
      console.log(this.products, this.states)
    },

    editItem (item) {
      this.editedIndex = this.products.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {

      this.editedIndex = this.products.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      const response = axios.delete(this.url_products+'/'+this.editedItem.id)
      this.products.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    async save() {
      const requestData = {
        name: this.editedItem.name,
        categories: this.editedItem.categories.flatMap(({ id }) => id ),
        description: this.editedItem.description
      }
      if (this.editedIndex > -1) {
        const response = await axios.put(this.url_products + '/' + this.editedItem.id, requestData)
        Object.assign(this.products[this.editedIndex], this.editedItem)
      } else {
        const response = await axios.post(this.url_products, requestData)
        this.products.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>

<style scoped>

</style>