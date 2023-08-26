@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Product</button>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Product Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Image</th>
                        <th>Product Code</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Model</th>
                        <th>Manufacturer Name</th>
                        <th>Purchase Quantity</th>
                        <th>Purchase Form</th>
                        <th>Unit Price</th>
                        <th>Purchase Recent Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if($data->product_image)
                                    <img src="{{asset($data->product_image)}}" alt="" width="50px" height="50px">
                                @else
                                    No Image
                                @endif


                            </td>
                            <td>{{$data->product_code}}</td>
                            <td>{{$data->category->name}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->size}}</td>
                            <td>{{$data->model_no}}</td>
                            <td>{{$data->manufacture->manufacture_name}}</td>
                            <td>{{$data->purchase_quantity}}</td>
                            <td>{{$data->purchaseVendor->vendor_name}}</td>
                            <td>{{$data->unit_price? $data->unit_price : 'N/A'}}</td>
                            <td>{{$data->purchase_quantity_to_after_sell}}</td>
                            <td>{{$data->status==1 ? "Active":"Inactive"}}</td>
                            <td>
                                <div class="d-flex align-items-center" style="gap: 5px;">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</button>
                                    <a href="#" class="btn btn-danger btn-sm delete-product" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-product-id="{{$data->id}}">Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal for Current Category -->
                        <div class="modal fade " id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('product.update',$data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="edit-name" class="col-form-label">Product Code:</label>
                                                    <input type="text" name="product_code" class="form-control" id="edit-product_code" value="{{$data->product_code}}">
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="edit-status" class="col-form-label">Product Category:</label>
                                                    <select class="form-control" name="category_id" id="edit-status">
                                                        <option selected value="{{$data->category_id}}">{{$data->category->name}}</option>
                                                        @foreach($category as $cat)
                                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="edit-status" class="col-form-label">Product Type:</label>
                                                    <select class="form-control" name="type" id="edit-status">
                                                        <option selected value="{{$data->type}}">{{$data->type}}</option>
                                                        <option value="normal">Normal</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="high">High</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="edit-name" class="col-form-label">Product Size:</label>
                                                    <input type="text" name="size" class="form-control" id="edit-size" value="{{$data->size}}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="edit-name" class="col-form-label">Product Model No:</label>
                                                    <input type="text" name="model_no" class="form-control" id="edit-model_no" value="{{$data->model_no}}">
                                                </div>


                                                <div class="mb-3 col-6">
                                                    <label for="edit-status" class="col-form-label">Product Manufacturer:</label>
                                                    <select class="form-control" name="manufacturer_id" id="edit-status">
                                                        <option selected value="{{$data->manufacturer_id}}">{{$data->manufacture->manufacture_name}}</option>
                                                        @foreach($manufacture as $manu)
                                                            <option value="{{$manu->id}}">{{$manu->manufacture_name	}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="edit-name" class="col-form-label">Purchase quantity:</label>
                                                    <input type="text" name="purchase_quantity" class="form-control" id="edit-purchase_quantity" value="{{$data->purchase_quantity}}">
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label for="edit-status" class="col-form-label">Purchase Supplier:</label>
                                                    <select class="form-control" name="purchase_supplier_id" id="edit-status">
                                                        <option selected value="{{$data->purchase_supplier_id}}">{{$data->purchaseVendor->vendor_name}}</option>
                                                        @foreach($purchase as $pur)
                                                            <option value="{{$pur->id}}">{{ $pur->vendor_name	}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                            </div>


                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="edit-name" class="col-form-label">Unit Price:</label>
                                                    <input type="text" name="unit_price" class="form-control" id="edit-product_code" value="{{$data->unit_price}}">
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="edit-status" class="col-form-label">Product Status:</label>
                                                    <select class="form-control" name="status" id="edit-status">
                                                        <option value="1" {{$data->status == 1 ? 'selected' : ''}}>Active</option>
                                                        <option value="0" {{$data->status == 0 ? 'selected' : ''}}>Inactive</option>
                                                    </select>
                                                </div>
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


                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this product?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('product.delete',$data->id)}}" class="btn btn-danger">Delete</a>
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



    <!-- Add Modal for Current Product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Product Code:</label>
                                <input type="text" name="product_code" class="form-control" id="edit-product_code">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="edit-status" class="col-form-label">Product Category:</label>
                                <select class="form-control" name="category_id" id="edit-status">
                                    <option>Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-status" class="col-form-label">Product Type:</label>
                                <select class="form-control" name="type" id="edit-status">
                                    <option>Select Type</option>
                                    <option value="normal">Normal</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Product Size:</label>
                                <input type="text" name="size" class="form-control" id="edit-size">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Product Model No:</label>
                                <input type="text" name="model_no" class="form-control" id="edit-model_no">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="edit-status" class="col-form-label">Product Manufacturer:</label>
                                <select class="form-control" name="manufacturer_id" id="edit-status">
                                    <option>Select Manufacturer</option>
                                    @foreach($manufacture as $manu)
                                        <option value="{{$manu->id}}">{{$manu->manufacture_name	}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Purchase quantity:</label>
                                <input type="text" name="purchase_quantity" class="form-control" id="edit-purchase_quantity">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="edit-status" class="col-form-label">Purchase Supplier:</label>
                                <select class="form-control" name="purchase_supplier_id" id="edit-status">
                                    <option>Select Purchase Supplier</option>
                                    @foreach($purchase as $pur)
                                        <option value="{{$pur->id}}">{{ $pur->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Unit Price:</label>
                                <input type="text" name="unit_price" class="form-control" id="edit-product_code">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="edit-status" class="col-form-label">Product Status:</label>
                                <select class="form-control" name="status" id="edit-status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="edit-name" class="col-form-label">Product Image:</label>
                                <input type="file" name="product_image" class="form-control" id="edit-purchase_quantity">
                            </div>
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
@endsection
