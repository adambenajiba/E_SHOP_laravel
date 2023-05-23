@extends('layouts.guest')
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @include('partials.clientMenu') --}}
            <!-- / Menu -->

            <!-- Layout -->
            <div class="layout-page">

                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <a class="layout-menu-toggle align-items-xl-center me-xl-0 d-xl-none myColor"
                                href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>

                            <span class="text-muted fw-light">Orders /</span>
                            My Orders
                        </h4>
                        @if (count($myPendingOrders) == 0 && count($myFinishedOrders) == 0)
                            <div class="card">
                                <h5 class="card-header d-flex align-items-center justify-content-between"><span> No orders
                                        for now</span>
                                </h5>
                            </div>
                        @else
                            @if (count($myPendingOrders) != 0)
                                <div class="card">
                                    <h5 class="card-header d-flex align-items-center justify-content-between"><span>Pending
                                            Orders
                                            Table</span>
                                    </h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order_Id</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($myPendingOrders as $pOrder)
                                                    <tr>
                                                        <td>{{ $pOrder->id }}</td>
                                                        <td>
                                                            {{ $pOrder->total_price }} $
                                                        <td>
                                                            <span class="badge bg-label-warning me-1">Pending</span>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('client-order-update', $pOrder->id) }}">
                                                                <div class="btn btn-primary">
                                                                    Update Order
                                                                </div>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <h5 class="card-header d-flex align-items-center justify-content-between"><span> No
                                            pending orders for now</span>
                                    </h5>
                                </div>
                            @endif
                            @if (count($myFinishedOrders) != 0)
                                <div class="card my-3">
                                    <h5 class="card-header d-flex align-items-center justify-content-between">
                                        <span>Delivred-Cancelled
                                            Orders
                                            Table</span>
                                    </h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order_Id</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($myFinishedOrders as $fOrder)
                                                    <tr>
                                                        <td>{{ $fOrder->id }}</td>
                                                        <td>{{ $fOrder->total_price }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $fOrder->status === 'cancelled' ? 'bg-label-danger' : 'bg-label-success' }} me-1">
                                                                {{ strtoupper($fOrder->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            @else
                                <div class="card my-3">
                                    <h5 class="card-header d-flex align-items-center justify-content-between"><span> No
                                            delivred or cancelled orders for now</span>
                                    </h5>
                                </div>
                            @endif
                        @endif
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
            <!-- Layout -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection
