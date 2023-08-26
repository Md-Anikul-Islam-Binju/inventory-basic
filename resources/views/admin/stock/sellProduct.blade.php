@extends('admin.app')
@section('admin_content')
    <style>
        .sale_product_wrapper {
            padding: 50px;
        }
        .sale_product_wrapper h2 {
            font-size: 30px;
            font-weight: 700;
            line-height: 40px;
            margin-bottom: 30px;
        }
        .add_to_cart_design {
            width: 300px;
            background-color: #fff;
            box-shadow: 0px 0px 15px #dddddd;
            padding: 10px;
        }
        .add_to_cart_design label {
            font-size: 16px;
            font-weight: 500;
            line-height: 24px;
            margin-bottom: 10px;
        }

        .add_to_cart_design input {
            border: 1px solid #e3e3e3;
            border-radius: 0px;
            padding: 5px 20px;
            font-size: 18px;
        }

        .add_to_cart_design input:focus {
            outline: none;
        }
    </style>

    <div class="sale_product_wrapper">
        <h2>Sale Product</h2>
        <div class="add_to_cart_design">
            <img class="img-fluid mb-3" src="{{asset($product->product_image)}}" alt="" />
            <ul>
                <li>Product Code: {{$product->product_code}}</li>
                <li>Product Type: {{$product->type}}</li>
                <li>Product Size: {{$product->size}}</li>
                <li>Product Model: {{$product->model_no}}</li>
                <li>Product Price: {{$product->unit_price? $product->unit_price : 'N/A'}}</li>
            </ul>
            <p class="text-center"><strong>Available Stock: {{ $product->purchase_quantity_to_after_sell }}</strong></p>
            <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST" class="d-flex flex-column">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label>Select Quantity:</label>
                <input id="sell_qty" type="number" name="sell_qty" value="1" min="1" max="{{ $product->purchase_quantity_to_after_sell }}">
                <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
            </form>
        </div>
    </div>

    <script>
        const maxQuantity = {{ $product->purchase_quantity_to_after_sell }};
        const sellQtyInput = document.getElementById('sell_qty');

        sellQtyInput.addEventListener('input', () => {
            const selectedQuantity = parseInt(sellQtyInput.value);
            if (selectedQuantity > maxQuantity) {
                sellQtyInput.setCustomValidity(`Quantity must be less than or equal to ${maxQuantity}`);
            } else {
                sellQtyInput.setCustomValidity('');
            }
        });

        sellQtyInput.addEventListener('change', () => {
            sellQtyInput.reportValidity();
        });
    </script>

@endsection
