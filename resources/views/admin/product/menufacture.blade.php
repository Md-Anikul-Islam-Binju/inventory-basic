@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Manufacture</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Manufacture</button>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Manufacture Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($manufacture as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->manufacture_name}}</td>
                            <td>{{$data->status==1 ? "Active":"Inactive"}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</button>
                                <a href="{{route('manufacture.delete',$data->id)}}" class="btn btn-danger btn-sm delete-category" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-category-id="{{$data->id}}">Delete</a>
                            </td>
                        </tr>


                        <!-- Edit Modal for Current manufacture -->
                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Edit Manufacture</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('manufacture.update', $data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Manufacture Name:</label>
                                                <input type="text" name="manufacture_name" class="form-control" id="edit-name" value="{{$data->manufacture_name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit-status" class="col-form-label">Manufacture Status:</label>
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
                                        <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete Manufacture</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this manufacture?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ route('manufacture.delete', $data->id) }}" class="btn btn-danger">Delete</a>
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



    <!-- Add Modal for Current manufacture -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manufacture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('manufacture.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Manufacture Name:</label>
                            <input type="text" name="manufacture_name" class="form-control" id="recipient-name" required>
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
