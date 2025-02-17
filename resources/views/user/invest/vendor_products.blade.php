<!-- Products Page -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Products</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                    <div class="card-body">
    <h4 class="card-title mb-4">Filter</h4>
    <div>
        <h5 class="font-size-14 mb-3">Filter By</h5>
        <ul class="list-unstyled product-list">
            <li><a href="javascript:void(0);" class="filter-link" data-filter-type="all"><i class="mdi mdi-chevron-right me-1"></i> <span class="tablist-name">All Products</span></a></li>
            <li><a href="javascript:void(0);" class="filter-link" data-filter-type="latest"><i class="mdi mdi-chevron-right me-1"></i> <span class="tablist-name">Latest Products</span></a></li>
            <li><a href="javascript:void(0);" class="filter-link" data-filter-type="oldest"><i class="mdi mdi-chevron-right me-1"></i> <span class="tablist-name">Oldest Products</span></a></li>
        </ul>
    </div>
</div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="mt-2">
                                <h5>Menu</h5>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6">
                            <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1" id="go-to-cart">
                                        <i class="bx bx-cart me-2"></i> GO to cart <span id="cart-count">0</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row" id="product-list">
                        @foreach($defaultProducts as $product)
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-img position-relative">
                                        <div class="avatar-sm product-ribbon"></div>
                                        <img src="{{ asset($product->image) }}" alt="" class="img-fluid mx-auto d-block" style="width:160px;height:160px;">
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h5 class="mb-3 text-truncate"><a href="javascript:void(0);" class="text-dark">{{ $product->productName }}</a></h5>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1" data-product-id="{{ $product->id }}">
                                                <i class="bx bx-cart me-2"></i> Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    var cartItems = []; // Array to store product IDs


    $('#go-to-cart').click(function() {
        // Create a form and submit it to the user.agentActivation route
        var form = $('<form>', {
            action: '{{ route("user.ecommerce_cart") }}',
            method: 'POST'
        });

        // Append CSRF token
        form.append($('<input>', {
            type: 'hidden',
            name: '_token',
            value: '{{ csrf_token() }}'
        }));

        // Append product IDs
        cartItems.forEach(function(productId) {
            form.append($('<input>', {
                type: 'hidden',
                name: 'products[]',
                value: productId
            }));
        });

        // Append the form to the body and submit it
        $('body').append(form);
        form.submit();
    });

    // Function to fetch products based on filter type
    function fetchProducts(filterType) {
        $.ajax({
            url: '{{ route("product.fatch") }}', // Update with your route
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                filter: filterType
            },
            success: function(response) {
                $('#product-list').empty(); // Clear previous products
                $.each(response.products, function(index, product) {
                    // Append each product with its image and data-product-id attribute
                    var productHtml = `
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-img position-relative">
                                        <div class="avatar-sm product-ribbon"></div>
                                        <img src="${product.image}" alt="" class="img-fluid mx-auto d-block" style="width:160px;height:160px;">
                                    </div>
                                    <div class="mt-4 text-center">
                                        <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">${product.productName}</a></h5>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1" data-product-id="${product.id}">
                                                <i class="bx bx-cart me-2"></i> Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    $('#product-list').append(productHtml);
                });
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    }

    // Event listener for filter links
    $('.filter-link').click(function(e) {
        e.preventDefault();
        var filterType = $(this).data('filter-type');
        fetchProducts(filterType);
    });

    // Delegate the click event for dynamically added "Add to cart" buttons
    $('#product-list').on('click', '.btn-primary', function() {
        var productId = $(this).data('product-id');
        var button = $(this);

        if (cartItems.indexOf(productId) === -1) {
            addToCart(productId, button);
        } else {
            removeFromCart(productId, button);
        }
    });

    // Function to add product to cart
    function addToCart(productId, button) {
        if (cartItems.indexOf(productId) === -1) {
            cartItems.push(productId); // Add product ID to the array if not already present
            var cartCountElement = $('#cart-count');
            var currentCount = parseInt(cartCountElement.text());
            cartCountElement.text(currentCount + 1);
            button.text('Remove'); // Change button text to "Remove"
        }
    }

    // Function to remove product from cart
    function removeFromCart(productId, button) {
        var index = cartItems.indexOf(productId);
        if (index !== -1) {
            cartItems.splice(index, 1); // Remove product ID from the array
            var cartCountElement = $('#cart-count');
            var currentCount = parseInt(cartCountElement.text());
            cartCountElement.text(currentCount - 1);
            button.text('Add to cart'); // Change button text back to "Add to cart"
        }
    }

    // Fetch all products by default when the page loads
    fetchProducts('all');
});

</script>

<style>
    .cart-item-image {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>