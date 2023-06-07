<div x-data="{show:true}" x-init="setTimeout(()=>show=false,3000)" x-show="show" class=""> 
@if (session()->has('success'))
<!-- <p class="alert alert-success text-center"> -->
<p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-green  ']) }}>{{ session()->get('success') }}</p>
@elseif (session()->has('error'))
<p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ session()->get('error') }}</p>
@elseif (session()->has('warning'))
<p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ session()->get('warning') }}</p>
@elseif (session()->has('message'))
<p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ session()->get('message') }}</p>
@endif 
</div>