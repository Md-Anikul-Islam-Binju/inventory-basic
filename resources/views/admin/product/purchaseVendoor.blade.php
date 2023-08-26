@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Purchase Supplier</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Purchase Supplier</button>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Purchase Supplier Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->vendor_name}}</td>
                            <td>{{$data->vendor_email}}</td>
                            <td>{{$data->vendor_phone}}</td>
                            <td>{{$data->vendor_address}}</td>
                            <td>{{$data->status==1 ? "Active":"Inactive"}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</button>
                                <a href="{{route('purchase.delete',$data->id)}}" class="btn btn-danger btn-sm delete-purchase" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-purchase-id="{{$data->id}}">Delete</a>
                            </td>
                        </tr>


                        <!-- Edit Modal for Current Purchase Vendor -->
                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Edit Purchase Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('purchase.update', $data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Purchase Vendor Name:</label>
                                                <input type="text" name="vendor_name" class="form-control" id="edit-name" value="{{$data->vendor_name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Purchase Vendor Email:</label>
                                                <input type="text" name="vendor_email" class="form-control" id="edit-email" value="{{$data->vendor_email}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Purchase Vendor Phone:</label>
                                                <input type="text" name="vendor_phone" class="form-control" id="edit-phone" value="{{$data->vendor_phone}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Purchase Vendor Address:</label>
                                                <input type="text" name="vendor_address" class="form-control" id="edit-address" value="{{$data->vendor_address}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit-status" class="col-form-label">Purchase Vendor Status:</label>
                                                <select class="form-control" name="status" id="edit-status">
                                                    <option value="1" {{$data->status == 1 ? 'selected' : ''}}>Active</option>
                                                    <option value="0" {{$data->status == 0 ? 'selected' : ''}}>Inactive</option>
                                                </select>
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
                                        <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete Purchase Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this Purchase Supplier?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ route('purchase.delete', $data->id) }}" class="btn btn-danger">Delete</a>
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



    <!-- Add Modal for Current Purchase Vendor -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('purchase.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Purchase Vendor Name:</label>
                            <input type="text" name="vendor_name" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-name" class="col-form-label">Purchase Vendor Email:</label>
                            <input type="text" name="vendor_email" class="form-control" id="edit-email">
                        </div>
                        <div class="mb-3">
                            <label for="edit-name" class="col-form-label">Purchase Vendor Phone:</label>
                            <input type="text" name="vendor_phone" class="form-control" id="edit-phone">
                        </div>
                        <div class="mb-3">
                            <label for="edit-name" class="col-form-label">Purchase Vendor Address:</label>
                            <input type="text" name="vendor_address" class="form-control" id="edit-address">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
