<div class="order-details-bottom">
    <ul class="list-inline order-summary-list">
        <li>
            <label>Subtotal</label>

            <span class="price-amount">
                ₱{{ $order->amount_paid - 100 }}
            </span>
        </li>
        <li>
            <label>Shipping Fee</label>

            <span class="price-amount">
                ₱100
            </span>
        </li>
    </ul>


    <div class="order-summary-total">
        <label>Order Total</label>

        <span class="total-price fw-bold">
            ₱{{ $order->amount_paid }}
        </span>
    </div>
</div>
