<x-adminheader />
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Top Products</p>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModel">
                            Add New
                        </button>
                        <!-- The Modal -->
                        <div class="modal" id="addNewModel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Products</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{URL::to('AddNewProduct')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="">Title</label>
                                            <input type="text" name="title" placeholder="Enter Title" class="form-control mb-2" id="">

                                            <label for="">Picture 1</label>
                                            <input type="file" name="file" class="form-control mb-2" id="">

                                            <label for="">Picture 2</label>
                                            <input type="file" name="file2" class="form-control mb-2" id="">

                                            <label for="video2">Demo Video</label>
                                            <input type="file" name="video2" class="form-control mb-2" id="">

                                            <label for="">Description</label>
                                            <textarea name="description" placeholder="Enter Description" class="form-control mb-2" rows="3"></textarea>

                                            <label for="">Ex-Description</label>
                                            <textarea name="ex_description" placeholder="Enter Ex-Description" class="form-control mb-2" rows="3"></textarea>

                                            <label for="">Price</label>
                                            <input type="text" name="price" placeholder="Enter Price" class="form-control mb-2" id="">

                                            <label for="">Quantity</label>
                                            <input type="number" name="quantity" placeholder="Enter Quantity" class="form-control mb-2" id="">

                                            <label for="">Category</label>
                                            <select name="category" class="form-control mb-2" id="">
                                                @foreach($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="">Type</label>
                                            <select name="type" class="form-control mb-2" id="">
                                                <option value="">Select Type</option>
                                                <option value="Best Sellers">Best Sellers</option>
                                                <option value="new-arrivals">New Arrivals</option>
                                                <option value="sale">Sale</option>
                                            </select>

                                            <label for="pdf">PDF</label>
                                            <input type="file" name="pdf" class="form-control mb-2" id="">

                                            <label for="video">Product Video</label>
                                            <input type="file" name="video" class="form-control mb-2" id="">

                                            <input type="submit" name="save" class="btn btn-success" value="Save Now" id="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Picture 1</th>
                                        <th>Picture 2</th>
                                        <th>Demo Video</th>
                                        <th>Description</th>
                                        <th>Ex-Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>PDF</th>
                                        <th>Product Video</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach ($products as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td><img src="{{ URL::asset('uploads/profile/products/'.$item->picture) }}" width="100px"></td>
                                        <td><img src="{{ URL::asset('uploads/profile/products/'.$item->picture2) }}" width="100px"></td>
                                        <td class="font-weight-bold">
                                            @if ($item->video)
                                            <a href="{{ URL::asset('uploads/videos/'.$item->video2) }}" target="_blank">View Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="font-weight-bold" style="white-space: normal; word-wrap: break-word;">{{ Str::words($item->description,15,'......') }}</td>
                                        <td class="font-weight-bold" style="white-space: normal; word-wrap: break-word;">{{ Str::words($item->ex_description, 15, '...') }}</td>
                                        <td class="font-weight-bold">Rs {{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">{{ $item->category }}</div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-info">{{ $item->type }}</div>
                                        </td>
                                        <td class="font-weight-bold">
                                            @if ($item->pdf)
                                            <a href="{{ URL::asset('uploads/pdf/'.$item->pdf) }}" target="_blank">View PDF</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="font-weight-bold">
                                            @if ($item->video)
                                            <a href="{{ URL::asset('uploads/videos/'.$item->video) }}" target="_blank">View Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="font-weight-medium">
                                            <!-- Button to Open the Modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModel{{$i}}">
                                                Update
                                            </button>
                                            <!-- The Modal -->
                                            <div class="modal" id="updateModel{{$i}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Products</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="{{URL::to('UpdateProduct')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <label for="">Title</label>
                                                                <input type="text" name="title" value="{{ $item->title }}" placeholder="Enter Title" class="form-control mb-2" id="">

                                                                <label for="">Picture 1</label>
                                                                <input type="file" name="file" class="form-control mb-2" id="" width="50px">

                                                                <label for="">Picture 2</label>
                                                                <input type="file" name="file2" class="form-control mb-2" id="">

                                                                <label for="video2">Demo Video</label>
                                                                <input type="file" name="video2" class="form-control mb-2" id="">

                                                                <label for="">Description</label>
                                                                <input type="text" name="description" value="{{ $item->description }}" placeholder="Enter Description" class="form-control mb-2" id="">

                                                                <label for="">Ex-Description</label>
                                                                <input type="text" name="ex_description" value="{{ $item->ex_description }}" placeholder="Enter Ex-Description" class="form-control mb-2" id="">

                                                                <label for="">Price</label>
                                                                <input type="text" name="price" value="{{ $item->price }}" placeholder="Enter Price" class="form-control mb-2" id="">

                                                                <label for="">Quantity</label>
                                                                <input type="number" name="quantity" value="{{ $item->quantity }}" placeholder="Enter Quantity" class="form-control mb-2" id="">

                                                                <label for="">Category</label>
                                                                <select name="category" class="form-control mb-2" id="">
                                                                    @foreach($categories as $category)
                                                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="">Type</label>
                                                                <select name="type" class="form-control mb-2" id="">
                                                                    <option value="{{ $item->type }}">{{ $item->type }}</option>
                                                                    <option value="Best Sellers">Best Sellers</option>
                                                                    <option value="new-arrivals">New Arrivals</option>
                                                                    <option value="sale">Sale</option>
                                                                </select>

                                                                <label for="pdf">PDF</label>
                                                                <input type="file" name="pdf" class="form-control mb-2" id="">

                                                                <label for="video">Video</label>
                                                                <input type="file" name="video" class="form-control mb-2" id="">

                                                                <input type="hidden" value="{{ $item->id }}" name="id" id="">
                                                                <input type="submit" name="update" class="btn btn-success" value="Update Now" id="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <a href="{{URL::to('deleteProduct/'.$item->id)}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminfooter />