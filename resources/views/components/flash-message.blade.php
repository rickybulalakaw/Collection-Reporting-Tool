<div x-data="{show:true}" x-init="setTimeout(()=>show=false,3000)" x-show="show" class=""> 
@if (session()->has('success'))
<!-- <p class="alert alert-success text-center"> -->
<div
  class="mb-4 rounded-lg bg-blue-600 px-6 py-5 text-base text-blue-100 w-1/2 mx-auto "
  role="alert">
  {{ session()->get('success') }}
</div>
@elseif (session()->has('error'))
<div
  class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700"
  role="alert">
  {{ session()->get('error') }}
</div>
@elseif (session()->has('warning'))
<p {{ $attributes->merge(['class' => 'text-sm text-yellow-600 dark:text-red-400']) }}>{{ session()->get('warning') }}</p>
@elseif (session()->has('message'))
<p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ session()->get('message') }}</p>
@endif 
</div>