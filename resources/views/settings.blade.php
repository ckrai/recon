@extends('layouts.app')

@section('content')
<div class="container" id="kt_content_container">

         <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
<div class="row g-5 g-xl-8">
 





<div class="col-xxl-12">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Add Email Ids To get daily email</span>
             </h3>
         </div>
     
     <div class="card-body py-3">
           <form method="POST" action="{{ url('settings') }}">
            @csrf

            

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Add emails, comma seperated') }}" />
                <textarea placeholder="abc@mail.com,pqr@mail.com"  name="emails"  class="block mt-1 w-full form-control" required>{{$data->emails}}</textarea>
                 
            </div>
           

           
 

            <div class="flex items-center justify-end mt-4">
                 
             <button type="submit" class="btn btn-primary" style="width:100%"> Submit </button>
                
            </div>
        </form>
    </div>
    </div>

     </div>    
</div>



 
 
 </div>
</div>
@endsection