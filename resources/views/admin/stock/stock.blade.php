@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Stock To Sale</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Stock Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Code</th>
                        <th>Product Model</th>
                        <th>Unit Price</th>
                        <th>Purchase Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->product_code}}</td>
                            <td>{{$data->model_no}}</td>
                            <td>{{$data->unit_price}}</td>
                            <td>{{$data->purchase_quantity_to_after_sell}}</td>
                            <td>
                                <a href="{{route('product.sell',$data->id)}}" target="_blank" class="btn btn-sm btn-primary">Sale</a>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Add Stock</button>
                            </td>
                        </tr>


                        <!-- Edit Modal for Add Product Stock -->
                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Update on Stock</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('stock.update',$data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Product Code:</label>
                                                <input type="text" name="product_code" class="form-control" id="edit-name" value="{{$data->product_code}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Product Stock:</label>
                                                <input type="number" name="purchase_quantity_to_after_sell" class="form-control" id="edit-name" value="{{$data->name}}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection
