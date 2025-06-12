<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <x-adminheader />
    <div class="container mt-5">
        <h2>Add Category</h2>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ URL::to('adminCategoriesStore') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control w-50" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

        <div class="table-responsive mt-5">
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal{{ $category->id }}">
                                Update
                            </button>

                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Category</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="{{ $category->name }}"
                                                       placeholder="Enter New Category Name" class="form-control mb-2" required>
                                                <input type="submit" class="btn btn-success" value="Save Changes">
                                            </form>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-adminfooter />
</body>
</html>
