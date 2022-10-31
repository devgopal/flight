@extends('layout')
 
@section('content')
@php
    $weekdays = [1=>'MON', 2=>'TUE', 3=>'WED', 4=>'THU', 5=>'FRI', 6=>'SAT', 7=>'SUN'];
    $gap = 0;
@endphp

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-none float-md-start">
                <h2>Flights</h2>
            </div>
            <!--<div class="float-none float-md-end">-->
            <!--    <a class="btn btn-success" href="{{ route('roots.create') }}"> Create New Root</a>-->
            <!--</div>-->
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="mb-0">{{ $message }}</p>
        </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
            <th>Source</th>
            <th>Destination</th>
            <th>Day</th>
            <th>Departure Time</th>
            <th>Seats Available</th>
            <th>Min Fare</th>
            <th>Booking Fare</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($flights as $flight)
            @foreach(json_decode($flight->operational_days) as $w_day)
                @php 
                    $gap = 0; 
                @endphp
                
                @for( $i=0; $i<= $flight->frequency; $i++ )
                    @php
                        $gap = $gap+$flight->gap;
                    @endphp    
                    
                    <tr>
                        <td>{{ \App\Models\Location::where('id',$flight->source)->value('name'); }}</td>
                        <td>{{ \App\Models\Location::where('id',$flight->destination)->value('name'); }}</td>
                        <td>{{ $weekdays[$w_day] }}</td>
                        
                        <td>{{ $gap.".00" }}</td>
                        <td>{{ $flight->passenger_capacity }}</td>
                        <td>{{ $flight->min_fare }}</td>
                        <td>{{ $flight->booking_fare }}</td>
    
                        <td>
                            <form action="{{ route('roots.destroy',$flight->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('roots.show',$flight->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('roots.show',$flight->id) }}">Book</a>
                                {{--
                                    <a class="btn btn-primary" href="{{ route('roots.edit',$root->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                --}}    
                            </form>
                        </td>
                    </tr>
                @endfor    
            @endforeach
        @endforeach
    </table>
    
    {!! $flights->links() !!}


@endsection