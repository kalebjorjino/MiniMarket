<template>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h4 class="mb-2"><b>Order Info</b></h4>
                <p class="mb-1">
                    <b>Order No.:</b>&nbsp; {{ payment.trackingnumber }}
                </p>
                <p class="mb-1">
                    <b>Order Date:</b>&nbsp;
                    {{ reformatDate(payment.created_at, "M-D-yyyy") }}
                </p>

                <p class="mb-1">
                    <b>Order Status:</b>&nbsp;
                    <span class="text-primary fw-bold">{{
                        payment.status
                    }}</span>
                </p>
            </div>
            <div>
                <h4 class="mb-2"><b>Payment Details</b></h4>
                <p class="mb-1">
                    <b>Transaction No.:</b>&nbsp; {{ payment.trackingnumberP }}
                </p>
                <p class="mb-1">
                    <b>Payment Status:</b>&nbsp;

                    {{
                        parseInt(payment.amount_paid) -
                            parseInt(payment.total_price) ==
                        0
                            ? "Paid"
                            : "Unpaid"
                    }}
                </p>
            </div>
            <div>
                <h4 class="mb-2"><b>Customer Info</b></h4>
                <p class="mb-1">
                    <b>Customer:</b>&nbsp; {{ payment.user.name }}
                </p>
                <p class="mb-1"><b>Email:</b>&nbsp; {{ payment.user.email }}</p>
                <p class="mb-1"><b>Phone:</b>&nbsp; {{ payment.user.phone }}</p>
            </div>
        </div>

        <!-- <div class="table-responsive">
            <table
                class="table table-secondary table-bordered border-table mt-4 text-center"
            > -->
        <div class="table-wrapper table-responsive mt-4">
            <table class="table striped-table">
                <thead>
                    <tr>
                        <th scope="col" style="padding: 15px 15px">#</th>
                        <th scope="col">Image</th>

                        <th scope="col">Product Title</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(cart, ind) in carts"
                        :key="ind + 'orderDetailsProduct'"
                    >
                        <th class="table-light px-3" scope="row">
                            {{ ind + 1 }}
                        </th>
                        <td class="table-light">
                            <img
                                height="100"
                                :src="path + cart.product.product_cover"
                                alt=""
                            />
                        </td>
                        <td class="table-light">{{ cart.product.title }}</td>

                        <td class="table-light">{{ cart.quantity }}</td>
                        <td class="table-light">
                            ₱{{ parseFloat(cart.product.price).toFixed(2) }}
                        </td>
                        <td class="table-light">
                            ₱{{
                                parseFloat(
                                    cart.product.price * cart.quantity
                                ).toFixed(2)
                            }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="5" class="text-end">
                            <span class="fw-bold">Total</span>
                        </th>
                        <td class="text-end">
                            ₱{{ parseFloat(payment.total_price).toFixed(2) }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="5" class="text-end">
                            <span class="fw-bold">Amount Paid</span>
                        </th>
                        <td class="text-end">
                            ₱{{ payment.amount_paid ? payment.amount_paid : 0 }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="5" class="text-end">
                            <span class="fw-bold">Balance</span>
                        </th>
                        <td class="text-end">
                            ₱{{
                                parseFloat(payment.total_price) -
                                parseFloat(
                                    payment.amount_paid
                                        ? payment.amount_paid
                                        : 0
                                )
                            }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <a href="/admin/orders" class="main-btn dark-btn btn-hover">Back</a>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ["paymentdata"],

    data() {
        return {
            payment: JSON.parse(this.paymentdata),
            carts: [],
            cart: null,
            path: `${window.location.protocol}//${window.location.hostname}/storage/`,
        };
    },

    methods: {
        reformatDate(date, format) {
            return moment(date).format(format);
        },
    },

    mounted() {
        this.carts = this.payment.cart;
    },
};
</script>
