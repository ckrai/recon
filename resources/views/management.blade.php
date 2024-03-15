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
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Management</span>
             </h3>
          <!--   <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
                <a href="javascript:void(0)"   data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                 <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                    </svg>
                </span>
             </div> -->
        </div>
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
                            <th class="min-w-150px">Name</th>
                            <th class="min-w-140px">Email</th>
                            <th class="min-w-120px">Phone</th>
                            <th class="min-w-120px">Login Access</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <!-- <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input widget-9-check" type="checkbox" value="1" />
                                </div>
                            </td> -->
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$user->name}}</a>
                                        <!-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> -->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{$user->email}}</a>
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

                         {{ $users->links() }}
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





<div class="col-xxl-4">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">New Management Team</span>
             </h3>
         </div>
     
     <div class="card-body py-3">
           <form method="POST" action="{{ url('management') }}">
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
</div>

 </div>
</div>
@endsection