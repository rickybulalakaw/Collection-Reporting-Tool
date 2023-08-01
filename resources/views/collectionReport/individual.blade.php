<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user" :message_count="$message_count">
 <div class="mx-auto w-10/12">
       
 <h2 class="font-bold text-center mt-5 mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
  Accountable Forms Used Today
 </h2>
 
 <table class="table-auto w-full border-collapse border-gray-200 dark:border-gray-700  mb-5 px-6 py-3  ">
  <thead >

   <tr class="border-b bg-gray-400 text-white border-gray-200 dark:border-gray-700 dark:bg-gray-900">
    <th class="px-6 py-3">Accountable Form Type</th>
    <th class="px-6 py-3">Accountable Form Number</th>
    <th class="px-6 py-3">Use Status</th>
    <th class="px-6 py-3">Payor </th>
    <th class="px-6 py-3">Amount</th>
    <th class="px-6 py-3">Review Functions</th>
   </tr>
  </thead>

  <tbody>
  @foreach($used_accountable_forms as $af)
   <tr class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> {{ $af->form_type }} </td>
    <td class="px-6 py-3 text-right "> {{ $af->form_number }}</td>
    <td class="px-6 py-3 text-center @if($af->use_status == $use_status_cancelled) text-red-500 @endif"> @if($af->use_status == $use_status_cancelled) Cancelled @else Used @endif </td>
    <td class="px-6 py-3"> {{ $af->payor  }} </td>
    <td class="text-right px-6 py-3 "> {{ number_format($af->total_amount, 2) }} </td>
    @can('collector')
    <td class="px-6 py-3 text-center">

          <!-- View  -->
          <a href="#" class=" ">
               <x-fas class="fas fa-eye text-slate-300 hover:text-amber-700 "></x-fas>
          </a>

          <!-- Edit  -->
          <a href="{{ route('add-accountable-form-item', $af->form_id) }} " class=" ">
               <x-fas class="fas fa-edit text-slate-300 hover:text-cyan-500 "></x-fas>
          </a>
          <!-- Delete  -->
          <a href="#" class=" ">
          <x-fas class="fas fa-trash text-slate-300 hover:text-red-700 "></x-fas>
          </a>

     </td>
    @endcan
   </tr>

   @endforeach
   <tr class="border-b bg-gray-200 font-bold border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3" colspan="4"> Subtotal </td>
    
    <td class="text-right px-6 py-3">{{ number_format($used_accountable_forms->sum('total_amount'), 2) }} </td>
    <td class="text-right px-6 py-3"></td>
    
   </tr>
  </tbody>

 </table>

 

 @can('collector')
 <form action="{{ route('save-message') }}" method="post">
     @csrf
     <input type="hidden" name="recipient_user_id" value="{{ auth()->user()->supervisor_id }}">
     <input type="hidden" name="subject" value="Individual RCD for {{ date('Y-m-d') }}">
     <input type="hidden" name="entity" value="">
     <input type="hidden" name="entity_id" value="">
     <input type="hidden" name="message_id" value="">
     
     <textarea name="message" id="" cols="30" rows="10" class="ckeditor">
          I am submitting this individual RCD for your review. Thank you. Please view  <a href="{{ route('view-individual-report', [auth()->user()->id, date('Y-m-d')]) }} ">here</a>
     </textarea>

     
  <x-button class="mt-3 p-3">
   {{ __('Submit Individual Report')  }}
  </x-button>
 </form>
 @endcan

 </div>
 <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
</x-app-layout>