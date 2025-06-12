<x-adminheader />
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Our Orders</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Bill</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Order Status</th>
                                        <th>Order Date</th>
                                        <th>Products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($orders as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->fullname }}</td>
                                        <td class="font-weight-bold">RS-{{ $item->bill }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">{{ $item->status }}</div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-info">{{ $item->created_at }}</div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <!-- Button to Open the Modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModel{{$i}}">
                                                Products
                                            </button>

                                            <div class="modal" id="updateModel{{$i}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Order Products</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <table class="table table-responsive">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Picture</th>
                                                                        <th>Price/Item</th>
                                                                        <th>Quantity</th>
                                                                        <th>SubTotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($orderIteams as $oItems)
                                                                    @if($oItems->orderId == $item->id)
                                                                    <tr>
                                                                        <td>{{ $oItems->title }}</td>
                                                                        <td>
                                                                            <img src="{{url('uploads/profile/products/'.$oItems->picture)}}" width="100px" alt="">
                                                                        </td>
                                                                        <td>Rs- {{ $oItems->price }}</td>
                                                                        <td>{{ $oItems->quantity }}</td>
                                                                        <td>Rs- {{ $oItems->quantity * $oItems->price }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->status == 'Pending')
                                            <a href="{{ URL::to('changeOrderStatus/Accepted/' . $item->id) }}" class="btn btn-success">Accept</a>
                                            <a href="{{ URL::to('changeOrderStatus/Rejected/' . $item->id) }}" class="btn btn-danger">Reject</a>
                                            @elseif ($item->status == 'Accepted')
                                            <a href="{{ URL::to('changeOrderStatus/Delivered/' . $item->id) }}" class="btn btn-success">Completed</a>
                                            @elseif ($item->status == 'Delivered')
                                            Already Completed
                                            @else
                                            <a href="{{ URL::to('changeOrderStatus/Accepted/' . $item->id) }}" class="btn btn-success">Accepted</a>
                                            @endif
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
