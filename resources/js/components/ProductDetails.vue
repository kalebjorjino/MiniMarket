<style lang="scss">
.main-box {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 4rem;
    margin-bottom: 4rem;

    .btn-yellow {
        border: none;
        border-radius: 5px;
        padding: 0.45rem 0.75rem;
        background-color: #ddab54;
        color: white;
    }

    .btn-yellow:hover,
    .save-canvas:disabled {
        background-color: #828282;
    }

    .add-sticker {
        background-color: rgb(60, 164, 60);
        color: white;
        border: none;
        border-radius: 3px;
    }

    .customize {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 0.5rem;

        .canvas {
            border: 2px dashed #3fc5ff;
        }

        .product-details {
            flex: 1;
            max-width: 500px;
            margin-left: 2rem;

            .details-box {
                width: 100%;
                padding: 0.25rem;
                display: flex;
                flex-direction: column;

                .color-box,
                .text-box {
                    min-width: 35px;
                    min-height: 35px;
                }

                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                .qty-btn-plus,
                .qty-btn-minus,
                .qty-text {
                    border: #ededed 1px solid !important;
                    color: #b2b2b2;
                    background-color: white;
                    padding: 0.25rem;
                    max-width: 50px;
                    text-align: center;
                }

                .qty-btn-minus {
                    border-radius: 3px 0px 0px 3px;
                }
                .qty-btn-plus {
                    border-radius: 0px 3px 3px 0px;
                }

                .qty-btn-minus:before {
                    background: #fff;
                }
                .qty-btn-plus:before {
                    background: #fff;
                }
            }

            .preview-btn {
                padding: 0.5rem;
                // background-color: #D9D9D9;
                background-color: #ddd;
                text-align: center;
                border: none;
            }

            .selected-btn {
                // background-color: #B3B3B3 !important;
                background-color: #cacac8 !important;
            }

            .selected {
                border: 2px solid #ddab54 !important;
                box-shadow: 0rem 0rem 0.5rem rgba($color: #ddab54, $alpha: 0.15);
            }
        }
    }

    .product-sample {
        width: 100%;
        max-height: 300px;
        margin-top: 1rem;

        .my-carousel {
            width: 100%;
            height: 280px;
            display: flex;

            .carousel-btn {
                border: none;
                background-color: transparent;
                color: black;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 80px;
                height: 100%;
            }

            .carousel-btn:disabled {
                color: #b3b3b3 !important;
            }

            .carousel-content {
                flex: 1;
                height: 100%;
                display: none;
            }

            .active {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        }
    }

    .small-details {
        width: 100%;
        max-width: 950px;
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        font-weight: 500;
    }
}
</style>

<template>
    <div class="main-box">
        <div class="customize">
            <div>
                <img
                    ref="box"
                    :style="{ 'max-width': 450 + 'px' }"
                    :src="imageUrl"
                    alt=""
                />

                <!-- <img ref="box" v-show="!customize" :style="{'background-color': '#'+color, 'max-width' : 450+'px'}" :src="directory+'/'+preview" alt=""> -->
            </div>

            <div class="product-details">
                <div class="details-box">
                    <span class="mt-1">{{ category }} </span>
                    <h3 class="mt-1 mb-3 fw-bold">{{ product.title }}</h3>
                    <div
                        class="fw-normal mb-2"
                        v-html="product.description"
                    ></div>

                    <div class="d-flex align-items-center">
                        <!-- <h6 style="margin-right: 1.5rem; margin-bottom: 0px;"> Price: </h6> -->
                        <h3 class="my-2 fw-bold">
                            &#8369;&nbsp; {{ parseFloat(price).toFixed(2) }}
                        </h3>
                        <!-- <h5 style="margin-bottom: 0px;"> &#8369;&nbsp; {{maglathala == 'Colored' ? parseInt(product.print_price)*this.qty + parseInt(price): parseInt(price)}}</h5> -->
                    </div>

                    <div class="d-flex align-items-center">
                        <span style="margin-right: 1.5rem; font-size: 0.85rem">
                            Stocks: {{ stocks }}</span
                        >
                    </div>

                    <h6 class="mt-4 fw-normal">Quantity</h6>
                    <div class="d-flex">
                        <button
                            @click="changeQty(-1)"
                            class="btn qty-btn-minus"
                        >
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input
                            class="qty-text"
                            type="text"
                            min="1"
                            v-model="qty"
                            @change="changeQty(0)"
                        />
                        <button @click="changeQty(1)" class="btn qty-btn-plus">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                        <button
                            :disabled="isLoading"
                            class="view-btn ms-3"
                            @click="addToCart()"
                        >
                            Add to Cart
                            <i
                                v-if="isLoading"
                                class="fa-solid fa-circle-notch fa-spin ml-2"
                            ></i>
                        </button>
                    </div>

                    <!-- <div class="w-75 d-flex justify-content-end align-items-center mt-4">
                        <button :disabled="isLoading" class="view-btn" @click="addToCart()" > Add to Cart  <i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin ml-2"></i> </button>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- <div class="product-sample">
            <h6> PRODUCT SAMPLES</h6>

            <div     class="my-carousel">
                <button @click="changeSlide(-1)" :disabled="slide == 0" class="carousel-btn"><i class="fa-solid fa-chevron-left"></i></button>

                <div :class="[{active: slide == ind}, 'carousel-content']" v-for="(sample, ind) in samples" :key="ind+'carouselMainSlide'">
                    <div class="w-100 d-flex justify-content-evenly align-items-center" >
                        <img v-for="(image, index) in sample" :src="directory+'/'+image" alt="" width="200" :key="index+'carouselSlideImageBox'">
                    </div>
                </div>
                <button @click="changeSlide(1)" :disabled="slide == Math.ceil(samples.length/3)-1" class="carousel-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div> -->

        <!-- <div class="small-details">
            <div style=" width: 100%;">
                <div>
                    <h6 class="mb-3 fw-bolder">DESCRIPTION</h6>
                    <div v-html="product.description"> </div>
                </div> -->
        <!-- <div style="margin-top: 5rem">
                    <h6>CUSTOMIZATION GUIDELINES</h6>
                    <div v-html="product.guidelines"> </div>
                </div> -->
        <!-- </div>
        </div> -->
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    props: ["productData", "uid"],

    data() {
        return {
            hasSaved: true,
            product: [],
            isLoading: false,

            // colors: [],
            // papers: [],
            // sizes: [],
            previews: [],
            // prints: ['Black & White', 'Colored'],

            // color: '',
            // size: '',
            price: "",
            // preview: '',
            // paper: '',
            // maglathala: '',
            // notes: '',

            price: 0,
            // prices: [],
            cInd: 0,
            sInd: 0,

            qty: 1,

            // directory: '',

            samples: [],
            slide: 0,

            // stickers: [],
            // customize: false,
            // width: 0,
            // height: 0,

            // canva: [],
            active: null,

            imageUrl: "",
            category: "",
            stocks: 0,
        };
    },

    methods: {
        validate() {
            let errors = [];

            // if(this.color == ''){
            //     if(this.product.category_id == 2 || product.category_id == 4) error.push('You have not choose a type of cut')
            //     errors.push('You have not choose a color of the product')
            // }
            // if(this.size == ''){
            //     errors.push('You have not choose a size of the product')
            // }
            // if(this.product.category_id == 2 && this.paper == ''){
            //     errors.push('You have not choose a type of paper')
            // }
            // if(this.product.category_id == 4 && this.paper == ''){
            //     errors.push('You have not choose a type of decal material')
            // }
            // if(this.maglathala == ''){
            //     errors.push('You have not choose a print color')
            // }
            // if(this.qty < 12){
            //     errors.push('Minimum quantity is 12 per items...')
            // }
            return errors;
        },

        async addToCart() {
            // let errors = null
            let errors = 0;

            // if(!this.hasSaved && this.customize){
            //     await Swal.fire({
            //         title: 'Are you sure?',
            //         text: "The recently changes in canvas won't be saved",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes'
            //     })
            //     .then((result) => {
            //         if (result.isConfirmed) {
            //            errors = this.validate()
            //         }
            //     })
            // }else{
            //     errors = this.validate()
            // }

            if (errors.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oh no...",
                    html: errors.join("<br>"),
                    showConfirmButton: false,
                });
            } else {
                this.isLoading = true;
                let self = this;

                const formdata = new FormData();
                formdata.append("product_id", this.product.id);
                // formdata.append('deadline', this.date)
                // formdata.append('notes', this.notes)
                formdata.append("quantity", this.qty);
                // formdata.append('size', this.size)
                // formdata.append('color', this.color)
                // formdata.append('print_color', this.maglathala)
                // formdata.append('category_id', this.product.category_id)
                formdata.append("uid", this.uid);
                // if(this.product.category_id == 2 || this.product.category_id == 4) formdata.append('paper', this.paper)

                // console.log()

                // let objects = []

                // if(this.customize){
                //     let length = this.canva.length;

                //     for(let i = 0; i < length; i++){
                //         let object = JSON.parse( JSON.stringify(this.canva[i].canvas) )

                //         if(object.objects.length > 0 && this.canva[i].url){
                //             objects.push(this.canva[i].url)
                //         }
                //     }
                // }

                // if(objects.length > 0){

                //     length = objects.length

                //     for(let i = 0; i < length; i++){
                //         formdata.append('canvas[]', objects[i])
                //     }

                //     length = this.stickers.length

                //     for( let i =0; i < length ; i++) {
                //         formdata.append('stickers[]', this.stickers[i].file)
                //     }

                //     formdata.append('length', length)
                // }

                // else formdata.append('length', 0)

                await axios
                    .post("/addtocart", formdata)
                    .then(function (res) {
                        if (res.data.hasError) {
                            Swal.fire({
                                icon: "error",
                                title: "Oh no...",
                                text: "Please enter a right Input thanks",
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: " Product has been added to your cart!",
                                showConfirmButton: false,
                            });
                            window.location.href = "/menu";
                        }
                        self.isLoading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                        Swal.fire({
                            icon: "error",
                            title: "Oh no...",
                            text: "Error in Back end please refresh the page or contact us if error persist",
                            showConfirmButton: false,
                        });
                        self.isLoading = false;
                    });

                this.isLoading = false;
            }
        },

        // changeColor(color, ind){
        //     this.hasSaved = false

        //     this.color = color
        //     this.cInd = ind

        //     if( this.product.category_id != 2 && this.product.category_id != 4) this.changePrice()

        //     let length = this.previews.length

        //     for(let i = 0; i < length; i++){
        //         this.canva[i].canvas.backgroundColor= "#"+color;
        //         this.canva[i].canvas.renderAll()
        //     }

        // },
        // changeSize(size, ind){
        //     this.size = size
        //     this.sInd = ind
        //     if( this.product.category_id != 2 && this.product.category_id != 4) this.changePrice()
        // },

        // changePaper(paper){ this.paper = paper },

        // changePrint(print) { this.maglathala = print },

        // changePreview(preview, ind){

        //     this.preview = preview

        //     if(this.customize){
        //         let length = this.previews.length
        //         for(let i = 0; i < length; i++){ this.canva[i].active = false }

        //         this.canva[ind].active = true
        //         this.active = ind
        //     }
        // },

        toArrayData(data, key) {
            let length = data.length;
            let arr = [];

            for (let i = 0; i < length; i++) {
                arr.push(data[i][key]);
            }

            return arr;
        },

        changePrice() {
            // if(this.color != '' && this.size != ''){
            //     this.price = parseInt(this.prices[this.cInd][this.sInd].price) * parseInt(this.qty)
            // }
            this.price = parseFloat(this.product.price) * parseInt(this.qty);
        },

        changeQty(val) {
            this.qty = parseInt(this.qty) + parseInt(val);
            this.checkQty();
            this.changePrice();
        },

        checkQty() {
            if (this.qty == "" || this.qty < 0 || !/^\d*\.?\d*$/.test(this.qty))
                this.qty = 1;
            if (this.qty >= this.product.stocks) {
                this.qty = this.product.stocks;
            }
        },

        changeSlide(val) {
            this.slide += val;

            if (this.slide < 0) this.slide = 0;
            if (this.slide > Math.ceil(this.samples.length / 3))
                this.slide += -1;
        },

        // addSicker(){

        //     if(this.stickers.length > 4){
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oh no...',
        //             text: "Maximum of 5 images only...",
        //             showConfirmButton: false
        //         })
        //     }
        //     else{
        //         let file = this.$refs['file'].files[0]

        //         if(file){
        //             let mb = file.size / (1024*1024)

        //             if( mb > 50){
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Oh no...',
        //                     text: "File size is limited to 50 mb only...",
        //                     showConfirmButton: false
        //                 })
        //             }
        //             else{
        //                 let obj = {
        //                     preview: null,
        //                     file: file,
        //                 }

        //                 let reader = new FileReader

        //                 reader.onload = e =>{
        //                     obj.preview = e.target.result
        //                 }

        //                 reader.readAsDataURL(file)

        //                 this.stickers.push(obj)
        //             }
        //         }
        //     }
        // },

        getImageUrl(path) {
            return `${window.location.protocol}//${window.location.hostname}/storage/${path}`;
        },
    },

    mounted() {
        let data = JSON.parse(this.productData);

        // this.directory = data.category.folder_cat + '/' + data.product.folder

        this.product = data.product;

        this.category = data.category;

        // this.colors = this.toArrayData( data.colors, 'color')
        // this.sizes = this.toArrayData( data.sizes, 'size')
        // if(this.product.category_id == 2 || this.product.category_id == 4) this.papers = this.toArrayData( data.papers, 'paper')

        // this.previews = JSON.parse(data.product.preview_image)

        // this.preview = this.previews[0]
        // this.color = this.colors[0]

        // if(this.product.category_id == 2 || this.product.category_id == 4){
        //     this.price = JSON.parse(this.product.price)
        // }
        // else{
        //     this.prices = JSON.parse(this.product.price)
        // }

        // this.prices = JSON.parse(this.product.price)
        this.price = this.product.price;

        this.stocks = this.product.stocks;

        // let samples = JSON.parse(this.product.product_sample)
        // let count = samples.length
        // let length = Math.ceil(count/3)

        // for(let i = 0; i < length; i++){
        //     let data = []

        //     count = count - 3
        //     let num = count < 0 ? count+3: 3

        //     for(let j = 0; j < num ; j++){
        //         data.push(samples.shift())
        //     }

        //     this.samples.push(data)
        // }

        // length = this.previews.length
        // for( let i = 0; i < length; i++){
        //     this.canva.push({
        //         canvas: null,
        //         active: false,
        //         url: null,
        //     })
        // }

        this.imageUrl = this.product.product_cover;
        this.imageUrl = this.getImageUrl(this.imageUrl);

        console.log(this.product);
    },
};
</script>
