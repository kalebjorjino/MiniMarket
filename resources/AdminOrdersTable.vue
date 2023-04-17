<style>
.select-style {
    padding: 0.25rem;
    flex: 1;
    height: 38px !important;
    max-width: 280px;
    border: 1px rgb(223, 223, 223) solid;
    margin-right: 0.25rem;
    border-radius: 0px 3px 3px 0px !important;
}

.filter-select {
    max-width: 180px;
    background-color: rgba(128, 128, 128, 0.15);
    padding: 0.25rem;
    border-radius: 3px 0px 0px 3px;
    border: 1px rgb(223, 223, 223) solid;
    height: 38px !important;
}

.fw-bold-c {
    font-weight: bold;
}

.success-header,
.success-body,
.lower,
.success-footer {
    text-align: left;
    width: 100%;
    padding: 0px !important;
}

.divider {
    margin-top: 0.75rem !important;
    margin-bottom: 0.75rem !important;
    width: 100% !important;
}
</style>

<template>
    <div class="card">
        <b-modal
            ref="loading"
            v-model="isLoading"
            hide-footer
            hide-header
            centered
            no-close-on-backdrop
        >
            <div class="text-center w-100 p-5">
                <i class="fa-solid fa-circle-notch fa-spin fa-2xl"></i>
            </div>
        </b-modal>

        <b-modal
            ref="update"
            centered
            scrollable
            no-close-on-backdrop
            header-border-variant="transparent"
            footer-border-variant="transparent"
        >
            <template #modal-header="{ close }">
                <h5 v-if="payment">
                    Status Update | {{ payment.trackingnumber }}
                </h5>
                <b-button
                    size="sm"
                    variant="transparent"
                    @click="closeUpdateModal()"
                >
                    <i class="fa-solid fa-x"></i>
                </b-button>
            </template>

            <div class="input-group mt-3" v-if="payment">
                <h3>
                    Are you Sure? update
                    <b>{{ payment.trackingnumber }}</b> status to
                    <b>{{ payment.status }}</b>
                </h3>
                <div class="w-100 mt-4" v-if="payment.status == 'Cancelled'">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Reason"
                        v-model="reason"
                    />
                </div>
                <!-- <div class="custom-file">
                    <input @change="showPicture()" ref="fileBox" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div> -->
            </div>

            <template #modal-footer="{ close }">
                <div class="w-100">
                    <b-button
                        variant="success"
                        size="sm"
                        class="float-right"
                        @click="updateStatus()"
                    >
                        Save
                    </b-button>

                    <b-button
                        variant="secondary"
                        size="sm"
                        class="float-right"
                        @click="closeUpdateModal()"
                    >
                        Close
                    </b-button>
                </div>
            </template>
        </b-modal>

        <div class="card-header">
            <div class="d-flex align-items-center justify-content-end">
                <b-form-select
                    @change="neutralize()"
                    v-model="filterBy"
                    class="filter-select"
                    :key="'selectrss'"
                    :options="filterOpts"
                ></b-form-select>

                <date-picker v-if="filterBy == 'created_at'" v-model="keyword">
                    <template v-slot="{ inputValue, inputEvents }">
                        <input
                            class="px-2 py-1 border-dark rounded focus:outline-none w-100 p-2"
                            :value="inputValue"
                            v-on="inputEvents"
                        />
                    </template>
                </date-picker>

                <b-form-select
                    v-else-if="filterBy == 'status'"
                    v-model="keyword"
                    class="select-style"
                    :key="'selectrss2'"
                    :options="options"
                ></b-form-select>
                <!-- <b-form-select v-else-if="filterBy == 'payment'" v-model="keyword" class="select-style" :key="'selectrss4'" :options="payOpt"></b-form-select> -->
                <b-form-input
                    v-else
                    style="max-width: 280px"
                    v-model="keyword"
                    :id="'inline-form-input-username'"
                    placeholder=""
                ></b-form-input>

                <button
                    type="button"
                    class="btn float-right"
                    @click="filterTable()"
                    style="
                        background-color: #ddab54;
                        border-color: #b48845;
                        color: white;
                    "
                >
                    <i class="nav-icon fa-solid fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Order No.</th>
                        <th>Items</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="(payment, ind) in payments"
                        :key="ind + 'paymentsOrderSchedule'"
                    >
                        <td>
                            {{ reformatDate(payment.created_at, "M-D-yyyy") }}
                        </td>
                        <td>
                            <b-button
                                @click="openInNewTab(payment.trackingnumber)"
                                variant="link"
                                >{{ payment.trackingnumber }}</b-button
                            >
                        </td>
                        <td>{{ payment.cart.length }}</td>
                        <td>{{ payment.user }}</td>
                        <td>₱ {{ payment.total_price }}</td>
                        <td>
                            <select
                                v-if="payment.user != 'Walk-in'"
                                @click="changeOldStatus(payment.status)"
                                @change="toggleModal(ind, 'update')"
                                v-model="payment.status"
                                class="form-select form-select-sm"
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

                            <select
                                v-else
                                @click="changeOldStatus(payment.status)"
                                @change="toggleModal(ind, 'update')"
                                v-model="payment.status"
                                class="form-select form-select-sm"
                                aria-label=".form-select-sm example"
                            >
                                <option
                                    :disabled="
                                        counts[opt] <= counts[payment.status]
                                    "
                                    v-for="opt in opts"
                                    :value="opt"
                                >
                                    {{ opt }}
                                </option>
                            </select>
                        </td>
                        <!-- <td>
              {{
                payment.user == 'Walk-in'
                  ? 'Fully Paid'
                  : payment.payment_image_url
                  ? payment.amount_paid
                    ? parseInt(payment.amount_paid) - parseInt(payment.total_price) == 0
                      ? 'Fully Paid'
                      : 'Partially Paid'
                    : 'Unverified'
                  : 'Unpaid'
              }}
            </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
// import DatePicker from 'v-calendar/lib/components/date-picker.umd'
// import Swal from 'sweetalert2'
// import { BFormInput, BFormSelect, BModal, BButton } from 'bootstrap-vue'
// import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
// import axios from 'axios'

export default {
    props: ["paymentsdata", "user"],

    components: { DatePicker, BFormInput, BFormSelect, BModal, BButton },

    data() {
        return {
            payments: [],
            oldPayments: [],
            payment: null,
            counts: {},
            reason: "",
            oldStatus: "",

            options: [],
            opts: [],
            editing: false,
            amount: "",

            isLoading: false,

            filterOpts: [
                { value: "status", text: "Order Status" },
                { value: "trackingnumber", text: "Order No." },
                { value: "created_at", text: "Order Date" },
            ],

            filterBy: "status",
            keyword: "",
        };
    },
    methods: {
        closeUpdateModal() {
            console.log(this.oldStatus);
            this.$refs.update.hide();
            this.payment.status = this.oldStatus;
            this.oldStatus = "";
        },

        changeOldStatus(oldStatus) {
            if (this.oldStatus == "") this.oldStatus = oldStatus;
        },

        toggleModal(ind, modal) {
            this.payment = this.payments[ind];
            this.$refs[modal].show();
        },

        neutralize() {
            this.keyword = "";
        },

        filterTable() {
            this.payments = this.keyword
                ? this.oldPayments.filter((item) =>
                      this.filterBy == "created_at"
                          ? this.reformatDate(item.created_at, "M-D-yyyy") ==
                            this.reformatDate(this.keyword, "M-D-yyyy")
                          : item[this.filterBy]
                                .toLowerCase()
                                .includes(this.keyword.toLowerCase())
                  )
                : this.oldPayments;
        },

        openInNewTab(tracking) {
            window
                .open(
                    "/" + this.user + "/print/order/details/" + tracking,
                    "_blank"
                )
                .focus();
        },

        async updateStatus() {
            let self = this;
            this.isLoading = true;

            let selected = this.payment.status;
            let id = this.payment.id;

            let data = {
                id: id,
                status: selected,
                reason: this.reason,
            };

            if (selected == "Cancelled" && data.reason == "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops!...",
                    text: "You forgot to provide a reason why it is cancelled!!",
                    showConfirmButton: false,
                });
            } else {
                await axios
                    .post("/admin/orders/update/status/" + data.id, data)
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
                            });
                            self.$refs["update"].hide();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.isLoading = false;
                    });
            }

            this.isLoading = false;
        },

        toggleModal(ind, modal) {
            this.payment = this.payments[ind];
            this.$refs[modal].show();
        },

        reformatDate(date, format) {
            return moment(date).format(format);
        },

        findPrice(color, size, price, category_id) {
            if (category_id == 2) return price;
            else {
                let length = price.length;
                let len = price[0].length;

                for (let i = 0; i < length; i++) {
                    for (let j = 0; j < len; j++) {
                        if (
                            price[i][j].size == size &&
                            price[i][j].color == color
                        )
                            return price[i][j].price;
                    }
                }
            }

            return 0;
        },

        toggleEditing() {
            this.editing = !this.editing;
        },

        async updateAmount() {
            let self = this;
            this.isLoading = true;

            await axios
                .post("/admin/update/amount", {
                    id: this.payment.id,
                    amount: this.amount,
                })
                .then(function (res) {
                    Swal.fire({
                        icon: "success",
                        title: "Success...",
                        text: "Amount Successfully Updated",
                        showConfirmButton: false,
                    }).then(() => {
                        self.editing = false;
                        self.payment.amount_paid = self.amount;
                        self.amount = "";
                        self.isLoading = false;
                    });
                })
                .catch(function (error) {
                    console.log(error);
                    self.isLoading = false;
                });
            this.isLoading = false;
        },
    },

    mounted() {
        this.payments = JSON.parse(this.paymentsdata);

        let length = this.payments.length;

        for (let i = 0; i < length; i++) {
            let carts = this.payments[i].cart;
            let len = carts.length;

            for (let j = 0; j < len; j++) {
                let price = JSON.parse(carts[j].product.price);

                this.payments[i].cart[j].product.price = this.findPrice(
                    carts[j].color,
                    carts[j].size,
                    price,
                    carts[j].product.category_id
                );
            }
        }
        this.options = [
            "For Review",
            "For Payment",
            "In Process",
            "For Pickup",
            "Completed",
            "Cancelled",
        ];

        this.opts = ["In Process", "Completed", "Cancelled"];
        (this.counts = {
            "For Review": -1,
            "For Payment": 0,
            "In Process": 1,
            "For Pickup": 2,
            Completed: 3,
            Cancelled: 3,
        }),
            // let data = JSON.parse(this.paymentsdata)

            // console.log(this.payments)

            // data.forEach(this.populatePayments)

            (this.oldPayments = this.payments);
    },
};
</script>
