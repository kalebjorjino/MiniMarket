<style>
    .update-btn{
        background-color: #2E32CD !important;
        color: white !important;
    }

    .update-btn:disabled, .proceed-btn:disabled{
        background-color: #f3f3f3 !important;
        color: black !important;
    }

    .proceed-btn:disabled:before, .update-btn:disabled:before {
        background-color: #f3f3f3 !important;
    }
</style>

<template>
    
    <div class="col-lg-12">

<!-- 
        <div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
   
 -->

        <!-- <b-modal 
            ref="order-summary" size="lg" centered scrollable 
            header-border-variant="transparent" footer-border-variant="transparent"
        > -->
            
            <!-- <template #modal-header="{ close }">
                <h5>Order Summary</h5>
                <b-button size="sm" variant="transparent" @click="close()">
                    <i class="fa-solid fa-x"></i>
                </b-button>
            </template>

            <div class="d-flex flex-column w-100 justify-content-center align-items-start">
                <b class="mb-3">ITEMS:</b>
                <p v-for="(cart, ind) in carts" :key="ind+'cartProceedModal'" style="margin-left: .75rem">{{cart.product.title}}&nbsp;&nbsp;x{{cart.qty}}&nbsp;&nbsp;&#8369;{{parseInt(cart.product.price)*parseInt(cart.qty)}}</p>
                
                <div class="d-flex mb-3 mt-4 align-items-center">
                    <b>TOTAL:</b>
                    <p style="margin-left: .75rem; margin-bottom: 0px;">&#8369;&nbsp;{{total}}</p>
                </div>
            </div>

            <template #modal-footer="{ cancel }">
                <b-button :disabled="isLoading" class="px-4 py-2" size="sm" style="background-color: #DDAB54; color: white; border: 0;" @click="requestOrder()">
                    REQUEST ORDER <i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin ml-2"></i>
                </b-button>

                <b-button class="px-4 py-2" size="sm" variant="light" @click="cancel()"> CANCEL </b-button>
            </template> -->

        <!-- </b-modal> -->

    <!-- </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th class="p-name">Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th><i class="fas fa-xmark"></i></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="(cart, ind) in carts" :key="ind+'8===Dcarts'">
                        <td class="cart-pic first-row">
                            <!-- <img v-if="cart.upload_design.length <= 0" height="100" :src="cart.product.directory + cart.product.preview "  alt="">
                            <img v-else height="100" :src="cart.canvas[0].image" :style="{'background-color': '#'+cart.hex}" alt=""> -->
                            <img height="100" :src="path + cart.product.product_cover" alt="">
                        </td>

                        <td class="cart-title first-row">
                            <a :href="prodUrl + cart.product.slug">
                                <h5>{{ cart.product.title }}</h5> 
                            </a>


                            <!-- <ul class="list-inline product-options">
                                <li class="list-inline-item">
                                    <label>Size:</label> {{ cart.size }}
                                </li>
                                <li class="list-inline-item">
                                    <label>{{cart.category_id == 2 || cart.category_id == 4 ? 'Cut:' : 'Color:'}}</label> {{ cart.color }}
                                </li>
                                <li v-if="cart.category_id == 2 || cart.category_id == 4" class="list-inline-item">
                                    <label>{{cart.category_id == 2 ? 'Paper:' : 'Material'}}</label> {{ cart.paper }}
                                </li>

                                <li class="list-item">
                                    <label>Print:</label> {{ cart.print_color }}
                                </li>
                            </ul> -->
                        </td>

                        <td class="p-price first-row"
                            :id="'price' + cart.id">
                            <p>{{cart.product.price}}</p>
                            <!-- <p v-if="cart.print_color == 'Colored'"> <span class="fw-normal text-dark">add'l:</span> {{cart.product.print_price}}</p> -->
                            
                        </td>

                        <td class="qua-col first-row">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <span class="dec qtybtn" @click="changeQty(-1, ind)" >-</span>
                                    <input type="text" @change="checkQty(ind)" v-model="cart.qty" class="prod-qty">
                                    <span class="inc qtybtn" @click="changeQty(1, ind)">+</span>
                                </div>
                            </div>
                        </td>

                        <td class="total-price first-row" id="total-price">{{ parseFloat(cart.product.price) * parseInt(cart.qty) }}</td>
                        <td class="close-td first-row" @click="deleteCart(ind, cart.id)"><i class="fas fa-xmark"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div v-if="parseInt(uid) > 0" class="d-flex w-100 align-items-center justify-content-end mb-4">
            
            <h6 style="margin-right: .5rem" class="mb-0">Deadline <small style="color:lightslategray">( <span style="color: red">*</span>min of 3 days production time)</small></h6>
            <date-picker 
                is-expanded v-model="date" :min-date="minDays()" color="red" mode="date" :masks="{input: 'MMMM DD, YYYY'}"
            >
                <template v-slot="{ inputValue, inputEvents }">
                    <input
                        style="border: 1px solid #B3B3B3 !important;"
                        class="px-2 py-1 border-dark rounded focus:outline-none w-100 p-2"
                        :value="inputValue"
                        v-on="inputEvents"
                    />
                </template>
            </date-picker>

        </div> -->

        <div class="row">
            <div class="col-lg-4">
                <div class="cart-buttons">
                    <a href="/menu" class="primary-btn continue-shop">Continue shopping</a>
                    <button @click="updateCart()" :disabled="canUpdate || isLoading" class="primary-btn up-cart update-btn">Update cart  <i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin ml-2"></i></button>
                </div>
            </div>

            <div class="col-lg-4 offset-lg-4">
                <div class="proceed-checkout">
                    <ul>
                        <!-- <li class="subtotal">Subtotal ₱<span>240.00</span></li> -->
                        <li class="cart-total">Total <span>₱ {{total}}</span></li>
                    </ul>
                    <!-- <button @click="proceed()" :disabled="canProceed" class="proceed-btn">PROCEED TO CHECK OUT <span class="text-danger" v-if="canProceed"> *Total quantity of order must be 12 or more</span></button> -->

                    <!-- <button @click="requestOrder()" class="proceed-btn">PROCEED TO CHECK OUT</button> -->

                    <!-- <button :disabled="isLoading || !canUpdate" @click="requestOrder()" class="proceed-btn mt-2">PROCEED TO CHECK OUT<i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin ml-2"></i></button> -->

                    <button :disabled="isLoading || !canUpdate || total == 0" @click="proceedCheckout()" class="proceed-btn mt-2">PROCEED TO CHECK OUT<i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin ml-2"></i></button>
                </div>
            </div>
        </div>
</div>
</template>

<script>
    // import Swal from 'sweetalert2'
    // import DatePicker from 'v-calendar/lib/components/date-picker.umd'
    // import { BModal, BButton } from 'bootstrap-vue'
    // import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
    // const ntc = require('ntcjs');

    export default {
        props: ['cartsdata', 'uid'],
        // components: { BModal, BButton},

        data(){
            return{
                isLoading: false,
                carts: [],

                // date: this.minDays(),
                oldQty: [],
                // imageUrl: [],

                path:`${window.location.protocol}//${window.location.hostname}/storage/`,

                prodUrl:`menu/`,
            }
        },
       

        methods: {

            proceed(){ this.$refs['order-summary'].show() },

            async deleteCart(ind, id){
                let self = this

                await Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert it once confirmed",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28A745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.isLoading = true

                        axios.post("/cart/delete", { id: id})
                        .then( function (res){
                            if(res.hasError){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oh no...',
                                    text: "Error in server please refresh the page or contact us if error persist",
                                    showConfirmButton: false
                                })
                            }
                            else{
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: "Succesfully deleted!",
                                    showConfirmButton: false
                                })
                            }
                            self.isLoading = false
                        })
                        .catch( function (error){
                            console.log(error)
                            self.isLoading = false
                        })

                        this.carts.splice(ind, 1)
                        this.oldQty.splice(ind, 1)
                    }
                })

                this.isLoading = false
            },
            
            populateCart(data, ind){
                let obj = {
                    id: data.cart.id,
                    category_id: data.cart.product.category_id,
                    product: data.product,
                    
                    // upload_design: data.cart.upload_design ? JSON.parse(data.cart.upload_design): [],
                    // canvas: data.canvas,
                    // size: data.cart.size,
                    // color: data.cart.product.category_id == 2 || data.cart.product.category_id == 4 ? data.cart.color :this.hexToColorName(data.cart.color),
                    // hex: data.cart.color,
                    // paper: data.cart.paper,
                    // print_color: data.cart.print_color,

                    qty: data.cart.quantity,
                    ind: ind,
                    // cover: data.cart.product.product_cover

                    stocks: data.cart.product.stocks,

                }

                


                this.oldQty.push(obj.qty)
                // obj.product.price = this.findPrice(obj.hex, obj.size, obj.product.price, obj.category_id)
                // obj.product.price 
                // this.total += parseInt(obj.product.price) * parseInt(obj.qty)

                this.carts.push(obj)
            },

            async updateCart(){
                let self = this
                this.isLoading = true

                let carts = []
                let length = this.carts.length
                let old = []

                for(let i = 0; i < length; i++){
                    carts.push({
                        id: this.carts[i].id,
                        qty: this.carts[i].qty,
                    })

                    old.push(this.carts[i].qty)
                }
                
                await axios.post("/cart/update", { carts: carts})
                .then( function (res){
                    if(res.hasError){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oh no...',
                            text: "Error in Back end please refresh the page or contact us if error perssist",
                            showConfirmButton: false
                        })
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Succesfully updated!",
                            showConfirmButton: false
                        })

                        self.oldQty = old
                    }
                    self.isLoading = false
                })
                .catch( function (error){
                    console.log(error)
                    self.isLoading = false
                })

                this.isLoading = false
            },
            
            changeQty(val, ind){
                this.carts[ind].qty = parseInt(this.carts[ind].qty) + val 
                this.checkQty(ind)
            },

            async requestOrder(){
                let self = this
                this.isLoading = true
                
                await axios.post("/cart/request", { id: this.uid, total: this.total})
                .then( function (res){
                    if(res.hasError){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oh no...',
                            text: "Error in backend please refresh the page or contact us if error persist",
                            showConfirmButton: false
                        })
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Succesfully updated!",
                            showConfirmButton: false
                        })
                        
                        // let url = self.uid > 0 ? '/shop/checkout/order-success/'+res.data.tracking : (self.uid == 0 ? '/pos/checkout/order-success/'+res.data.tracking : '/staff/pos/checkout/order-success/'+res.data.tracking)
                        let url = '/cart/checkout/order-success/'+res.data.tracking 

                        window.location.href = url
                    }
                    self.isLoading = false
                })
                .catch( function (error){
                    console.log(error)
                    self.isLoading = false
                })

                this.isLoading = false
            },
            
            checkQty(ind){
                if(/^\d*\.?\d*$/.test(this.carts[ind].qty)){
                    if (parseInt(this.carts[ind].qty) <= 0) this.carts[ind].qty = 1
                    if (this.carts[ind].qty >= this.carts[ind].stocks) {
                        this.carts[ind].qty = this.carts[ind].stocks;
                    }
                }
                else{
                    this.carts[ind].qty = 1
                }
            },

            getImageUrl(path) {
                return `${window.location.protocol}//${window.location.hostname}/storage/${path}`;
            },

            proceedCheckout() {
                window.location.href = '/cart/checkout';
            }


            // hexToColorName(hex){ return ntc.name(hex)[1]; },

            // findPrice(color, size, price, category_id){
            //     if(category_id == 2 || category_id == 4) return price
            //     else{
            //         let length = price.length
            //         let len = price[0].length
                
            //         for(let i = 0; i < length; i++){
            //             for(let j = 0; j < len; j++){
            //                 if(price[i][j].size == size && price[i][j].color == color) return price[i][j].price
            //             }
            //         }
            //     }

            //     return 0
            // },

            // minDays(){
            //     let min = new Date()
            //     min.setDate(min.getDate() + 3)
            //     return min
            // },

        },

        computed: {
            canUpdate(){
                
                let length = this.carts.length

                for(let i = 0; i < length ; i++){
                    if(this.oldQty[i] != this.carts[i].qty) return false
                }
                
                return true
            },

            // canProceed(){
            //     let length = this.oldQty.length
            //     let count = 0

            //     for(let i = 0; i < length ; i++){
            //         count += parseInt(this.oldQty[i])
            //     }

            //     if(count >= 12) return false

            //     return true
            // },

            total(){
                let total = 0
                let length = this.carts.length

                for(let i =0; i < length; i++){
                    // let print = 0

                    // if(this.carts[i].print_color == 'Colored') print = parseInt(this.carts[i].product.print_price)
                    // total += parseInt(this.carts[i].product.price) * parseInt(this.carts[i].qty) + print*parseInt(this.carts[i].qty)
                    total += parseFloat(this.carts[i].product.price) * parseInt(this.carts[i].qty)
                }

                return total;
            },
        },

        mounted() {
            
            let data = JSON.parse(this.cartsdata)
            
            data.forEach(this.populateCart)

            console.log(this.carts)
        }
    } 
</script>