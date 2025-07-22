<x-adminheader />

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="font-weight-bold">Welcome, Sazlo Admin 🎉</h3>
                <p class="text-muted">Here’s what’s happening with your platform today.</p>
            </div>
        </div>

        <div class="row g-4">
            @php
                // Added Total Revenue to the cards array
                $cards = [
                    ['label' => 'Total Revenue', 'count' => 'NPR ' . number_format($totalRevenue, 2), 'url' => 'ourOrders', 'class' => 'success'],
                    ['label' => 'Total Teachers', 'count' => $totalTeachers, 'url' => 'adminTeachers', 'class' => 'primary'],
                    ['label' => 'Total Bookings', 'count' => $totalBookings, 'url' => 'adminBookings', 'class' => 'info'],
                    ['label' => 'Total Orders', 'count' => $totalOrders, 'url' => 'ourOrders', 'class' => 'danger'],
                    ['label' => 'Total Product', 'count' => $totalProducts, 'url' => 'adminProducts', 'class' => 'secondary'],
                    ['label' => 'Total Reviews', 'count' => $totalReviews, 'url' => 'reviews', 'class' => 'warning'],
                    ['label' => 'Number of Users', 'count' => $totalUsers, 'url' => 'ourCustomers', 'class' => 'dark'],
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-md-4 col-lg-3 mb-4"> <a href="{{ url($card['url']) }}" class="text-decoration-none">
                        <div class="card text-white bg-{{ $card['class'] }} shadow-sm rounded-3 hover-zoom h-100">
                            <div class="card-body">
                                <p class="mb-2">{{ $card['label'] }}</p>
                                <h3 class="font-weight-bold">{{ $card['count'] }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Monthly Bookings Overview</h4>
                        <canvas id="bookingChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                 <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Monthly Revenue (Completed Orders)</h4>
                        <canvas id="revenueChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-adminfooter />
</div>

<script>
    // 1. Booking Chart (Bar)
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(bookingCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bookingMonths) !!},
            datasets: [{
                label: 'Bookings',
                data: {!! json_encode($bookingCounts) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 6,
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // 2. NEW: Revenue Chart (Line)
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line', // Using a line chart for revenue trends
        data: {
            labels: {!! json_encode($revenueMonths) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueAmounts) !!},
                backgroundColor: 'rgba(40, 167, 69, 0.2)', // Greenish area fill
                borderColor: 'rgba(40, 167, 69, 1)',      // Solid green line
                borderWidth: 2,
                fill: true,
                tension: 0.4 // Makes the line smooth
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        // Formats the Y-axis labels as currency
                        callback: function(value) {
                            return 'NPR ' + value.toLocaleString();
                        }
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        // Formats the tooltip that appears on hover
                        label: function(context) {
                            return 'Revenue: NPR ' + Number(context.raw).toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>

<style>
    .hover-zoom:hover {
        transform: scale(1.03);
        transition: 0.3s ease;
    }
</style>