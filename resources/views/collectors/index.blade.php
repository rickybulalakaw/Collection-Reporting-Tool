<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user" :message_count="$message_count">
<div class="container">
 <h1 class="text-center font-bold text-2xl mb-5 ">{{ $page_title }}

 </h1>
 <div class="mx-auto w-10/12">
   <table class="table-auto w-full">
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
      <td class="justify-center text-center "><a href="" class=" "><x-fas class=" text-center fas fa-eye text-slate-400 hover:text-red-600"></x-fas></a></td>
     </tr>
  
     @endforeach
    </tbody>
   </table>

 </div>
</div>
</x-app-layout>