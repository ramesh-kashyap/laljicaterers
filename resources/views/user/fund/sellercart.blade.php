<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">
                            
                        </h4>

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
                            <form action="{{ route('user.sellerBilling') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="table-responsive" id="cart">
                                    <table class="table align-middle mb-0 table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Product Desc</th>
                                                <th>Quantity</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="products[]" value="{{ $product->id }}">
                                                        {{ $product->productName }}
                                                    </td>
                                                    <td>{{ $product->ProductDiscription }}</td>
                                                    <td>
                                                        <div class="me-3" style="width: 120px;">
                                                            <input type="number" min="1" value="1" data-product="{{ $product->productName }}" class="form-control" name="quantity[]">
                                                        </div>
                                                    </td>
                                                    <td></td> <!-- Removed price display -->
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon text-danger remove" data-product="{{ $product->productName }}">
                                                            <i class="mdi mdi-trash-can font-size-18"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="{{ route('user.categories_menu') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping
                                        </a>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Order Summary</h4>
                
                <input type="hidden" name="user_id" value="{{ @$user_id }}">
                <input type="hidden" name="payment_mode" value="{{ $payment_mode }}">

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label"><strong>Phone:</strong></label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dinner" class="form-label"><strong>City:</strong></label>
                            <input type="text" name="city" id="dinner" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_date" class="form-label"><strong>Event Date:</strong></label>
                            <input type="date" name="event_date" id="event_date" class="form-control" value="" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="breakfast" class="form-label"><strong>Additional Inquiry:</strong></label>
                            <input type="text" name="additional_enquiry" id="breakfast" class="form-control" value="" >
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="total_people" class="form-label"><strong>Total No. Of People:</strong></label>
                            <input type="text" name="total_people" id="total_people" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label"><strong>People Taking Breakfast:</strong></label>
                            <input type="text" name="no_breakfast" id="event" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label"><strong>People Taking Lunch:</strong></label>
                            <input type="text" name="no_lunch" id="city" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label"><strong>People Taking Dinner :</strong></label>
                            <input type="text" name="no_dinner" id="city" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="event" class="form-label"><strong>Event:</strong></label>
                            <select name="event" id="event" class="form-control" required>
                                <option value="birthday">Birthday</option>
                                <option value="marriage">Marriage</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment_mode" class="form-label"><strong>Payment Mode:</strong></label>
                            <select name="payment_mode" id="payment_mode" class="form-control" required>
                                <option value="cash" {{ $payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="online" {{ $payment_mode == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="totalQuantity" class="form-label"><strong>Total Quantity:</strong></label>
                            <span id="totalQuantity">0</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="grandTotal" class="grandTotal">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-cart-arrow-right me-1"></i> Confirm
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
        </div>
    </div>
</div>

                
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Cart array to store items
        var cart = [];

        // Add item to cart
        function addToCart(product, productDiscription, product_id, balanceQuan) {
            var item = {
                product: product,
                productDiscription: productDiscription,
                product_id: product_id,
                maxQuantity: balanceQuan,
                quantity: 1
            };

            // Check if item already exists in cart
            var existingItem = cart.find(function(element) {
                return element.product === product;
            });

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push(item);
            }

            updateCart();
        }

        // Remove item from cart
        function removeFromCart(product) {
            cart = cart.filter(function(element) {
                return element.product !== product;
            });

            updateCart();
        }

        // Update item quantity
        function updateQuantity(product, quantity) {
            console.log('Updating quantity for:', product, 'to:', quantity);
            var item = cart.find(function(element) {
                return element.product === product;
            });

            if (item) {
                item.quantity = quantity;
            }

            updateCart();
        }

        // Update the cart display
        function updateCart() {
            var cartTable = $('#cart tbody');
            cartTable.empty();

            var totalQuantity = 0;

            cart.forEach(function(item) {
                var row = $('<tr>');
                row.append('<td><input type="hidden" name="products[]" value="' + item.product_id + '"> ' + item.product + '</td>');
                row.append('<td>' + item.productDiscription + '</td>');
                row.append('<td><div class="me-3" style="width: 120px;"><input type="number" min="1" value="' + item.quantity + '" data-product="' + item.product + '" class="form-control" name="quantity[]"></div></td>');
                row.append('<td></td>'); // Empty cell for Total (since price info is removed)
                row.append('<td><a href="javascript:void(0);" class="action-icon text-danger remove" data-product="' + item.product + '"> <i class="mdi mdi-trash-can font-size-18"></i></a> </td>');

                cartTable.append(row);

                totalQuantity += item.quantity;
            });

            $('#totalQuantity').text(totalQuantity);
        }

        // Event handlers
        $('#cart').on('change', 'input[type="number"]', function() {
            var product = $(this).data('product');
            var quantity = parseInt($(this).val());
            console.log('Quantity change detected for product:', product, 'New quantity:', quantity);

            if (quantity > 0) {
                updateQuantity(product, quantity);
            } else {
                $(this).val(1);
                updateQuantity(product, 1);
            }
        });

        $('#cart').on('click', '.remove', function() {
            var product = $(this).data('product');
            console.log('Removing product:', product);

            removeFromCart(product);
        });

        @foreach($products as $product)
        @php
            $maxQuanity = \DB::table('seller_products')->where('user_id', Auth::user()->id)->where('product_id', $product->id)->sum('quantity');
            $useQuantity = \DB::table('user_products')->where('user_id', Auth::user()->id)->where('product_id', $product->id)->sum('quantity');
            $balanceQuan = $maxQuanity - $useQuantity;
        @endphp
        addToCart('{{ $product->productName }}', '{{ $product->ProductDiscription }}', {{ $product->id }}, {{ $balanceQuan }});  
        @endforeach
    });
</script>
