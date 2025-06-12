<x-adminheader />

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Product Reviews</p>

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Comments</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->product_title }}</td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>
                                            @if($review->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($review->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                            @else
                                            <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($review->status == 0)
                                            <a href="{{ url('/approve-review/' . $review->id) }}" class="btn btn-success btn-sm">Approve</a>
                                            <a href="{{ url('/reject-review/' . $review->id) }}" class="btn btn-danger btn-sm">Reject</a>
                                            @endif
                                            <a href="{{ url('/delete-review/' . $review->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
    <x-adminfooter />