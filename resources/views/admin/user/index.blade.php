@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                User Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->phone}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</button>
                                <a href="#" class="btn btn-danger btn-sm delete-category" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-category-id="{{$data->id}}">Delete</a>
                            </td>
                        </tr>


                        <!-- Edit Modal for Current Category -->
                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('user.update',$data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit-name" class="col-form-label">Name:</label>
                                                <input type="text" name="name" class="form-control" id="edit-name" value="{{$data->name}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-email" class="col-form-label">Name:</label>
                                                <input type="text" name="email" class="form-control" id="edit-email" value="{{$data->email}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-phone" class="col-form-label">Phone:</label>
                                                <input type="number" name="phone" class="form-control" id="edit-phone" value="{{$data->phone}}">
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
                                        <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this user?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('user.delete',$data->id)}}" class="btn btn-danger">Delete</a>
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



    <!-- Add Modal for Current Category -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name" required>
                        </div>

                        <div class="mb-3">
                            <label for="recipient-email" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" id="recipient-email" required>
                        </div>

                        <div class="mb-3">
                            <label for="recipient-phone" class="col-form-label">Phone:</label>
                            <input type="number" name="phone" class="form-control" id="recipient-phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="recipient-password" class="col-form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="recipient-password" required>
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
