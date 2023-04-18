<style>
.table tbody tr > * {
    padding-bottom: 20px !important;
}
</style>
<template>
    <!-- <div class="card-body"> -->
    <!-- <table id="table" class="table table-bordered table-striped"> -->
    <div class="table-wrapper table-responsive" id="table_wrapper">
        <table class="table striped-table table-hover" id="table">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Items</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Updated at</th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(payment, ind) in payments"
                    :key="ind + 'paymentsOrderSchedule'"
                >
                    <!-- Order No. -->
                    <td>
                        <button
                            style="
                                background: none;
                                border: none;
                                color: #2f80ed;
                            "
                            @click="openInNewTab(payment.trackingnumber)"
                            variant="link"
                        >
                            {{ payment.trackingnumber }}
                        </button>
                    </td>
                    <td>{{ payment.cart.length }}</td>
                    <td>{{ payment.user }}</td>
                    <td>₱ {{ parseFloat(payment.total_price).toFixed(2) }}</td>
                    <td>₱ {{ payment.amount_paid }}</td>
                    <td>
                        <select
                            @change="updateStatus(ind)"
                            v-model="payment.status"
                            class="form-select form-select-sm"
                            style="width: auto"
                            aria-label=".form-select-sm example"
                        >
                            <option
                                :disabled="
                                    counts[option] <= counts[payment.status]
                                "
                                v-for="option in options"
                                :value="option"
                            >
                                {{ option }}
                            </option>
                        </select>
                    </td>

                    <!-- ORDER DATE -->
                    <td>
                        {{ reformatDate(payment.created_at, "M-D-yyyy") }}
                    </td>
                    <!-- MODIFIED DATE -->
                    <td>
                        {{ reformatDate(payment.updated_at, "M-D-yyyy") }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";
import Swal from "sweetalert2";

export default {
    props: ["paymentsdata", "user"],

    data() {
        return {
            payments: [],
            oldPayments: [],
            payment: null,
            counts: {},
            // reason: "",
            // oldStatus: "",

            options: [],
            opts: [],

            amount: "",

            isLoading: false,

            // filterOpts: [
            //     { value: "status", text: "Order Status" },
            //     { value: "trackingnumber", text: "Order No." },
            //     { value: "created_at", text: "Order Date" },
            // ],

            // filterBy: "status",
            // keyword: "",
        };
    },

    methods: {
        reformatDate(date, format) {
            return moment(date).format(format);
        },

        async updateStatus(ind) {
            let self = this;
            this.isLoading = true;

            let selected = this.payments[ind].status;
            let id = this.payments[ind].id;

            let data = {
                id: id,
                status: selected,
            };

            await axios
                .post("/admin/orders/" + data.id, data)
                .then(function (res) {
                    if (res.data.hasError) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!...",
                            text: "Invalid Status Update!!",
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Success...",
                            text: "Data Updated Successfully!",
                            showConfirmButton: false,
                        }).then(() => {
                            self.isLoading = false;
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    self.isLoading = false;
                });

            this.isLoading = false;
        },

        openInNewTab(tracking) {
            window.open("/admin/orders/" + tracking, "_blank").focus();
        },
    },

    mounted() {
        this.payments = JSON.parse(this.paymentsdata);

        // let length = this.payments.length;

        // for (let i = 0; i < length; i++) {
        //     let carts = this.payments[i].cart;
        //     let len = carts.length;

        //     for (let j = 0; j < len; j++) {
        //         let price = JSON.parse(carts[j].product.price);

        //         this.payments[i].cart[j].product.price = this.findPrice(
        //             carts[j].color,
        //             carts[j].size,
        //             price,
        //             carts[j].product.category_id
        //         );
        //     }
        // }

        this.options = ["Order Placed", "Processing", "Completed", "Cancelled"];

        (this.counts = {
            Pending: -1,
            "Order Placed": 0,
            Processing: 1,
            Completed: 2,
            Cancelled: 2,
        }),
            (this.oldPayments = this.payments);
    },
};

$(document).ready(function () {
    $("#table")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            aaSorting: [],
            buttons: [
                {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: "th:not(:last-child)",
                    },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: "th:not(:last-child)",
                    },
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: "th:not(:last-child)",
                    },
                },
            ],
        })
        .buttons()
        .container()
        .appendTo("#table_wrapper .col-md-6:eq(0)");
});
</script>
