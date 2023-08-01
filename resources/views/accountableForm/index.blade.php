<x-app-layout :accountable_form_types_of_user="$accountable_form_types_of_user" :message_count="$message_count">


<div class="text-black">
 

 <h1 class="font-inter  text-3xl text-center my-3">
  Home
 </h1>
 <p class="mx-auto w-10/12 justify-start mb-3">Hi, {{ auth()->user()->name }}.</p>
 <p class="mx-auto w-10/12 justify-start mb-3">This application is developed by the Information and Communications Technology Office to speed up reporting of collections.</p>
 

</div>
</x-app-layout>
