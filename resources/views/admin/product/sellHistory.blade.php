@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Product Sell</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Product Example
            </div>
            <div class="card-body">

                <form action="{{ route('product.sellHistory') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Address</th>
                        <th>Product Code</th>
                        <th>Product Model</th>
                        <th>Unit Price</th>
                        <th>Sell Qty</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productSell as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->customer->name}}</td>
                            <td>{{$data->customer->phone}}</td>
                            <td>{{$data->customer->address}}</td>
                            <td>{{$data->product->product_code}}</td>
                            <td>{{$data->product->model_no}}</td>
                            <td>{{$data->product->unit_price}}</td>
                            <td>{{$data->sell_qty}}</td>

                            <td>{{$data->sell_qty * $data->product->unit_price}} </td>
                            <td>
                                <a href="{{route('product.invoice',$data->id)}}" target="_blank" class="btn btn-sm btn-primary">Invoice</a>
                            </td>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
