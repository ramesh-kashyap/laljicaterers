<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cart</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.vendorBilling') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="table-responsive" id="cart">
                                    <table class="table align-middle mb-0 table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Product Desc</th>
                                                <th>Price</th>
                                                <th>Discount Price</th>
                                                <th>Coupon</th>
                                                <th>Quantity</th>
                                                <th colspan="2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Cart items will be populated dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="{{ route('user.buy_products') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-sm-end mt-2 mt-sm-0">
                                            <button type="submit" class="btn btn-success">
                                                <i class="mdi mdi-cart-arrow-right me-1"></i> Confirm
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>

                                <input type="hidden" name="cartTotal" class="cartTotal">
<input type="hidden" name="grandTotal" class="grandTotal">
<input type="hidden" name="DiscountTotal" class="DiscountTotal">
<input type="hidden" name="CouponTotal" class="CouponTotal">

                               
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Order Summary</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_mode" class="form-label">Payment Mode</label>
                        <select class="form-control" id="payment_mode" name="payment_mode" required>
                            <option value="" disabled selected>Select Payment Mode</option>
                            <option value="cash">Cash</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td>Grand Total :</td>
                            <td><span id="grandTotal">₹0.00</span></td>
                        </tr>
                        <tr>
                            <td>Discount :</td>
                            <td>- <span id="DiscountTotal">₹0.00</span></td>
                        </tr>
                        <tr>
                            <td>Coupon :</td>
                            <td>- <span id="CouponTotal">₹0.00</span></td>
                        </tr>
                        <tr>
                            <th>Total :</th>
                            <th><span id="cartTotal">₹0.00</span></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Cart array to store items
            var cart = [];

            // Function to add item to cart
            function addToCart(product, productDescription, price, discountPrice, coupon, productId, balanceQuan) {
                var item = {
                    product: product,
                    productDescription: productDescription,
                    price: price,
                    discountPrice: discountPrice,
                    coupon: coupon,
                    productId: productId,
                    maxQuantity: balanceQuan,
                    quantity: 1
                };

                // Check if item already exists in cart
                var existingItem = cart.find(function (element) {
                    return element.productId === productId;
                });

                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push(item);
                }

                updateCart();
            }

            // Function to remove item from cart
            function removeFromCart(productId) {
                cart = cart.filter(function (element) {
                    return element.productId !== productId;
                });

                updateCart();
            }

            // Function to update item quantity in cart
            function updateQuantity(productId, quantity) {
                var item = cart.find(function (element) {
                    return element.productId === productId;
                });

                if (item) {
                    item.quantity = quantity;
                }

                updateCart();
            }

            // Function to update the cart display
            function updateCart() {
                var cartTable = $('#cart tbody');
                cartTable.empty();

                var total = 0;
                var grandTotal = 0;
                var discountTotal = 0;
                var couponTotal = 0;

                cart.forEach(function (item) {
                    var totalPrice = (item.discountPrice * item.quantity) - item.coupon;
                    var grandPrice = item.price * item.quantity;
                    var discount = grandPrice - totalPrice;

                    total += totalPrice;
                    grandTotal += grandPrice;
                    discountTotal += discount;
                    couponTotal += item.coupon;

                    var row = $('<tr>');
                    row.append('<td><input type="hidden" name="products[]" value="' + item.productId + '">' + item.product + '</td>');
                    row.append('<td>' + item.productDescription + '</td>');
                    row.append('<td>&#8377; ' + item.price.toFixed(2) + '</td>');
                    row.append('<td>&#8377; ' + item.discountPrice.toFixed(2) + '</td>');
                    row.append('<td>&#8377; ' + item.coupon.toFixed(2) + '</td>');
                    row.append('<td><div class="me-3" style="width: 120px;"><input type="number" max="' + item.maxQuantity + '" min="1" value="' + item.quantity + '" data-product="' + item.productId + '" class="form-control" name="quantity[]"></div></td>');
                    row.append('<td>&#8377;' + totalPrice.toFixed(2) + '</td>');
                    row.append('<td><a href="javascript:void(0);" class="action-icon text-danger remove" data-product="' + item.productId + '"><i class="mdi mdi-trash-can font-size-18"></i></a></td>');

                    cartTable.append(row);
                });

                $('#cartTotal').text('₹' + total.toFixed(2));
                $('#grandTotal').text('₹' + grandTotal.toFixed(2));
                $('#DiscountTotal').text('₹' + discountTotal.toFixed(2));
                $('#CouponTotal').text('₹' + couponTotal.toFixed(2));

                $('.cartTotal').val(total.toFixed(2));
                $('.grandTotal').val(grandTotal.toFixed(2));
                $('.DiscountTotal').val(discountTotal.toFixed(2));
                $('.CouponTotal').val(couponTotal.toFixed(2));
            }

            // Event handler for changing quantity
            $('#cart').on('change', 'input[type="number"]', function () {
                var productId = $(this).data('product');
                var quantity = parseInt($(this).val());

                updateQuantity(productId, quantity);
            });

            // Event handler for removing item
            $('#cart').on('click', '.remove', function () {
                var productId = $(this).data('product');

                removeFromCart(productId);
            });

            // Initializing cart with products from server-side
            @foreach($products as $product)
                @php
                    $maxQuantity = \DB::table('vendor_products')->where('user_id', Auth::user()->id)->where('product_id', $product->id)->where('activeStatus', 1)->sum('quantity');
                    $usedQuantity = \DB::table('user_products')->where('user_id', Auth::user()->id)->where('product_id', $product->id)->sum('quantity');
                    $balanceQuantity = $maxQuantity - $usedQuantity;
                @endphp
                addToCart('{{ $product->productName }}', '{{ $product->ProductDescription }}', {{ $product->productPrice }}, {{ $product->productDiscountPrice }}, {{ $product->ProductCoupon }}, {{ $product->id }}, {{ $balanceQuantity }});
            @endforeach
        });
    </script>
</div>
