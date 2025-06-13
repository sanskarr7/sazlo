<x-adminheader />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Our Booking</p>

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Picture</th>
                                        <th>Teacher Name</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>Booking Status</th> {{-- New header for booking status --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $key => $booking)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($booking->teacher_picture)
                                                <img src="{{ asset('uploads/teachers/' . $booking->teacher_picture) }}" alt="Teacher Picture" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('img/teachers/default.jpg') }}" alt="Default Picture" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @endif
                                        </td>
                                        <td>{{ $booking->teacher_name }}</td>
                                        <td>{{ $booking->student_name }}</td>
                                        <td>{{ $booking->student_email }}</td>
                                        <td>
                                            <span class="badge {{
                                                $booking->booking_status == 'pending' ? 'badge-info' : '' }} {{
                                                $booking->booking_status == 'accepted' ? 'badge-success' : '' }} {{
                                                $booking->booking_status == 'rejected' ? 'badge-danger' : ''
                                            }}">
                                                {{ ucfirst($booking->booking_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Action buttons --}}
                                            @if($booking->booking_status == 'pending')
                                                <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>
                                                    {{ $booking->booking_status == 'accepted' ? 'Accepted' : 'Rejected' }}
                                                </button>
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
</div>
