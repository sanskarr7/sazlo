<x-header /> {{-- Assuming you use a general user-side header component --}}

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>My Online Classes</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <span>My Online Classes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-10 col-md-10 mx-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Link Will Be Sent 15 min Before Start Time. ThankYou!</p>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Teacher Name</th>
                                        <th>Course</th>
                                        <th>Class Title</th>
                                        <th>Start Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($onlineClasses->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center py-4">You have no accepted online classes yet.</td>
                                        </tr>
                                    @else
                                        @foreach($onlineClasses as $key => $class)
                                            @php
                                                // MODIFIED: Parse the start_time assuming it's already in 'Asia/Kathmandu' timezone
                                                $startTime = \Carbon\Carbon::parse($class->start_time, 'Asia/Kathmandu');
                                                $currentTime = \Carbon\Carbon::now();
                                                // Check if current time is within 15 minutes before start_time OR after start_time
                                                $showJoinButton = $currentTime->greaterThanOrEqualTo($startTime->copy()->subMinutes(15));
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $class->teacher_name }}</td>
                                                <td>{{ $class->course }}</td>
                                                <td>{{ $class->live_class_title }}</td>
                                                {{-- Display the time directly after parsing it with the correct timezone --}}
                                                <td>{{ $startTime->format('Y-m-d H:i A') }}</td>
                                                <td>
                                                    @if($showJoinButton && $class->class_link)
                                                        <a href="{{ $class->class_link }}" target="_blank" class="btn btn-primary btn-sm">Join Class</a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            @if (!$class->class_link)
                                                                Link Not Available
                                                            @elseif ($currentTime->lessThan($startTime->copy()->subMinutes(5)))
                                                                Join (Upcoming)
                                                            @else
                                                                Join Class
                                                            @endif
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer /> {{-- Assuming you use a general user-side footer component --}}
</div>
