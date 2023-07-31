@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content">

        <!--begin::Form-->
        {!! Form::open(['route' => 'card.store','method' => 'post','class' => 'form-horizontal category-store','role' => 'form','files' => true]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر ملف البطاقات<span class="text-danger">*</span></label>
                        <input id="csv" type="file" name="csv" class="form-control"
                               placeholder=" ملف csv"
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <input id="category" type="hidden" name="category" value="{{$id}}" class="form-control"
                   maxlength="500"/>
            <input id="network" type="hidden" name="network" value="{{$network_id}}" class="form-control"
                   maxlength="500"/>
            <div class="card-footer text-right modal-footer">
            <button data-close-modal="#OpenModal" data-form-class="category-store" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
        </div>

        {!! Form::close() !!}
    <!--end::Form-->
    </div>
    </div>
@endsection
