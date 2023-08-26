@extends('admin.app')
@section('admin_content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Expense Record</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>

            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Expense</button>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Expense Record Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category Name</th>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expense as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->category->name}}</td>
                            <td>{{$data->details}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->date}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">Edit</button>
                                <a href="#" class="btn btn-danger btn-sm delete-expense" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" data-expense-id="{{$data->id}}">Delete</a>
                            </td>
                        </tr>



                        <!-- Edit Modal for  Expense -->
                        <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$data->id}}">Edit Expense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('expense.record.update', $data->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="edit-status" class="col-form-label">Product Category:</label>
                                                <select class="form-control" name="category_id" id="edit-status">
                                                    <option selected value="{{$data->category_id}}">{{$data->category->name}}</option>
                                                    @foreach($category as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Details:</label>
                                                <input type="text" name="details" class="form-control" id="recipient-name" value="{{$data->details}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Amount:</label>
                                                <input type="text" name="amount" class="form-control" id="recipient-name" value="{{$data->amount}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">date:</label>
                                                <input type="date" name="date" class="form-control" id="recipient-name" value="{{$data->date}}">
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


                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$data->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$data->id}}">Delete Expense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this expense?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('expense.delete',$data->id)}}" class="btn btn-danger">Delete</a>
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

    <!-- Add Modal for Current Expense -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('expense.record.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="edit-status" class="col-form-label">Product Category:</label>
                            <select class="form-control" name="category_id" id="edit-status">
                                <option>Select Category</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Details:</label>
                            <input type="text" name="details" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Amount:</label>
                            <input type="text" name="amount" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">date:</label>
                            <input type="date" name="date" class="form-control" id="recipient-name" required>
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
