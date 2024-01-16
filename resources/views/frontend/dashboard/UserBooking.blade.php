@extends('frontend.layout.app')
@section('content')

<!-- Inner Banner -->
<div class="inner-banner inner-bg6">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>User Dashboard </li>
            </ul>
            <h3>User Dashboard</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Service Details Area -->
<div class="service-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.dashboard.UserMenu')
            </div>

            {{-- {{ count($user->booking) }} --}}
            <div class="col-lg-9">
                <div class="service-article">                   

                    <section class="checkout-area pb-70">
                        <div class="container">
                            <h3>User Booking List</h3>
                            <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">B No</th>
                                            <th scope="col">B Date</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Room</th>
                                            <th scope="col">Check In/Out</th>
                                            <th scope="col">Total Room</th>
                                            <th scope="col">Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->booking as $booking)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user.invoice' , $booking->id) }}">{{ $booking->code }}</a>
                                                </td>
                                                <td>{{ $booking->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $booking->room->roomType->name }}</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $booking->check_in }}</span> 
                                                    <span class="badge bg-warning text-dark">{{ $booking->check_out }}</span>
                                                </td>
                                                <td>{{ $booking->number_of_rooms }}</td>
                                                <td>{!! $booking->status == 1 ? "<span class='badge bg-success'>Complete</span>" : "<span class='badge bg-info text-dark'>Pending</span>" !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </section>
                    
                </div>
            </div>

            
        </div>
    </div>
</div>
<!-- Service Details Area End -->
    
@endsection