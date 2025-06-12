<x-adminheader />

<div class="d-flex flex-column min-vh-100">
    <div class="main-panel flex-grow-1">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title mb-3">Teacher Management</p>

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTeacherModal">
                                <i class="mdi mdi-plus"></i> Add Teacher
                            </button>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-2">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Course</th>
                                            <th>Price</th>
                                            <th>Total Seats</th>
                                            <th>Booked Seats</th>
                                            <th>Description</th>
                                            <th>More Info</th>
                                            <th>Live Classes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($teachers as $index => $teacher)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($teacher->picture)
                                                        <img src="{{ asset('storage/' . $teacher->picture) }}" alt="Teacher Picture" width="50" class="img-thumbnail">
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->number }}</td>
                                                <td>{{ $teacher->course }}</td>
                                                <td>{{ number_format($teacher->price, 2) }}</td>
                                                <td>{{ $teacher->total_seats }}</td>
                                                <td>{{ $teacher->booked_seats }}</td>
                                                <td>{{ Str::limit($teacher->description, 30) }}</td>
                                                <td>{{ Str::limit($teacher->more_info, 30) }}</td>
                                                <td>
                                                    @forelse($teacher->liveClasses as $liveClass)
                                                        <div class="mb-1">
                                                            <a href="{{ $liveClass->link }}" target="_blank" class="badge badge-info">
                                                                <i class="mdi mdi-video"></i> {{ $liveClass->title }}
                                                            </a>
                                                            <br>
                                                            <small class="text-muted">{{ \Carbon\Carbon::parse($liveClass->start_time)->format('M d, H:i') }} ({{ $liveClass->status }})</small>
                                                            <div class="btn-group btn-group-sm ml-1" role="group" aria-label="Live Class Actions">
                                                                <button type="button" class="btn btn-outline-secondary edit-live-class-btn"
                                                                        data-toggle="modal" data-target="#editLiveClassModal"
                                                                        data-id="{{ $liveClass->id }}"
                                                                        data-title="{{ $liveClass->title }}"
                                                                        data-link="{{ $liveClass->link }}"
                                                                        data-start_time="{{ \Carbon\Carbon::parse($liveClass->start_time)->format('Y-m-d\TH:i') }}"
                                                                        data-end_time="{{ $liveClass->end_time ? \Carbon\Carbon::parse($liveClass->end_time)->format('Y-m-d\TH:i') : '' }}"
                                                                        data-description="{{ $liveClass->description }}"
                                                                        data-status="{{ $liveClass->status }}"
                                                                        title="Edit Live Class">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </button>
                                                                <a href="#"
                                                                   onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this live class?')) { document.getElementById('delete-live-class-form-{{$liveClass->id}}').submit(); }"
                                                                   class="btn btn-outline-danger" title="Delete Live Class">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </a>
                                                                <form id="delete-live-class-form-{{$liveClass->id}}" action="{{ route('live-classes.delete', $liveClass->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <span class="badge badge-secondary">No classes scheduled</span>
                                                    @endforelse
                                                    <button class="btn btn-sm btn-success mt-2 add-live-class-btn"
                                                            data-toggle="modal"
                                                            data-target="#addLiveClassModal"
                                                            data-teacher_id="{{ $teacher->id }}" title="Add New Live Class">
                                                        <i class="mdi mdi-plus"></i> Schedule
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary edit-teacher-btn"
                                                                data-toggle="modal" data-target="#editTeacherModal"
                                                                data-id="{{ $teacher->id }}"
                                                                data-name="{{ $teacher->name }}"
                                                                data-number="{{ $teacher->number }}"
                                                                data-course="{{ $teacher->course }}"
                                                                data-price="{{ $teacher->price }}"
                                                                data-total_seats="{{ $teacher->total_seats }}"
                                                                data-description="{{ $teacher->description }}"
                                                                data-more_info="{{ $teacher->more_info }}"
                                                                data-picture_url="{{ $teacher->picture ? asset('storage/' . $teacher->picture) : '' }}"
                                                                title="Edit Teacher">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <a href="#"
                                                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this teacher?')) { document.getElementById('delete-teacher-form-{{$teacher->id}}').submit(); }"
                                                           class="btn btn-sm btn-outline-danger" title="Delete Teacher">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                        <form id="delete-teacher-form-{{$teacher->id}}" action="{{ route('teachers.delete', $teacher->id) }}" method="GET" style="display: none;">
                                                            @csrf {{-- GET requests don't typically use @csrf, but including it doesn't hurt --}}
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="text-center">No teachers found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Total Seats</label>
                            <input type="number" name="total_seats" class="form-control" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>More Info</label>
                            <textarea name="more_info" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Teacher Picture</label>
                            <input type="file" name="picture" class="form-control-file" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Teacher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTeacherForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <input type="text" name="number" id="edit_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input type="text" name="course" id="edit_course" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" id="edit_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Total Seats</label>
                            <input type="number" name="total_seats" id="edit_total_seats" class="form-control" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>More Info</label>
                            <textarea name="more_info" id="edit_more_info" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_picture">Teacher Picture</label>
                            <input type="file" name="picture" id="edit_picture" class="form-control-file" accept="image/*">
                            <div class="mt-2" id="current_picture_container">
                                <img src="" alt="Teacher Picture" width="100" class="img-thumbnail" id="current_picture">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Teacher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addLiveClassModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule Live Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addLiveClassForm" method="POST">
                        @csrf
                        <input type="hidden" name="teacher_id" id="add_live_class_teacher_id">
                        <div class="form-group">
                            <label>Class Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., Physics Q&A Session" required>
                        </div>
                        <div class="form-group">
                            <label>Meeting URL</label>
                            <input type="url" name="link" class="form-control" placeholder="https://meet.google.com/abc-xyz" required>
                            <small class="form-text text-muted">Google Meet, Zoom, or other video conference link</small>
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End Time (Optional)</label>
                            <input type="datetime-local" name="end_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="scheduled">Scheduled</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Schedule Class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editLiveClassModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Live Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editLiveClassForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Class Title</label>
                            <input type="text" name="title" id="edit_live_class_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Meeting URL</label>
                            <input type="url" name="link" id="edit_live_class_link" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="datetime-local" name="start_time" id="edit_live_class_start_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End Time (Optional)</label>
                            <input type="datetime-local" name="end_time" id="edit_live_class_end_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea name="description" id="edit_live_class_description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="edit_live_class_status" class="form-control">
                                <option value="scheduled">Scheduled</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <x-adminfooter />
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Edit Teacher Modal
        document.querySelectorAll('.edit-teacher-btn').forEach(button => {
            button.addEventListener('click', function () {
                const teacherId = this.dataset.id;
                const form = document.getElementById('editTeacherForm');
                form.action = `/teachers/update/${teacherId}`; // Update form action URL

                document.getElementById('edit_name').value = this.dataset.name;
                document.getElementById('edit_number').value = this.dataset.number;
                document.getElementById('edit_course').value = this.dataset.course;
                document.getElementById('edit_price').value = this.dataset.price;
                document.getElementById('edit_total_seats').value = this.dataset.total_seats;
                document.getElementById('edit_description').value = this.dataset.description;
                document.getElementById('edit_more_info').value = this.dataset.more_info;

                const currentPicture = document.getElementById('current_picture');
                const currentPictureContainer = document.getElementById('current_picture_container');
                if (this.dataset.picture_url) {
                    currentPicture.src = this.dataset.picture_url;
                    currentPictureContainer.style.display = 'block';
                } else {
                    currentPicture.src = '';
                    currentPictureContainer.style.display = 'none';
                }
            });
        });

        // Handle Add Live Class Modal
        document.querySelectorAll('.add-live-class-btn').forEach(button => {
            button.addEventListener('click', function () {
                const teacherId = this.dataset.teacher_id;
                const form = document.getElementById('addLiveClassForm');
                form.action = `/teachers/${teacherId}/live-classes`; // Update form action URL
                document.getElementById('add_live_class_teacher_id').value = teacherId;

                // Clear previous values if any
                form.reset(); // Resets all form fields to their initial values
            });
        });


        // Handle Edit Live Class Modal
        document.querySelectorAll('.edit-live-class-btn').forEach(button => {
            button.addEventListener('click', function () {
                const liveClassId = this.dataset.id;
                const form = document.getElementById('editLiveClassForm');
                form.action = `/live-classes/${liveClassId}`; // Update form action URL

                document.getElementById('edit_live_class_title').value = this.dataset.title;
                document.getElementById('edit_live_class_link').value = this.dataset.link;
                document.getElementById('edit_live_class_start_time').value = this.dataset.start_time;
                document.getElementById('edit_live_class_end_time').value = this.dataset.end_time;
                document.getElementById('edit_live_class_description').value = this.dataset.description;
                document.getElementById('edit_live_class_status').value = this.dataset.status;
            });
        });
    });
</script>
