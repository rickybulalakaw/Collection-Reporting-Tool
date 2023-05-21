<div class="col-lg-4 offset-lg-4"> 
@if (session()->has('success'))
<p class="alert alert-success text-center">
 {{ session()->get('success') }}
</p>
@elseif (session()->has('error'))
<p class="alert alert-danger text-center">
 {{ session()->get('error') }}
</p>
@elseif (session()->has('warning'))
<p class="alert alert-warning text-center">
 {{ session()->get('warning') }}
</p>
@elseif (session()->has('message'))
<p class="alert alert-info text-center">
 {{ session()->get('message') }}
</p>
@endif 
</div>