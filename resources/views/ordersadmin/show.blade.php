@extends('layouts.app')
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @include('partials.adminMenu') --}}
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
                            Client Orders
                        </h4>
                        @if (count($pendingOrders) == 0 && count($finishedOrders) == 0)
                            <div class="card">
                                <h5 class="card-header d-flex align-items-center justify-content-between"><span>No Order For
                                        Now</span>
                                </h5>
                            </div>
                        @else
                            @if (count($pendingOrders) != 0)
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
                                                    <th>Client name</th>
                                                    <th>Client email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($pendingOrders as $pOrder)
                                                    <tr>
                                                        <td>{{ $pOrder->id }}</td>
                                                        <td>{{ $pOrder->user->first_name . ' ' . $pOrder->user->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $pOrder->user->email }}
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-label-warning me-1">Pending</span>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('update-orders', $pOrder->id) }}">
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
                            @endif
                            @if (count($finishedOrders) != 0)
                                <div class="card my-3">
                                    <h5 class="card-header d-flex align-items-center justify-content-between">
                                        <span>Delivred-Cancelled
                                            Orders
                                            Table</span>
                                        <a href="{{ route('dashboard-admin-pdf') }}" class="btn btn-primary">Download
                                            Invoice</a>
                                    </h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order_Id</th>
                                                    <th>Client name</th>
                                                    <th>Client email</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($finishedOrders as $fOrder)
                                                    <tr>
                                                        <td>{{ $fOrder->id }}</td>
                                                        <td>{{ $fOrder->user->first_name . ' ' . $fOrder->user->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $fOrder->user->email }}
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $fOrder->status == 'cancelled' ? 'bg-label-danger' : 'bg-label-success' }} me-1">{{ strtoupper($fOrder->status) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
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
