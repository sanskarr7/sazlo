<x-adminheader />


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif

            @foreach ($teacherBookings as $teacherId => $bookingsByTeacher)
                @php
                    $teacher = $bookingsByTeacher->first();
                @endphp
                <div class="col-12 grid-margin stretch-card"> {{-- Full row for each teacher --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">

                                @if ($teacher->teacher_picture)
                                    <img src="{{ asset($teacher->teacher_picture) }}" alt="Teacher Picture"
                                        style="width: 50px; height: 50px; border-radius: 50%; margin-left: 10px;">
                                @else
                                    <img src="{{ asset('img/teachers/default.jpg') }}" alt="Default Picture"
                                        style="width: 50px; height: 50px; border-radius: 50%; margin-left: 10px;">
                                @endif
                                Teacher Name: {{ $teacher->teacher_name }}
                            </h5>
                            <div class="d-flex justify-content-end mb-2">
                                <form action="{{ route('bookings.sendReminderAll', $teacher->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm"
                                        style="background-color: #4B49AC; color: white;">
                                        Send Reminder To ALL Students
                                    </button>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                            <th>Booking Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookingsByTeacher as $key => $booking)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $booking->student_name }}</td>
                                                <td>{{ $booking->student_email }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $booking->booking_status == 'pending' ? 'badge-info' : '' }} {{ $booking->booking_status == 'accepted' ? 'badge-success' : '' }} {{ $booking->booking_status == 'rejected' ? 'badge-danger' : '' }} ">
                                                        {{ ucfirst($booking->booking_status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($booking->booking_status == 'pending')
                                                        <form action="{{ route('bookings.accept', $booking->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Accept</button>
                                                        </form>
                                                        <form action="{{ route('bookings.reject', $booking->id) }}"
                                                            method="POST"
                                                            style="display:inline-block; margin-left: 5px;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @elseif($booking->booking_status == 'accepted')
                                                        @if ($booking->reminder_sent_at)
                                                            <span class="badge badge-success">Reminder Sent</span>
                                                        @else
                                                            <form
                                                                action="{{ route('bookings.sendReminder', $booking->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm">Send
                                                                    Reminder</button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            {{ ucfirst($booking->booking_status) }}
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
            @endforeach
        </div>
    </div>
    <x-adminfooter />
</div>
