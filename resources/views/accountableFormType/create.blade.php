@extends('layouts.admin')

@section('content')
<div class="container">

<h2 class="text-center">Create Accountable Form Type</h2>

 <form action="{{ route('create-accountable-form-type')}}" method="post">
 @csrf

 <div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
  @error('name')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>

 <div class="form-group">
  <label for="number">Number (as designated by BIR)</label>
  <input type="text" name="number" id="number" class="form-control" value="{{ old('number') }}">
  @error('number')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror

 </div>

 <div class="form-group">
  <label for="default_amount">Default Amount</label>
  <input type="number" name="default_amount" id="default_amount" class="form-control" value="{{ old('default_amount') }}">
  @error('default_amount')
   <div class="text-danger mt-2 text-sm">
       {{ $message }}
   </div>
  @enderror
 </div>

 <button type="submit" class="btn btn-primary">Save</button>

 </form>
</div>

@endsection