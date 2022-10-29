@extends('layout')
   
@section('content')

<style>
    .weekDays-selector input {
      display: none!important;
    }
    .weekDays-selector input[type=checkbox] + label {
      display: inline-block;
      border-radius: 6px;
      background: #dddddd;
      height: 40px;
      width: 30px;
      margin-right: 3px;
      line-height: 40px;
      text-align: center;
      cursor: pointer;
    }
    
    .weekDays-selector input[type=checkbox]:checked + label {
      background: #2AD705;
      color: #ffffff;
    }
</style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Flight</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roots.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('roots.update',$root->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{--
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $location->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>
                    <input type="text" name="code" value="{{ $location->code }}" class="form-control" placeholder="Code">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Staus:</strong>
                    <select class="form-select" name="status" aria-label="Default select example">
                      <option >Status of location</option>
                      <option value="1" {{ $location->status == 1 ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ $location->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        --}}
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Source:</strong>
                <select class="form-select" id="source" name="source" aria-label="Default select example">
                  <option selected>Select Origin</option>
                  @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $root->source ? 'selected' : '' }}>{{ $location->name }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Destination:</strong>
                <select class="form-select" id="destination" name="destination" aria-label="Default select example1">
                  <option selected>Select Destination</option>
                  @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $root->destination ? 'selected' : '' }}>{{ $location->name }}</option>
                  @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Select Days:</strong>
                <div class="weekDays-selector">
                  <input type="checkbox" id="weekday-mon" name="operational_days[]" value="1" class="weekday" {{ (in_array('1', json_decode($root->operational_days))) ? 'checked' : ''}} />
                  <label for="weekday-mon">M</label>
                  <input type="checkbox" id="weekday-tue" name="operational_days[]" value="2" class="weekday" {{ (in_array('2', json_decode($root->operational_days)))   ? 'checked' : ''}} />
                  <label for="weekday-tue">T</label>
                  <input type="checkbox" id="weekday-wed" name="operational_days[]" value="3" class="weekday" {{ (in_array('3', json_decode($root->operational_days)))   ? 'checked' : ''}} />
                  <label for="weekday-wed">W</label>
                  <input type="checkbox" id="weekday-thu" name="operational_days[]" value="4" class="weekday" {{ (in_array('4', json_decode($root->operational_days)))   ? 'checked' : '' }} />
                  <label for="weekday-thu">T</label>
                  <input type="checkbox" id="weekday-fri" name="operational_days[]" value="5" class="weekday" {{ (in_array('5', json_decode($root->operational_days)))   ? 'checked' : '' }} />
                  <label for="weekday-fri">F</label>
                  <input type="checkbox" id="weekday-sat" name="operational_days[]" value="6" class="weekday" {{ (in_array('6', json_decode($root->operational_days)))   ? 'checked' : '' }} />
                  <label for="weekday-sat">S</label>
                  <input type="checkbox" id="weekday-sun" name="operational_days[]" value="7" class="weekday" {{ (in_array('7', json_decode($root->operational_days)))   ? 'checked' : '' }} />
                  <label for="weekday-sun">S</label>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>No. of flights on operating days</strong>
                <input type="number" id="frequency" name="frequency" class="form-control" placeholder="Flight frequency"  step="1" min="3" max="5" 
                value="{{ $root->frequency }}" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Gap between 2 flights:</strong>
                <input type="number" id="gap" name="gap" class="form-control" placeholder="Gap between 2 flights"  step="1" min="2" max="4" 
                value="{{ $root->gap }}" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>No. of seats:</strong>
                <input type="number" name="passenger_capacity" class="form-control" max="180" value="180" placeholder="No of seats available for booking" 
                value="{{ $root->passenger_capacity }}" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Minimum fare</strong>
                <input type="number" name="min_fare" class="form-control" placeholder="Minimum amount for booking" value="{{ $root->min_fare }}" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Booking fare</strong>
                <input type="number" name="booking_fare" class="form-control" placeholder="Amount for booking" value="{{ $root->booking_fare }}" required>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Staus:</strong>
                <select class="form-select" name="status" aria-label="Default select example">
                  <option >Status of location</option>
                  <option value="1" {{ $root->status == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $root->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
    </form>
@endsection