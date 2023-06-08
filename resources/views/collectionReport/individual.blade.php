<x-app-layout>
 <div class="mx-auto w-8/12">
       
 <h2 class="font-semibold text-center mt-5 mb-5 text-xl text-gray-800 dark:text-gray-200 leading-tight">
  {{ __('Accountable Forms I Used Today') }}
 </h2>
 
 <table class="table-auto w-full border-collapse border-gray-200 dark:border-gray-700  mb-5 px-6 py-3  ">
  <thead class=" dark:bg-gray-800  ">
   <tr class="border-b bg-blue-500 border-gray-200 dark:border-gray-700">
    <th class="px-6 py-3">Accountable Form Type</th>
    <th class="px-6 py-3">Accountable Form Number</th>
    <th class="px-6 py-3">Used?</th>
    <th class="px-6 py-3">Payor </th>
    <th class="px-6 py-3">Amount</th>
   </tr>
  </thead>

  <tbody>
   <tr class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> AF 51 </td>
    <td class="px-6 py-3"> 1001</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> George Washington</td>
    <td class="text-right px-6 py-3 "> 1,500</td>
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> AF 51 </td>
    <td class="px-6 py-3"> 1001</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> George Del Pilar</td>
    <td class="text-right px-6 py-3"> 1,550</td>
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> Cash Ticket </td>
    <td class="px-6 py-3"> 101</td>
    <td class="px-6 py-3"> Yes</td>
    <td class="px-6 py-3"> Juan Tamad</td>
    <td class="text-right px-6 py-3"> 10</td>
   </tr>
   <tr  class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3"> Cash Ticket </td>
    <td class="px-6 py-3"> 102</td>
    <td class="px-6 py-3"> No</td>
    <td class="px-6 py-3"> </td>
    <td class="text-right px-6 py-3"> 0</td>
   </tr>
   <tr class="border-b border-gray-200 dark:border-gray-700">
    <td class="px-6 py-3" colspan="4"> Subtotal </td>
    <td class="text-right px-6 py-3"> 3,060</td>
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