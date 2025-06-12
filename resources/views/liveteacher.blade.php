<x-header />

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Live Classes</h4>
                    <div class="breadcrumb__links">
                        <a href="#">Home</a>
                        <a href="#">Classes</a>
                        <span>Live Classes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Available Seat</th>
                                <th style="padding-left: 90px;">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr>
                                <td class="product__cart__item" style="white-space: nowrap;">
                                    <a href="{{ url('/singleliveteacher/' . $teacher->id) }}">
                                        <div class="product__cart__item__pic">
                                            {{-- Display teacher picture if available --}}
                                            @if($teacher->picture)
                                            <img src="{{ asset('uploads/teachers/' . $teacher->picture) }}" width="100px"
                                                alt="Teacher">
                                            @else
                                            <img src="{{ asset('img/teachers/default.jpg') }}" width="100px"
                                                alt="Default Teacher Image">
                                            @endif
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h5 style="font-weight: bold;">{{ $teacher->name }}</h5>
                                            <h6>Course: {{ $teacher->course }}</h6>
                                            <p style="color: red;">Price: Rs {{ $teacher->price }}</p>
                                            <p>Start Time: {{ $teacher->start_time }}</p>
                                        </div>
                                    </a>
                                </td>
                                <td class="cart__price" style="padding-right: 40px;">8 out of 20 Seats Remaining</td>
                                <td style="padding-left: 90px;">
                                    <div
                                        style="width: 60px; height: 60px; border-radius: 50%; background-color: black; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                        12<br><span style="font-size: 10px;">Joined</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No teachers available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<x-footer />
