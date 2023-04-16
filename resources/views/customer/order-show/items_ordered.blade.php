<div class="order-details-middle">
    <div class="table-responsive">
        <table class="table table-borderless order-details-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>IMAGE</th>
                    <th>PRODUCT</th>
                    <th>UNIT PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($carts as $cart)
                    @php
                        $money = 0;
                        $price = json_decode($cart->product->price);
                        $money = number_format((float) $price * (float) $cart->quantity, 2, '.', '');
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <label>IMAGE</label>
                            <img height="80" src="{{ url('storage/' . $cart->product->product_cover) }} "
                                alt="">
                        </td>

                        <td>
                            <label>PRODUCT TITLE</label>
                            <a href="{{ url('menu/' . $cart->product->id) }}" class="product-name">
                                {{ $cart->product->title }}
                            </a>
                        </td>

                        <td>
                            <label>UNIT PRICE</label>
                            {{ $money / $cart->quantity }}
                        </td>

                        <td>
                            <label>QUANTITY</label>
                            {{ $cart->quantity }}

                        </td>

                        <td>
                            <label>TOTAL</label>
                            {{ $money }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
