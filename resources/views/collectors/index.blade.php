@extends('layouts.admin')

@section('content')
<div class="container">
 <h1 class="text-center ">{{ $page_title }}

 </h1>
 <table class="table table-striped">
  <thead>
   <tr>
    <th class="text-center">Name of Collector</th>
    <th class="text-center">Amount Submitted</th>
    <th class="text-center">Status of Submission</th>
    <!-- <th class="text-center">Supervisor</th> -->
    <th class="text-center">Open</th>
   </tr>
  </thead>
  <tbody>
   @foreach($collectors2 as $collector)

   <tr>
    <td>{{ $collector->name }} {{ $collector->last_name }}</td>
    <td class="text-right">{{ number_format($collector->total, 2) }}</td>
    <td class="text-center">No registered AF</td>
    <td><a href="" class="btn btn-primary btn-block">Open</a></td>
   </tr>

   @endforeach
  </tbody>
 </table>
</div>
@endsection