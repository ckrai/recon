@extends('layouts.app')
@section('content')
<div class="container" id="kt_content_container">
    <!--begin::Row-->
    <!-- <div class="row g-5 g-xl-8"> -->
    <div class="row">
        @foreach($surveys as $s)
        <h2 class="card-title align-items-start flex-column">{{$s->title}} - 2021</h2>
        <br>
        <br>
        <h3 class="card-title align-items-start flex-column" >Survey status as of {{date('d M Y')}}</h3>
    <br>
        <br>
    <!-- <div class="col-xxl-4"> -->
    <div class="col-6 col-sm-4 col-md-3 col-lg-4">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5" style="display:block;">
           <span style="text-align: center;display: block;font-size: 40px;    color: #7239ea;">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $s->survey_count) }}</span>
           <h3 style="text-align:center;">Total Completed Surveys</h3>
        <br>
        <br>
    </div>
    </div>
    </div>

       <!-- <div class="col-xxl-4"> -->
    <div class="col-6 col-sm-4 col-md-3 col-lg-4">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5" style="display:block;">
           <span style="text-align: center;display: block;font-size: 40px;    color: #7239ea;">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $s->goal) }}</span>
           <h3 style="text-align:center;">Total goal</h3>
        <br>
        <br>
    </div>
    </div>
    </div>


       <!-- <div class="col-xxl-4"> -->
    <div class="col-6 col-sm-4 col-md-3 col-lg-4">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5" style="display:block;">
           <span style="text-align: center;display: block;font-size: 40px;    color: #7239ea;">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $s->goal_achived) }}%</span>
           <h3 style="text-align:center;">Percentage(%) of Survey</h3>
        <br>
        <br>
    </div>
    </div>
    </div>

 




<div class="card-body py-3" style="background: white;
    margin: 10px;
    border-radius: 5px;
    padding: 20px;">
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
                            <th class="min-w-100px">Micro</th>
                            <th class="min-w-120px">Small</th>
                            <th class="min-w-120px">Total</th>
                            <th class="min-w-50px">Percentage</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>

                        <?php
                        $small=0;
                        $micro=0;
                        $total=0;
                        $percentage=0;
                        ?>
                        @foreach ($banks as $bank)
                        <?php
                        $small=$small+ $bank->small;
                        $micro=$micro+ $bank->micro;
                        $total=$total+ $bank->total;
                        $percentage=$percentage+ $bank->percentage;
                        ?>
                        <tr>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$bank->name}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $bank->micro) }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $bank->small)}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $bank->total)}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$bank->percentage}}%</a>
                                    </div>
                                </div>
                            </td>
                        
                         
                            
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->


                    <tfoot style="background: #7239ea;">
                        <tr class="fw-bolder text-muted">
                             <th class="min-w-150px"></th>
                            <th class="min-w-100px" style="color:white;font-size: 16px">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $micro)}}</th>
                            <th class="min-w-120px" style="color:white;font-size: 16px">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $small)}}</th>
                            <th class="min-w-120px" style="color:white;font-size: 16px">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total)  }}</th>
                            <th class="min-w-50px" style="color:white;font-size: 16px">{{round($percentage)}}%</th>
                        </tr>
                    </tfoot>


                </table>


                <!--end::Table-->
             
             </div>
</div>



       
 
     @endforeach
</div>




   @endsection
                     