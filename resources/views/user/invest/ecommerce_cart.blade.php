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
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{route('user.fundActivation')}}" method="POST">

                                {{ csrf_field() }}

                            <div class="table-responsive"  id="cart">
                                <table class="table align-middle mb-0 table-nowrap">
                                    <thead class="table-light" #cart >
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

                                     
                                




                                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{route('user.vendor_cards')}}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                               
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                  
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Order Summary</h4>
                                <input type="hidden" name="user_id" value="{{@$user_id}}"> 
                              <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Grand Total :</td>
                                            <td> <span id="grandTotal">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Discount : </td>
                                            <td>- <span id="DiscountTotal">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Coupon : </td>
                                            <td>- <span id="CouponTotal">0</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total :</th>
                                            <th><span id="cartTotal"></span></th>
                                        </tr>
                                    </tbody>



                                
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-4">
                                <input type="hidden" name="cartTotal" class="cartTotal">
                                <input type="hidden" name="grandTotal" class="grandTotal">
                                <input type="hidden" name="DiscountTotal" class="DiscountTotal">
                                <input type="hidden" name="CouponTotal" class="CouponTotal">
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-sm-end mt-2 mt-sm-0">
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-cart-arrow-right me-1"></i> Confirm </button>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-4">
                                </div>

                            </div> <!-- end row-->
                        </form>
                            <!-- end table-responsive -->
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
        function addToCart(product,productDiscription,price,DiscountPrice,coupen,product_id,balanceQuan) {
          var item = {
            product: product,
            productDiscription: productDiscription,
            price: price,
            DiscountPrice: DiscountPrice,
            coupen: coupen,
            product_id:product_id,
            maxQuantity:balanceQuan,
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
      
          var total = 0;
          var grandTotal = 0;
          var DiscountTotal = 0;
          var coupen = 0;
      
          cart.forEach(function(item) {
            var totalPrice = (item.DiscountPrice * item.quantity)-item.coupen;
            var grandPrice = item.price * item.quantity;
            var coupen2 = item.coupen;
            var discount = grandPrice-totalPrice;
            total += totalPrice;
            grandTotal +=grandPrice;
            DiscountTotal += discount;
            coupen += coupen2;
      
            var row = $('<tr>');
            row.append('<td><input type="hidden" name="products[]" value="' + item.product_id + '"> ' + item.product + '</td>');
            row.append('<td>' + item.productDiscription + '</td>');
            row.append('<td>&#8377; ' + item.price + '</td>');
            row.append('<td>&#8377; ' + item.DiscountPrice + '</td>');
            row.append('<td>&#8377; ' + item.coupen + '</td>');
          
            row.append('<td><div class="me-3" style="width: 120px;"><input type="number" max="' +item.maxQuantity + '" min="1" value="' + item.quantity + '" data-product="' + item.product + '" class="form-control" name="quantity[]"></div></td>');
            row.append('<td>&#8377;' + totalPrice.toFixed(2) + '</td>');
            row.append('<td><a href="javascript:void(0);" class="action-icon text-danger remove" data-product="' + item.product + '"> <i class="mdi mdi-trash-can font-size-18"></i></a> </td>');
      
            cartTable.append(row);
          });
          $('#cartTotal').text('₹' + total.toFixed(2));
          $('#grandTotal').text('₹' + grandTotal.toFixed(2));
          $('#DiscountTotal').text('₹' + DiscountTotal.toFixed(2));
          $('#CouponTotal').text('₹' + coupen.toFixed(2));
          $('.cartTotal').val(total.toFixed(2));
          $('.grandTotal').val(+ grandTotal.toFixed(2));
          $('.DiscountTotal').val(DiscountTotal.toFixed(2));
          $('.CouponTotal').val(coupen.toFixed(2));

        }
      
        // Event handlers
        $('#cart').on('change', 'input[type="number"]', function() {
          var product = $(this).data('product');
          var quantity = parseInt($(this).val());
      
          updateQuantity(product, quantity);
        });
      
        $('#cart').on('click', '.remove', function() {
          var product = $(this).data('product');
      
          removeFromCart(product);
        });
            @foreach($product as $product )
            @php
             $maxQuanity = \DB::table('seller_products')->where('user_id',Auth::user()->id)->where('product_id',$product->id)->sum('quantity');
             $useQuantity = \DB::table('user_products')->where('user_id',Auth::user()->id)->where('product_id',$product->id)->sum('quantity');
             $balanceQuan= $maxQuanity-$useQuantity;
            @endphp
            addToCart('{{ $product->productName }}','{{ $product->ProductDiscription }}',{{ $product->productPrice }},{{ $product->productDiscountPrice }},{{ $product->ProductCoupon }},{{ $product->id }},{{$balanceQuan}});  
            @endforeach


      });
      
      </script>

