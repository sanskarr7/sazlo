<x-header />

<!-- Contact Section Begin -->
<section class="contact spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-6 mx-auto">
        <div class="section-title">
          <h2>My Order History</h2>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Total Bill.</th>
              <th>Fullname.</th>
              <th>Address.</th>
              <th>Phone.</th>
              <th>Status.</th>
              <th>Order Date.</th>
              <th>View Products.</th>
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
              <td>{{$i}}</td>
              <td>RS. {{$item->bill}}</td>
              <td>{{$item->fullname}}</td>
              <td>{{$item->address}}</td>
              <td>{{$item->phone}}</td>
              <td>{{$item->status}}</td>
              <td>{{$item->created_at}}</td>
              <td>
                @if ($item->status == 'Accepted')
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">
                  Products
                </button>

                <!-- The Modal -->
                <div class="modal" id="myModal{{$item->id}}">
                  <div class="modal-dialog custom-modal-width"> <!-- Custom class for width -->
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">All Products</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <table class="table table-responsive">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>PDF</th>
                              <th>Video</th>
                              <th>Price</th>
                              <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($items as $product)
                            @if($product->orderId == $item->id)
                            <tr>
                              <td>{{ $product->title }}</td>
                              <td style="width: 40px;"><img src="{{ URL::asset('uploads/profile/products/'.$product->picture) }}"></td>
                              <td>{{ $product->quantity }}</td>
                              <td class="font-weight-bold">
                                <a href="{{ URL::asset('uploads/pdf/'.$product->pdf) }}" target="_blank">View PDF</a>
                                <a href="{{ URL::asset('uploads/pdf/'.$product->pdf) }}" download class="btn btn-primary btn-xs ml-2">Download PDF</a>
                              </td>
                              <td class="font-weight-bold">
                                <a href="{{ URL::asset('uploads/videos/'.$product->video) }}" target="_blank">View Video</a>
                                <a href="{{ URL::asset('uploads/videos/'.$product->video) }}" download class="btn btn-primary btn-xs ml-1">Download Video</a>
                              </td>
                              <td>RS. {{ $product->price }}</td>
                              <td>RS. {{ $product->price * $product->quantity }}</td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                  Products not available until order is accepted. Checking Payment Status
                </div>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->

<x-footer />