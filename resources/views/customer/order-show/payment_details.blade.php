<div class="col-lg-6 col-sm-18">
    <div class="order-information">
        <h4>Payment Details</h4>

        <ul class="list-inline order-information-list">
            <li>
                <label>Transaction No.:</label>
                <span>{{ $order->trackingnumberP }}</span>
            </li>

            <li>
                <label>Payment Date:</label>
                <span>{{ date('Y-m-d', strtotime($order->created_at)) }}</span>
            </li>
            {{-- <li>
                <label>Payment Method:</label>
                <span></span>
            </li> --}}
            <li>
                <label>Payment Status:</label>
                <span>Paid</span>
            </li>
        </ul>
    </div>
</div>
