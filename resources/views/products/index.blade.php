@extends('layouts.app')
@section('title')
    {{ __('messages.products') }}
@endsection

<style>
    .image.image-circle,
    .image.image-circle>img {
        border-radius: 50%;
        height: 55px;
        width: 50px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column ">
            @include('flash::message')
            <livewire:product-table />
        </div>
    </div>
    {{ Form::hidden('currency', getCurrencySymbol(), ['id' => 'currency']) }}
@endsection
