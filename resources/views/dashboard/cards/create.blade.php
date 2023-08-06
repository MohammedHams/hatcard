@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content">

        <!--begin::Form-->
        {!! Form::open(['route' => 'card.store','method' => 'post','class' => 'form-horizontal category-store','role' => 'form','files' => true]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر ملف البطاقات<span class="text-danger">*</span> (CSV.)</label>
                        <input id="csv" type="file" name="csv" class="form-control"
                               placeholder=" ملف csv"
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>

                </div>
            </div>
            <p  class="text-warning" style="margin-top: 50px;">في حال واجهتك أي مشكلة في رفع البطاقات تواصل معنا</p>

            <input id="category" type="hidden" name="category" value="{{$id}}" class="form-control"
                   maxlength="500"/>
            <input id="network" type="hidden" name="network" value="{{$network_id}}" class="form-control"
                   maxlength="500"/>
            <div class="card-footer text-right modal-footer">

                <button data-close-modal="#OpenModal" data-form-class="category-store" type="button" class="btn btn-success btn-save mr-2">
                        <span>حفظ</span>
                    </button>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="20px" height="30px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="svg-hide" style="display: none">
      <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
          s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
          c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                    <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
          C22.32,8.481,24.301,9.057,26.013,10.047z">
                        <animateTransform attributeType="xml"
                                          attributeName="transform"
                                          type="rotate"
                                          from="0 20 20"
                                          to="360 20 20"
                                          dur="0.5s"
                                          repeatCount="indefinite"/>
                    </path>
    </svg>


        {!! Form::close() !!}
    <!--end::Form-->
    </div>
    </div>
    </div>
@endsection
@section('scripts')
   <script>$(function(){
           $("button.load-button").on("click",function(){
               var btndom = $(this);
               btndom.addClass("loading-start");
               btndom.attr("disabled",true);

               setTimeout(function(){
                   btndom.removeClass("loading-start").removeAttr("disabled");
               },5000);
           });
       });</script>
@endsection
