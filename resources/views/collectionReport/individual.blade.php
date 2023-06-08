
<x-app-layout>
 <div class="mx-auto w-8/12">
       
 <h2 class="font-semibold text-center mt-5 mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
  {{ __('Accountable Forms I Used Today') }}
 </h2>
 
 <table class="table-auto w-full border-collapse border-gray-200 dark:border-gray-700  mb-5 px-6 py-3  ">
  <thead class=" dark:bg-gray-800  ">
   <tr class="border-b bg-gray-400 text-white border-gray-200 dark:border-gray-700 dark:bg-gray-900">
    <th class="px-6 py-3">Accountable Form Type</th>
    <th class="px-6 py-3">Accountable Form Number</th>
    <th class="px-6 py-3">Used?</th>
    <th class="px-6 py-3">Payor </th>
    <th class="px-6 py-3">Amount</th>
    <th class="px-6 py-3">Review Functions</th>
   </tr>
  </thead>

  <tbody>
   <tr class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> AF 51 </td>
    <td class="px-6 py-3"> 1001</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> George Washington</td>
    <td class="text-right px-6 py-3 "> 1,500</td>
    @can('collector')
    <td class="px-6 py-3">
     <a href="#" class="text-blue-500">
      <i class="fas fa-edit"></i>
      Edit
      </a>
      <a href="#" class="text-red-500">
       <i class="fas fa-trash"></i>
       Delete
       </a>
       </td>
    @endcan
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> AF 51 </td>
    <td class="px-6 py-3"> 1001</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> George Del Pilar</td>
    <td class="text-right px-6 py-3"> 1,550</td>
    @can('collector')
    <td class="px-6 py-3">
     <a href="#" class="text-blue-500">
      <i class="fas fa-edit"></i>
      Edit
      </a>
      <a href="#" class="text-red-500">
       <i class="fas fa-trash"></i>
       Delete
      </a>
     </td>
     @endcan
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> Cash Ticket </td>
    <td class="px-6 py-3"> 101</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> Juan Tamad</td>
    <td class="text-right px-6 py-3"> 10</td>
    <td class="px-6 py-3  text-center">
      @can('collector')
      <x-button class="bg-green-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
       <a href="#" class=" ">
        <x-fas class="fas fa-edit"></x-fas>
       </a>
      </x-button>

      <x-button class="bg-red-400 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
       <a href="#">
        <x-fas class="fas fa-trash"></x-fas>
        
       </a>
      </x-button>
       
      @endcan

      <x-button class=" bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  ">
       <a href="#" class="  ">
        <x-fas class="fas fa-eye text-white" />
       </a>
      </x-button>
     </td>
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> Cash Ticket </td>
    <td class="px-6 py-3"> 102</td>
    <td class="px-6 py-3"> No</td>
    <td class="px-6 py-3"> </td>
    <td class="text-right px-6 py-3"> 0</td>
    @can('collector')
    <td class="px-6 py-3">
     <a href="#" class="text-blue-500">
      <i class="fas fa-edit"></i>
      
      </a>
      <a href="#" class="text-red-500">
       <i class="fas fa-trash"></i>
      </a>
     </td>
     @endcan

    <td class="px-6 py-3 text-center">
     <x-button class=" bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  ">
     <a href="#" class="text-blue-500   ">
      <x-fas class="fas fa-eye text-white" />
      
      </a>
     </x-button>
     </td>
   </tr>
   <tr class="border-b bg-gray-200 font-bold border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3" colspan="4"> Subtotal </td>
    @if(auth()->user()->function == 2)
    <td class="text-right px-6 py-3"> 3,060</td>
    <td class="text-right px-6 py-3"></td>
    @else
    <td class="text-right px-6 py-3"> 3,060</td>
    @endif
   </tr>
  </tbody>

 </table>

 @can('collector')
 <form action="" method="post">
  <x-button class="mt-3 p-3">
   {{ __('Submit Individual Report')  }}
  </x-button>
 </form>
 @endcan

 </div>

</x-app-layout>