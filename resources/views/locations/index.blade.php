@extends('layout')
 
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-none float-md-start">
                <h2>All Locations</h2>
            </div>
            <div class="float-none float-md-end">
                <a class="btn btn-success" href="{{ route('locations.create') }}"> Create New Location</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success ">
            <p class="mb-0">{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($locations as $location)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $location->name }}</td>
            <td>{{ $location->code }}</td>
            <td>{{ $location->status == 1 ? "Active" : "Inactive" }}</td>
            <td>
                <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('locations.show',$location->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('locations.edit',$location->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $locations->links() !!}
      
@endsection