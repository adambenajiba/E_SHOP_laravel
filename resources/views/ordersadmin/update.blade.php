
@extends('layouts.dashboard')
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @include('partials.adminMenu') --}}
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <a class="layout-menu-toggle align-items-xl-center me-xl-0 d-xl-none myColor"
                                href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                            <span class="text-muted fw-light">Order /</span>
                            Update Order
                        </h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <h5 class="card-header">Order Details</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product_id</th>
                                                    <th>Product</th>
                                                    <th>price</th>
                                                    <th>quantity</th>
                                                    <th>total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItems as $orderItem)
                                                    <tr>
                                                        <td>
                                                            {{ $orderItem->product->id }}
                                                        </td>
                                                        <td>
                                                            <ul
                                                                class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="right" class="avatar avatar-lg "
                                                                    title="{{ $orderItem->product->name }}">
                                                                    <img src="{{ asset('storage/images/' . $orderItem->product->image) }}"
                                                                        alt="Avatar" class="rounded-circle" />
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>{{ $orderItem->product->price }} $</td>
                                                        <td>{{ $orderItem->quantity }}</td>
                                                        <td>{{ $orderItem->quantity * $orderItem->product->price }} $</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="table-border-bottom-0">
                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <th>{{ $orderItem->order->total_price }} $</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <h5 class="card-footer mb-0">Status</h5>
                                    <form class="mb-3 d-flex"
                                        action="{{ route('dashboard-admin-order-edit', $orderItem->order->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select mx-3 w-50 cursor-pointer"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option value="" selected>Pending</option>
                                            <option value="delivred">Delivred</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary me-2">Update Order Status</button>
                                    </form>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection
