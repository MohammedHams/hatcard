@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content">
        <div class="card-header">
            <h3 class="card-title">
                اضافة شبكة
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        {!! Form::model($categoryCard, ['route' => ['card-category.update', $categoryCard->id], 'method' => 'put', 'class' => 'form-horizontal category-edit', 'role' => 'form', 'files' => true]) !!}
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>اسم الفئة<span class="text-danger">*</span></label>
                        <input id="cname" type="text" value="{{$categoryCard->cname ? :''}}" name="cname" class="form-control" placeholder="اسم الفئة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>سعر الفئة<span class="text-danger">*</span></label>
                        <input id="price" type="number" value="{{$categoryCard->price ? :''}}"  name="price" class="form-control" placeholder="سعر الفئة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>فترة البطاقة<span class="text-danger">*</span></label>
                        <input id="period" type="number" value="{{$categoryCard->period ? :''}}"  name="period" class="form-control" placeholder="فترة البطاقة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر صورة البطاقة<span class="text-danger">*</span></label>
                        <input id="photo" type="file" name="photo" class="form-control" placeholder=" صورة الغلاف" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <input id="network" type="hidden" name="network" value="{{$categoryCard->network }}" class="form-control"
                   maxlength="500"/>

            <div class="card-footer text-right modal-footer">
                <button data-close-modal="#OpenModal" data-form-class="category-edit" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
            </div>

        {!! Form::close() !!}
        <!--end::Form-->
        </div>
    </div>
@endsection

