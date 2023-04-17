<style>
.card-image {
    width: 100%;
    height: 300px;
    background-color: #fafafa;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
</style>

<template>
    <div class="row">
            <div class="col-md-12">
                <div class="title-section">
                    <h2 class="title">Our Products</h2>
                </div>
                <!-- /.title-section -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    <div class="d-flex justify-content-center align-items-center flex-wrap">
        <!-- if -->
        <div
            v-if="products.length > 0"
            class="d-flex align-content-start flex-wrap"
        >
            <div
                v-for="(product, ind) in products"
                class="mt-5"
                :key="ind + 'productBoxUser'"
                style="flex: 1; height: 100%"
            >
                <div
                    v-if="
                        product.product.status == true &&
                        product.product.stocks != 0
                    "
                    style="flex: 1; height: 100%"
                >
                    <div
                        class="card product"
                        style="
                            flex: 1;
                            height: 100%;
                            margin-right: 0.5rem;
                            width: 300px;
                        "
                    >
                        <!-- <div class="card-image" :style="{'background-image' : 'url('+ product.directory+'/'+product.product.folder + firstPreview(product.product.product_sample) +')'}"></div> -->
                        <div
                            class="card-image"
                            :style="{
                                'background-image':
                                    'url(' +
                                    'storage/' +
                                    product.product.product_cover +
                                    ')',
                            }"
                        ></div>

                        <div class="card-body" style="width: 300px">
                            <p class="card-title">
                                {{ product.product.title }}
                            </p>
                            <p class="card-text">
                                {{ product.product.price }} php
                            </p>

                            <!-- <h5 class="card-text">{{ priceRange(product.product.price, product.product.category_id) }}</h5> -->

                            <div class="d-flex w-full justify-content-end">
                                <a
                                    :href="url + product.product.slug"
                                    class="view-btn btn-hover"
                                    >View Details</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- else -->
        <div v-else class="fw-bold fs-5 ">No Products to show</div>
    </div>
</template>

<script>
export default {
    props: ["productDatas", "uid"],

    data() {
        return {
            products: JSON.parse(this.productDatas),
            // url: '#',
            url: "/menu/",
        };
    },

    methods: {
        // priceRange(price, category){
        //     price =  JSON.parse(price)
        //     if(price.length <= 0) return 0
        //     if(category == 2 || category == 4) return '₱'+ price
        //     let length = price.length
        //     let len = price[0].length
        //     let min = price[0][0].price;
        //     let max = price[0][0].price;
        //     for(let i = 0; i < length; i++){
        //         for(let j = 0; j < len; j++){
        //             let val = price[i][j].price
        //             min = (val < min) ? val : min;
        //             max = (val > max) ? val : max;
        //         }
        //     }
        //     if(parseFloat(max) < parseFloat(min)) return '₱' + max + ' - ₱' + min
        //     return '₱' + min + ' - ₱' + max
        // },
        // firstPreview(sample){
        //     let image = JSON.parse(sample)[0]
        //     return '/' + image
        // },
    },

    mounted() {
        //     // console.log(this.products)
        //     this.url = this.user == 'customer' ? '/shop/product-detail/' : (this.uid == 0 ? '/pos/details/' : '/staff/pos/details/')
        this.url = "/menu/";

        //     console.log(this.url)
    },
};
</script>
