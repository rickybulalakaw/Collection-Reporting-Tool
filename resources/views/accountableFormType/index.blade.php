@extends('layouts.admin')

@section('content')

<div class="container">
 <h1 class="text-center">List of Accountable Forms</h1>
 <table class="table table-striped">
  <thead>
   <tr>
    <th class="text-center" style="width:15%">Form Number</th>
    <th class="text-center"  style="width:45%">Accountable Form</th>
    <th class="text-center"  style="width:25%">Default Value (in PhP)</th>
    <th class="text-center"  style="width:15%">Edit</th>
   </tr>
  </thead>
  <tbody>
   @foreach($accountableFormTypes as $aft) 
   <tr>
    <td class="text-center">{{ $aft->number }}</td>
    <td>{{ $aft->name }} </td>
    <td class="text-center">{{ $aft->default_amount }} </td>
    <td><a class="btn btn-primary btn-block" href="">Edit</a></td>
   </tr>
   @endforeach
  </tbody>
 </table>
</div>

@endsection