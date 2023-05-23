@extends('layouts.guest')
@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('partials.clientMenu')
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderedItems as $orderedItem)
                                                    <tr>
                                                        <td>
                                                            {{ $orderedItem->product->id }}
                                                        </td>
                                                        <td>
                                                            <ul
                                                                class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="right" class="avatar avatar-lg "
                                                                    title="{{ $orderedItem->product->name }}">
                                                                    <img src="{{ asset('storage/images/' . $orderedItem->product->image) }}"
                                                                        alt="Avatar" class="rounded-circle" />
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>{{ $orderedItem->product->price }} $</td>
                                                        <td>{{ $orderedItem->quantity }}</td>
                                                        <td>{{ $orderedItem->product->price * $orderedItem->quantity }} $
                                                        </td>
                                                        <td>
                                                            <form class="my-2 w-100 text-center" method="POST"
                                                                action="{{ route('dashboard-client-orderItem-cancel', $orderedItem->order->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-primary">Cancel Item</button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="table-border-bottom-0">
                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <th>{{ $orderedItem->order->total_price }} $</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <form class="my-2 w-100 text-center" method="POST"
                                        action="{{ route('dashboard-client-order-cancel', $orderedItem->order->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary mx-3 w-75">Cancel Order</button>
                                    </form>
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
