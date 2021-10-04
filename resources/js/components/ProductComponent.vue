<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button @click="isAdd = true" class="btn btn-primary mt-2 mb-4">Add a product</button>
                    </div>
                        <div class="card-body">
                        
                        <template v-if="isAdd">
                            <h4>Add a new product</h4>
                            <form ref="formAdd" method="post" @submit.prevent="add()" enctype="multipart/form-data" style="width:50%">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" v-model="name" class="form-control" 
                                            :class="{'is-invalid': errors.name}" id="name">
                                        
                                        <span v-if="errors && errors.name" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.name[0] }}</strong>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" v-model="description" class="form-control"
                                            :class="{'is-invalid': errors.description}" id="description">

                                        <span v-if="errors && errors.description" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.description[0] }}</strong>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" v-model="price" class="form-control"
                                            :class="{'is-invalid': errors.price}" id="price" name="price">
                                        <span v-if="errors && errors.price" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.price[0] }}</strong>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="size" class="form-label">Size</label>
                                        <input type="text" v-model="size" class="form-control"
                                            :class="{'is-invalid': errors.price}" id="size" name="size">
                                        <span v-if="errors && errors.size" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.size[0] }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cat">Category:</label>
                                        <select v-model="selected" class="form-control" :class="{'is-invalid': errors.category}" id="cat">
                                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">
                                                {{ category.name }} - {{ category.type }}
                                            </option>
                                        </select>
                                        
                                        <span v-if="errors && errors.category" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.category[0] }}</strong>
                                        </span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input @change="handleOnChange" type="file" class="form-control" :class="{'is-invalid': errors.image}" id="inputGroupFile">
                                        <span v-if="errors && errors.image" class="invalid-feedback" role="alert">
                                            <strong> {{ errors.image[0] }}</strong>
                                        </span>
                                    </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button @click="isAdd = false" class="btn btn-danger">Back</button>
                            </form>
                        </template>

                        <template v-else-if="isShowSingle"> 
                                <div class="card" style="width: 28rem;">
                                <img :src="'/storage/' + product.img" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ product.name }}</h5>
                                    <p class="card-text">{{ product.description }}</p>
                                    <button @click="isShowSingle = false" class="btn btn-outline-danger">Go back</button>
                                </div>
                            </div>
                        </template>

                        <template v-else-if="isEdit">
                        <h3>Edit</h3>
                            <form method="post" @submit.prevent="update(product)" style="width:50%">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" v-model="product.name" class="form-control"
                                        :class="{'is-invalid': errors.name}" id="name">
                                    <span v-if="errors && errors.name" class="invalid-feedback" role="alert">
                                        <strong> {{ errors.name[0] }}</strong>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" v-model="product.description" class="form-control" 
                                        :class="{'is-invalid': errors.description}" id="description">
                                    <span v-if="errors && errors.description" class="invalid-feedback" role="alert">
                                        <strong> {{ errors.description[0] }}</strong>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" v-model="product.price" class="form-control"
                                        :class="{'is-invalid': errors.price}" id="price">
                                    <span v-if="errors && errors.price" class="invalid-feedback" role="alert">
                                        <strong> {{ errors.price[0] }}</strong>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="size" class="form-label">Size</label>
                                    <input type="text" v-model="product.size" class="form-control"
                                        :class="{'is-invalid': errors.size}" id="size">
                                    <span v-if="errors && errors.size" class="invalid-feedback" role="alert">
                                        <strong> {{ errors.size[0] }}</strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="cat">Category:</label>
                                    
                                    <select v-model="product.category.id" class="form-control" :class="{'is-invalid': errors.category}" id="cat">
                                        <option v-for="category in categories" :key="category.id" :value="category.id"
                                            :selected="product.category.id === category.id">
                                            {{ category.name }} - {{ category.type }}
                                        </option>
                                    </select>
                                    
                                </div>
                                <div class="input-group mb-3">
                                    <input @change="handleOnChange" type="file" class="form-control" :class="{'is-invalid': errors.image}" id="inputGroupFile">
                                    <span v-if="errors && errors.image" class="invalid-feedback" role="alert">
                                        <strong> {{ errors.image[0] }}</strong>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" @click="isEdit = false" class="btn btn-danger">Back</button>
                            </form>
                        </template>


                        <template v-else>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>For a person</th>
                                        <th>Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>
                                        {{ product.name }}
                                    </td>
                                    <td style="width:200px">
                                        {{ product.description }}
                                    </td>
                                    <td>
                                        {{ product.price }} KM
                                    </td>
                                    <td>
                                        {{ product.category.name }}
                                    </td>
                                    <td>
                                        {{ product.category.type }}
                                    </td>
                                    <td>
                                        <button @click="show(product.id)" class="btn btn-outline-info btn-sm">Show</button>
                                        <button @click="edit(product.id)" class="btn btn-outline-warning btn-sm">Edit</button>
                                        <button @click="deleteProduct(product.id)" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'
export default {
    data () {
        return {
            isAdd: false,
            isShowSingle: false,
            isEdit: false,
            categories: [],
            products: [],
            product: '',
            selected: '',
            name: '',
            description: '',
            price: '',
            size: '',
            image: null,
            imagepreview: null,
            errors: '',
        }
    },

    methods: {

        getCategories () {
            axios.get('/api/employee/categories/get-categories')
            .then(res => {
                this.categories = res.data.categories
            }).catch(err => {
                console.log(err)
            })
        },

        getProducts () {
            axios.get('/api/employee/products/get-products')
            .then(res => {
                this.products = res.data.products
            }).catch(error => {
                console.log(error)
                
            })
        },
        handleOnChange (e) {
            this.image = e.target.files[0]

            let reader = new FileReader()
            reader.readAsDataURL(this.image)
            reader.onload = e => {
                this.imagepreview = e.target.result
            }
        },
        add () {
            let data = new FormData
            data.append('name', this.name)
            data.append('description', this.description)
            data.append('price', this.price)
            data.append('image', this.image)
            data.append('category', this.selected)
            data.append('size', this.size)
            
            axios.post('/api/employee/products/add-product', data)
            .then(res => {
                this.isAdd = false
                this.getProducts()
                this.name = ''
                this.description = ''
                this.price = ''
                this.size = ''
                this.selected = ''
            }).catch(err => {
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors
                }
            })
        },
        show (id) {
            this.isShowSingle = true
            this.product = this.products.find(item => {
                return item.id == id
            })
        },
        edit (id) {
            this.isEdit = true
            this.product = this.products.find(item => {
                return item.id == id
            });
        },
        update (product) {
            this.errors = ''
            let data = new FormData
            data.append('name',        product.name)
            data.append('description', product.description)
            data.append('price',       product.price)
            if (this.image) 
               data.append('image', this.image)
            
            data.append('image',       product.img)
            data.append('category',    product.category.id)
            data.append('size',        product.size) 
            axios.post('/api/employee/products/update-product/' + product.id, data)
            .then(res => {
                this.isEdit = false
                this.getProducts()
            }).catch(err => {
                 if (err.response.status == 422) {
                    this.errors = err.response.data.errors
                }
            })
        },
        deleteProduct (id) {
            if(confirm("Do you really want to delete?")){
                axios.delete('/api/employee/products/delete-product/' + id)
                .then(res => {
                    this.getProducts()
                }).catch(err => {
                    console.log(err)
                })
             }

        }
    },
    created () {
        this.getProducts()
        this.getCategories()
    },
    
}
</script>