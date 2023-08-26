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
    </style>
    <div class="sale_product_wrapper">
        <h2>Your Cart</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Product Code</th>
                <th>Image</th>
                <th>Type</th>
                <th>Size</th>
                <th>Model No</th>
                <th>Unit Price</th>
                <th>Sale Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $key=>$cartItem)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $cartItem['product']->product_code }}</td>
                    <td>
                        <img src="{{ asset($cartItem['product']->product_image) }}" alt="" width="50">
                    </td>
                    <td>{{ $cartItem['product']->type }}</td>
                    <td>{{ $cartItem['product']->size }}</td>
                    <td>{{ $cartItem['product']->model_no }}</td>
                    <td>{{ $cartItem['product']->unit_price }}</td>
                    <td>{{ $cartItem['sell_qty'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        <div class="w-full text-end">--}}
{{--            <a class="btn btn-primary" href="{{ route('cart.checkout') }}">Proceed to Checkout for Sale</a>--}}
{{--        </div>--}}
    </div>
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
        .checkout_form_wrapper {
            width: 100%;
            max-width: 400px;
        }
    </style>
    <div class="sale_product_wrapper">
        <h2>Checkout</h2>
        <div class="checkout_form_wrapper">
            <form action="{{ route('cart.processCheckout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="name" class="form-control" id="firstname" placeholder="Enter Name">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname">Phone</label>
                    <input type="text" name="phone" class="form-control" id="firstname" placeholder="Phone Number">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="adress">Address</label>
                    <input type="text" class="form-control" name="address" id="adress" placeholder="1234 Main Street" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <button class="btn btn-primary bt-lg btn-block" type="submit">Continue to Checkout</button>
            </form>
        </div>
    </div>


@endsection
