@extends('layouts.admin')

@section('content')
<div class="container">
@if (Session::has('error') )
 <p class="alert alert-danger">
  {{ $error }} 
 </p> 
 @endif
 <h1 class="text-center">Register Accountable Forms</h1>
 <form action="{{ route('create-accountable-form') }}" method="post">
  @csrf

  <div class="form-group">
   <label for="accountable_form_type_id">Accountable Form Type</label>
   <select name="accountable_form_type_id" id="accountable_form_type_id" class="form-control" value="{{ old('accountable_form_type_id') }}">
    <option value="">Select Accountable Form Type</option>
    @foreach($accountableFormTypes as $aft) 
    <option value="{{ $aft->id }}">{{ $aft->name }}</option>

    @endforeach
   </select>
   @error('accountable_form_type_id')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="user_id">Collector</label>
   <select name="user_id" id="user_id" class="form-control" id="" value="{{ old('user_id') }}">
    <option value="">Select Collector</option>
    @foreach($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }} </option> 
    @endforeach
   </select>
   @error('user_id')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="start_number">Start Number</label>
   <input type="number" name="start_number" id="start_number" class="form-control" value="{{ old('start_number') }}">
   @error('start_number')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
  </div>

  <div class="form-group">
   <label for="end_number">End Number</label>
   <input type="number" name="end_number" id="end_number" class="form-control" value="{{ old('end_number') }}">
   @error('end_number')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
   @enderror
  </div>

  <button class="btn btn-primary btn-lg">Assign to Collector</button>
 </form>
</div>
@endsection