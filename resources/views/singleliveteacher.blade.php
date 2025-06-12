<x-header />

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Teacher Profile</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/liveteacher') }}">Teachers</a>
                        <span>{{ $teacher->name ?? 'Teacher Details' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-teacher-profile spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="teacher-profile-card">
                    <div class="profile-sidebar">
                        <div class="profile-pic-container">
                            @if($teacher->picture)
                                <img src="{{ asset('uploads/teachers/' . $teacher->picture) }}" alt="{{ $teacher->name }}" class="profile-pic">
                            @else
                                {{-- Fallback to a default image if no picture is available --}}
                                <img src="{{ asset('img/teachers/default.jpg') }}" alt="Default Teacher Image" class="profile-pic">
                            @endif
                        </div>
                        <h2 class="teacher-name">{{ $teacher->name ?? 'N/A' }}</h2>
                        {{-- Dynamic information below the teacher's name --}}
                        <p class="teacher-info">Course: <strong>{{ $teacher->course ?? 'N/A' }}</strong></p>
                        <p class="teacher-info">Price: <strong>Rs {{ $teacher->price ?? 'N/A' }}</strong></p>
                        <p class="teacher-info">Start Time: <strong>{{ \Carbon\Carbon::parse($teacher->start_time)->format('h:i A') ?? 'N/A' }}</strong></p>
                        <p class="teacher-info">Phone: <strong>{{ $teacher->number ?? 'N/A' }}</strong></p>

                        {{-- Changed button to open new booking modal --}}
                        <button class="book-session-btn" onclick="openBookSessionPopup()">Book a Session</button>
                        <button class="contact-btn" onclick="openContactPopup()">Contact</button>
                    </div>
                    <div class="profile-content">
                        <div class="description-section">
                            <h3>Description</h3>
                            <p>{{ $teacher->description ?? 'No description available.' }}</p>
                        </div>
                        <div class="more-info-section">
                            <h3>More Information</h3>
                            <ul>
                                {{-- Assuming 'more_info' is a string where each line is a separate item --}}
                                @if($teacher->more_info)
                                    @foreach(explode("\n", $teacher->more_info) as $item)
                                        @if(trim($item) !== '')
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach
                                @else
                                    <li>No additional information available.</li>
                                @endif
                            </ul>
                        </div>
                        <div class="available-classes-section">
                            <h3>Available Classes</h3>
                            @if($teacher->liveClasses && $teacher->liveClasses->count() > 0)
                                <ul>
                                    @foreach($teacher->liveClasses as $liveClass)
                                        <li>
                                            <strong>{{ $liveClass->class_name }}</strong> on {{ \Carbon\Carbon::parse($liveClass->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($liveClass->time)->format('h:i A') }} ({{ $liveClass->seats_remaining }} seats remaining)
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No live classes listed yet for this teacher.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Modal (existing) --}}
<div id="contactModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeContactPopup()">&times;</span>
        <h2>Contact Details</h2>
        <p><strong>Phone:</strong> {{ $teacher->number ?? 'N/A' }}</p>
        <p><strong>Email:</strong> {{ $teacher->email ?? 'N/A' }}</p>
    </div>
</div>

{{-- NEW: Book Session Modal --}}
{{-- In singleliveteacher.blade.php, find the <div id="bookSessionModal" class="modal"> --}}
<div id="bookSessionModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px; position: relative;">
        <span class="close-button" onclick="closeBookSessionPopup()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <h2 style="margin-bottom: 20px; font-size: 1.5em; text-align: center;">Book Your Session</h2>
        <form action="{{ route('book.live.class') }}" method="POST">
            @csrf {{-- Laravel CSRF token for security --}}

            {{-- Pass the live class ID. Assuming $liveClass is available in this view. --}}
            <input type="hidden" name="live_class_id" value="{{ $liveClass->id ?? '' }}">

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="student_name" style="display: block; margin-bottom: 5px; font-weight: bold;">Your Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="student_email" style="display: block; margin-bottom: 5px; font-weight: bold;">Your Email:</label>
                <input type="email" id="student_email" name="student_email" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <p style="margin-top: 15px; text-align: center;">You are booking a class with: <strong>{{ $teacher->name ?? 'N/A' }}</strong></p>
            <p style="text-align: center;">Class Title: <strong>{{ $liveClass->title ?? 'N/A' }}</strong></p>

            <button type="submit" class="btn btn-primary" style="display: block; width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em;">Book Now</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top: 20px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 10px; border: 1px solid transparent; border-radius: 0.25rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" style="margin-top: 20px; color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 10px; border: 1px solid transparent; border-radius: 0.25rem;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" style="margin-top: 20px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 10px; border: 1px solid transparent; border-radius: 0.25rem;">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
<x-footer />

{{-- Inline CSS for the design - it's recommended to move this to a dedicated CSS file for larger projects --}}
<style>
    .single-teacher-profile {
        padding: 50px 0; /* Padding around the entire section */
    }
    .teacher-profile-card {
        display: flex; /* Use flexbox for sidebar and content layout */
        background-color: #ffffff; /* White background for the card */
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        overflow: hidden; /* Ensures border-radius applies to content */
        margin-top: 30px;
    }
    .profile-sidebar {
        flex: 0 0 350px; /* Fixed width for the sidebar, slightly adjusted for screenshot */
        padding: 40px 30px; /* Padding inside the sidebar */
        background-color: #f3fcf2; /* Light green background for sidebar to match image */
        display: flex;
        flex-direction: column;
        align-items: center; /* Center items horizontally */
        text-align: center;
        border-right: 1px solid #e0e0e0; /* Separator line */
    }
    .profile-pic-container {
        width: 180px; /* Larger image container */
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #daf7da; /* Border matching the image */
        margin-bottom: 25px; /* Spacing below the image */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .profile-pic {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures image covers the container */
        border-radius: 50%; /* Makes the image round */
    }
    .teacher-name {
        font-size: 1.9rem; /* Larger font size for name */
        font-weight: 700; /* Bolder font weight */
        color: #333;
        margin-bottom: 20px; /* Reduced margin to fit new info */
    }
    .teacher-info {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 8px; /* Spacing between new info lines */
        line-height: 1.4; /* Adjust line height for better readability */
    }
    .teacher-info strong {
        color: #333;
    }
    .book-session-btn,
    .contact-btn {
        display: block; /* Make buttons take full width */
        width: 90%; /* Width of the buttons */
        padding: 14px 20px; /* Padding inside buttons */
        margin-top: 20px; /* Space above buttons after info */
        margin-bottom: 18px; /* Spacing between buttons */
        border: none;
        border-radius: 30px; /* More rounded corners */
        font-size: 1.05rem; /* Slightly larger font */
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-decoration: none; /* Remove underline for links */
        text-align: center;
    }
    .book-session-btn {
        background-color: #5cb85c; /* Green color from screenshot */
        color: white;
    }
    .book-session-btn:hover {
        background-color: #4cae4c; /* Darker green on hover */
        transform: translateY(-2px); /* Slight lift effect */
    }
    .contact-btn {
        background-color: #ffffff; /* White background for contact button */
        color: #666; /* Darker grey text */
        border: 1px solid #ccc; /* Border color for contact button */
    }
    .contact-btn:hover {
        background-color: #f5f5f5; /* Light grey on hover */
        transform: translateY(-2px);
    }
    .profile-content {
        flex: 1; /* Takes up the remaining space */
        padding: 40px; /* Padding for the content area */
    }
    .description-section,
    .more-info-section,
    .available-classes-section {
        margin-bottom: 40px; /* Spacing between sections */
    }
    .profile-content h3 {
        font-size: 1.6rem; /* Larger heading font size */
        font-weight: 700; /* Bolder headings */
        color: #333;
        margin-bottom: 18px; /* Spacing below headings */
        padding-bottom: 8px; /* Padding for the border */
        border-bottom: 2px solid #e0e0e0; /* Light grey border below headings */
        display: inline-block; /* Makes border only as wide as text */
        width: auto; /* Adjust width to content */
    }
    .profile-content p,
    .profile-content ul {
        font-size: 1.05rem; /* Slightly larger paragraph/list item font */
        line-height: 1.7; /* Increased line height for readability */
        color: #555; /* Darker grey text */
    }
    .profile-content ul {
        list-style: none; /* Remove default bullet points */
        padding-left: 0;
    }
    .profile-content ul li {
        margin-bottom: 10px; /* Spacing between list items */
        position: relative;
        padding-left: 25px; /* Space for custom bullet */
    }
    .profile-content ul li::before {
        content: "\2022"; /* Unicode for a solid bullet point */
        color: #5cb85c; /* Green bullet color matching the image */
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
        position: absolute;
        left: 0;
        top: 0; /* Align bullet to the top of the text */
    }

    /* Modal Styles */
    .modal {
        display: none; /* Crucial: Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }
    .modal-content {
        background-color: #fefefe;
        margin: auto; /* For older browsers, flexbox handles centering */
        padding: 30px;
        border: 1px solid #888;
        border-radius: 8px;
        width: 80%; /* Could be adjusted */
        max-width: 500px; /* Max width for larger screens */
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        position: relative;
        text-align: center;
    }
    .modal-content h2 {
        margin-top: 0;
        color: #333;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }
    .modal-content p {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 10px;
    }
    .modal-content strong {
        color: #000;
    }
    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
    }
    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    /* Styles for form elements within modals */
    .form-group {
        margin-bottom: 15px;
        text-align: left; /* Align labels and inputs to the left */
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }
    .modal-footer {
        padding-top: 20px;
        border-top: 1px solid #eee;
        text-align: right;
    }
    .modal-footer button {
        margin-left: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .teacher-profile-card {
            flex-direction: column; /* Stack sidebar and content vertically */
            text-align: center;
        }
        .profile-sidebar {
            flex: none;
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #e0e0e0; /* Add bottom border when stacked */
            padding: 30px;
        }
        .book-session-btn,
        .contact-btn {
            width: 60%; /* Adjust button width for tablets */
            margin-left: auto;
            margin-right: auto;
        }
        .profile-content {
            padding: 30px;
        }
        .profile-content h3 {
            display: block; /* Make headings take full width when stacked */
            width: 100%;
            text-align: center;
        }
        .profile-content ul, .profile-content p {
            text-align: left; /* Align text left in content area */
        }
    }

    @media (max-width: 767px) {
        .profile-sidebar {
            padding: 25px;
        }
        .profile-content {
            padding: 25px;
        }
        .profile-pic-container {
            width: 150px;
            height: 150px;
        }
        .teacher-name {
            font-size: 1.7rem;
        }
        .book-session-btn,
        .contact-btn {
            width: 80%; /* Further adjust button width for mobile */
        }
        .profile-content h3 {
            font-size: 1.4rem;
            text-align: left; /* Adjust for smaller screens where width might be small */
        }
        .profile-content ul li {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 575px) {
        .profile-sidebar {
            padding: 20px;
        }
        .profile-pic-container {
            width: 120px;
            height: 120px;
        }
        .teacher-name {
            font-size: 1.5rem;
        }
        .book-session-btn,
        .contact-btn {
            width: 95%; /* Almost full width for very small screens */
            padding: 12px 15px;
            font-size: 1rem;
        }
        .profile-content {
            padding: 20px;
        }
        .profile-content h3 {
            font-size: 1.2rem;
        }
        .profile-content p,
        .profile-content ul li {
            font-size: 0.9rem;
        }
    }
</style>

{{-- JavaScript for the pop-up functionality --}}
<script>
    function openContactPopup() {
        const modal = document.getElementById('contactModal');
        modal.style.display = 'flex';
        modal.style.justifyContent = 'center';
        modal.style.alignItems = 'center';
    }

    function closeContactPopup() {
        document.getElementById('contactModal').style.display = 'none';
    }

    function openBookSessionPopup() {
        const modal = document.getElementById('bookSessionModal');
        modal.style.display = 'flex';
        modal.style.justifyContent = 'center';
        modal.style.alignItems = 'center';
    }

    function closeBookSessionPopup() {
        document.getElementById('bookSessionModal').style.display = 'none';
    }

    // Close any modal if the user clicks outside of it
    window.onclick = function(event) {
        var contactModal = document.getElementById('contactModal');
        var bookSessionModal = document.getElementById('bookSessionModal');

        if (event.target == contactModal) {
            contactModal.style.display = 'none';
        }
        if (event.target == bookSessionModal) {
            bookSessionModal.style.display = 'none';
        }
    }
</script>
