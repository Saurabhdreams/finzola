@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
<style>
.widget-dash {
    transition: box-shadow 0.3s ease;
}
.widget-dash:hover {
    box-shadow: 0 4px 7px rgba(0, 0, 0, 0.5);
}
</style>
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        {{-- Clients Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('clients.index') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-primary widget-dash shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
                                    <div
                                        class="bg-cyan-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user card-icon text-white"></i>
                                    </div>
                                    <div class="text-end text-white">
                                        <h2 class="fs-1-xxl fw-bolder text-white">{{ formatTotalAmount($total_clients) }}
                                        </h2>
                                        <h3 class="mb-0 fs-4 fw-light"> {{ __('messages.admin_dashboard.total_clients') }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Total Invoices Amount Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('currency.reports') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-success shadow-md rounded-10 py-10 d-flex align-items-center justify-content-center my-3 widget-dash">
                                    <div class="text-white mt-3 text-center">
                                        <h2 class="fs-1-xxl fw-bolder text-white">
                                            {{ __('messages.admin_dashboard.total_amount') }}
                                        </h2>
                                        {{-- <span class="text-white">{{ __('messages.common.click_here') }}</span> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Recieved Amount Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('currency.reports') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-info shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-center my-3 widget-dash">
                                    <div class="text-white mt-3 text-center">
                                        <h2 class="fs-1-xxl fw-bolder text-white">
                                            {{ __('messages.admin_dashboard.total_paid') }}
                                        </h2>
                                        {{-- <span class="text-white">{{ __('messages.common.click_here') }}</span> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Partially Paid Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('currency.reports') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-yellow-300 shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-center my-3 widget-dash">
                                    <div class="text-white mt-3 text-center">
                                        <h2 class="fs-1-xxl fw-bolder text-white">
                                            {{ __('messages.admin_dashboard.total_due') }}
                                        </h2>
                                        {{-- <span class="text-white">{{ __('messages.common.click_here') }}</span> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Products Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('products.index') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-secondary  shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 widget-dash">
                                    <div
                                        class="bg-gray-200 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-cube card-icon text-dark"></i>
                                    </div>
                                    <div class="text-end text-dark">
                                        <h2 class="fs-1-xxl fw-bolder text-dark">{{ formatTotalAmount($total_products) }}
                                        </h2>
                                        <h3 class="mb-0 fs-4 fw-light">{{ __('messages.admin_dashboard.total_products') }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Total Invoices Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('invoices.index') }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-danger shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 widget-dash">
                                    <div
                                        class="bg-red-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-file-invoice card-icon text-white"></i>
                                    </div>
                                    <div class="text-end text-white">
                                        <h2 class="fs-1-xxl fw-bolder text-white">{{ formatTotalAmount($total_invoices) }}
                                        </h2>
                                        <h3 class="mb-0 fs-4 fw-light">{{ __('messages.admin_dashboard.total_invoices') }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Paid Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('invoices.index', ['status' => 2]) }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-dark shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 widget-dash">
                                    <div
                                        class="bg-gray-700 widget-icon rounded-10 d-flex align-items-center justify-content-center ">
                                        <i
                                            class="fas fa-clipboard-check card-icon {{ \Illuminate\Support\Facades\Auth::user()->dark_mode ? 'text-black' : 'text-white' }}"></i>
                                    </div>
                                    <div
                                        class="text-end {{ \Illuminate\Support\Facades\Auth::user()->dark_mode ? 'text-black' : 'text-white' }}">
                                        <h2
                                            class="fs-1-xxl fw-bolder {{ \Illuminate\Support\Facades\Auth::user()->dark_mode ? 'text-black' : 'text-white' }}">
                                            {{ formatTotalAmount($paid_invoices) }}</h2>
                                        <h3 class="mb-0 fs-4 fw-light">
                                            {{ __('messages.admin_dashboard.total_paid_invoices') }}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Unapid Widget --}}
                        <div class="col-xxl-3 col-xl-4 col-sm-6 widget">
                            <a href="{{ route('invoices.index', ['status' => 1]) }}" class="mb-xl-8 text-decoration-none">
                                <div
                                    class="bg-primary shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3 widget-dash">
                                    <div
                                        class="bg-cyan-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-exclamation-triangle card-icon text-white"></i>
                                    </div>
                                    <div class="text-end text-white">
                                        <h2 class="fs-1-xxl fw-bolder text-white">{{ formatTotalAmount($unpaid_invoices) }}
                                        </h2>
                                        <h3 class="mb-0 fs-4 fw-light">
                                            {{ __('messages.admin_dashboard.total_unpaid_invoices') }}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="">
                        <div class="card mt-3">
                            <div class="card-body p-5">
                                <div class="card-header border-0 pt-5">
                                    <h3 class="mb-0">{{ __('messages.admin_dashboard.income_overview') }}</h3>
                                    <div class="ms-auto">
                                        <div id="rightData" class="date-picker-space">
                                            <input class="form-control removeFocus" id="time_range">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-lg-6 p-0">
                                    <div class="">
                                        <div id="yearly_income_overview-container" class="pt-2">
                                            <canvas id="yearly_income_chart_canvas" height="200" width="905"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-12 mb-5 mb-xl-0">
                    <div class="card">
                        <div class="card-header pb-0 px-10">
                            <h3 class="mb-0">{{ __('messages.admin_dashboard.payment_overview') }}</h3>
                        </div>
                        <div class="card-body pt-7">
                            <div id="payment-overview-container" class="justify-align-center">
                                <canvas id="payment_overview"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-12 ">
                    <div class="card">
                        <div class="card-header pb-0 px-10">
                            <h3 class="mb-0">{{ __('messages.admin_dashboard.invoice_overview') }}</h3>
                        </div>
                        <div class="card-body pt-7">
                            <div id="invoice-overview-container" class="justify-align-center">
                                <canvas id="invoice_overview"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::hidden('currency', getCurrencySymbol(), ['id' => 'currency']) }}
    {{ Form::hidden('currency_position', currencyPosition(), ['id' => 'currency_position']) }}
@endsection
