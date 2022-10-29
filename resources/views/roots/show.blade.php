@extends('layout')
  
@section('content')
@php
    $weekdays = [1=>'MON', 2=>'TUE', 3=>'WED', 4=>'THU', 5=>'FRI', 6=>'SAT', 7=>'SUN'];
@endphp
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-none float-md-start">
                <h2>Flight Details</h2>
            </div>
            <div class="float-none float-md-end">
                <a class="btn btn-primary" href="{{ route('roots.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Source:</strong>
                {{ \App\Models\Location::where('id',$root->source)->value('name'); }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Destination:</strong>
                {{ \App\Models\Location::where('id',$root->destination)->value('name'); }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Operational Days:</strong>
                @foreach(json_decode($root->operational_days) as $w_day)
                    {{ $weekdays[$w_day] }}
                        @if (!$loop->last)
                            {{ ', ' }}
                        @endif
                @endforeach
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Frequency:</strong>
                {{ $root->frequency }}
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Gap:</strong>
                {{ $root->gap }}
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Passenger Capacity:</strong>
                {{ $root->passenger_capacity }}
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Min Fare:</strong>
                {{ $root->min_fare }}
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Booking Fare:</strong>
                {{ $root->booking_fare }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $root->status == 0 ? "Inactive" : "Active" }}
            </div>
        </div>
    </div>
@endsection