@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content">

        <!--begin::Form-->
        {!! Form::open(['route' => 'card-category.store','method' => 'post','class' => 'form-horizontal category-store','role' => 'form','files' => true]) !!}
        <div class="card-body">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cname">اسم البطاقة<span class="text-danger">*</span></label>
                        <input id="cname" type="text" name="cname" class="form-control" placeholder="اسم الفئة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>نوع البطاقة<span class="text-danger">*</span></label>
                        <select id="periodType" name="periodType" class="form-control" onclick="changePeriodType()">
                            <option value="" disabled selected>اختر نوع البطاقة</option>
                            <option value="H">بالساعة</option>
                            <option value="D">يومي</option>
                            <option value="W">أسبوعي</option>
                            <option value="M">شهري</option>
                        </select>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

                <div class="col-md-4" id="inputFieldWrapper" style="display: none;">
                    <div class="form-group">
                        <label id="periodLabel">فترة البطاقة<span class="text-danger">*</span></label>
                        <input id="period" type="number" min="0" name="period" class="form-control"
                               placeholder=""
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>سعر الفئة<span class="text-danger">*</span></label>
                        <input id="price" type="number" min="0" name="price" class="form-control"
                               placeholder="سعر البطاقة"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر صورة البطاقة<span class="text-danger">*</span></label>
                        <input id="photo" type="file" name="photo" class="form-control"
                               placeholder=" صورة الغلاف"
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <input id="network" type="hidden" name="network" value="{{$id}}" class="form-control"
                   maxlength="500"/>

            <div class="card-footer text-right modal-footer">
            <button data-close-modal="#OpenModal" data-form-class="category-store" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
        </div>

        {!! Form::close() !!}
    <!--end::Form-->
    </div>
    </div>
@endsection
