<div class="col-lg-6 col-sm-18">
    <div class="order-information">
        <h4>Order Information</h4>

        <ul class="list-inline order-information-list">
            <li>
                <label>Order No.:</label>
                <span>{{ $order->trackingnumber }}</span>
            </li>

            <li>
                <label>Order Date:</label>
                <span>{{ date('Y-m-d', strtotime($order->created_at)) }}</span>
            </li>

            <li>
                <label>Order Status:</label>
                <span style="color:#CD2E3A">{{ $order->status }}</span>
            </li>

        </ul>
    </div>
</div>
