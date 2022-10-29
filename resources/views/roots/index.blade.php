@extends('layout')
 
@section('content')
@php
    $weekdays = [1=>'MON', 2=>'TUE', 3=>'WED', 4=>'THU', 5=>'FRI', 6=>'SAT', 7=>'SUN'];
@endphp
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-none float-md-start">
                <h2>All Locations</h2>
            </div>
            <div class="float-none float-md-end">
                <a class="btn btn-success" href="{{ route('roots.create') }}"> Create New Root</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="mb-0">{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Operational Days</th>
            <th>Frequency</th>
            <th>Gap</th>
            <th>Passenger Capacity</th>
            <th>Min Fare</th>
            <th>Booking Fare</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roots as $root)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ \App\Models\Location::where('id',$root->source)->value('name'); }}</td>
            <td>{{ \App\Models\Location::where('id',$root->destination)->value('name'); }}</td>
            <td>
                @foreach(json_decode($root->operational_days) as $w_day)
                    {{ $weekdays[$w_day] }}
                        @if (!$loop->last)
                            {{ ', ' }}
                        @endif
                @endforeach
            </td>
            <td>{{ $root->frequency }}</td>
            <td>{{ $root->gap }}</td>
            <td>{{ $root->passenger_capacity }}</td>
            <td>{{ $root->min_fare }}</td>
            <td>{{ $root->booking_fare }}</td>
            <td>{{ $root->status == 1 ? "Active" : "Inactive" }}</td>
            <td>
                <form action="{{ route('roots.destroy',$root->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('roots.show',$root->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('roots.edit',$root->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $roots->links() !!}
      
@endsection