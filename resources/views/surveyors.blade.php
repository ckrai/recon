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
<div class="col-xxl-8">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <form>
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Surveyors</span>
             </h3>

            <div class="input-group mb-3">
                
                  <input type="text" class="form-control" value="{{isset($_REQUEST['q'])?$_REQUEST['q']:''}}" name="q" placeholder="Search by Serveyors" />
                  <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Search</button>
                    <a class="btn btn-danger" href="{{url('surveyors')}}"  >Reset</a>
                  </div>
             
            </div>
           
        </div>
         </form>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                           <!--  <th class="w-25px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
                                </div>
                            </th> -->
                            <th class="min-w-90px">ID No.</th>
                            <th class="min-w-150px">Name</th>
                            <th class="min-w-100px">No. of Completed Surveys</th>
                            <th class="min-w-120px">Phone</th>
                            <th class="min-w-120px">Login Access</th>
                            <th class="min-w-50px text-end">Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <span >{{$user->id}}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$user->name}}</a>
                                        <!-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> -->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{$user->survey_count}}</a>
                                <!-- <span class="text-muted fw-bold text-muted d-block fs-7">Web, UI/UX Design</span> -->
                            </td>
                            <td class="text-end">
                                <div class="d-flex flex-column w-100 me-2">
                                    <div class="d-flex flex-stack mb-2">
                                        <span class="text-muted me-2 fs-7 fw-bold">{{$user->mobile_number}}</span>
                                    </div>
                                    <div class="progress h-6px w-100">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>

                          <td class="text-end">
                                <div class="d-flex flex-column w-100 me-2">
                                    @if($user->is_login=='true')
                                     <a href="{{url('login_access/false/'.$user->id)}}"  onclick="return confirm('Are you sure?');"  type="button" class="btn btn-primary">ON</a>
                                    @else
                                     <a href="{{url('login_access/true/'.$user->id)}}" onclick="return confirm('Are you sure?');"   type="button" class="btn btn-danger">OFF</a>
                                    @endif

                                     
                                     
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end flex-shrink-0">
                                     <i class="fa fa-eye" aria-hidden="true"></i>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>


                <!--end::Table-->
            
                        <div class="paginations">
{{ $users->withQueryString()->links() }}

                          <style type="text/css">
                             .paginations img, .paginations svg {
                                    width: 10px;
                                }

                               .paginations .shadow-sm {
                                    padding: 7px 0px;
                                }
                               .paginations  .flex.justify-between.flex-1.sm\:hidden{
                                    display: none;
                                }
                                .paginations {
                                    padding-bottom: 20px;
                                }
                                                         </style>
                        </div>
             </div>
            
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 9-->
</div>




@if(\Auth::user()->role=='admin') 
<div class="col-xxl-4">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">New Surveyors</span>
             </h3>
         </div>
     
     <div class="card-body py-3">
           <form method="POST" action="{{ url('surveyors') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <input id="name" class="block mt-1 w-full form-control" type="text" name="name" value="{{old('name')}}" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <input id="email" class="block mt-1 w-full form-control" type="email" name="email" value="{{old('email')}}" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Mobile number') }}" />
                <input id="mobile_number" class="block mt-1 w-full form-control" type="number" name="mobile_number" value="{{old('mobile_number')}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

           
 

            <div class="flex items-center justify-end mt-4">
                 
             <button type="submit" class="btn btn-primary" style="width:100%"> Submit </button>
                
            </div>
        </form>
    </div>
    </div>

     </div>  
     @endif  
</div>



 
 
 </div>
</div>
@endsection