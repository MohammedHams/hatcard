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
        {!! Form::open() !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label> الإسم الاول<span class="text-danger">*</span></label>
                        <input id="first_name" type="text" name="p_first_name" class="form-control"
                               placeholder="الإسم الاول"
                               maxlength="500" readonly/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الاب<span class="text-danger">*</span></label>
                        <input id="second_name" type="text" name="p_second_name" class="form-control"
                               placeholder="اسم الاب"
                               maxlength="500" readonly/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الجد<span class="text-danger">*</span></label>
                        <input id="third_name" type="text" name="p_third_name" class="form-control"
                               placeholder="اسم الجد"
                               maxlength="500" readonly/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم العائله<span class="text-danger">*</span></label>
                        <input id="last_name" type="text" name="p_last_name" class="form-control"
                               placeholder="اسم العائله"
                               maxlength="500" readonly/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>تاريخ الميلاد<span class="text-danger">*</span></label>
                        <input type="date" id="birth_date" name="p_birth_date" class="form-control" maxlength="500" readonly/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>الجنس<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>المهنة<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>مكان العمل<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>مقدمة الجوال<span class="text-danger">*</span></label>
                        <select id="" name="p_mobile_prefix" class="form-control form-select" style="direction: ltr;" maxlength="500">
                        </select>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رقم الجوال<span class="text-danger">*</span></label>
                        <input type="text" id="" name="p_mobile_number" class="form-control" style="direction: ltr;" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>المحافظة<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>المدينة<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>الحي<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>نوع المعلم<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اقرب معلم<span class="text-danger">*</span></label>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اسم الشارع<span class="text-danger">*</span></label>
                        <input type="text" name="street_name" class="form-control street_name_special">
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اخر مؤهل علمي<span class="text-danger">*</span></label>
                        <input value="" type="text" name="p_last_qualification" class="form-control"
                               placeholder="اخر مؤهل علمي"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>التخصص<span class="text-danger">*</span></label>
                        <input value="" type="text" name="p_last_speciality" class="form-control" placeholder="التخصص"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>--}}
            <button data-close-modal="#OpenModal" data-form-class="form-building" type="button" class="btn btn-success btn-save mr-2">حفظ</button>

        </div>
        <div class="card-footer text-right modal-footer">
        <!-- <button type="button" class="btn btn-success btn-save mr-2">حفظ</button> -->
        </div>
    {!! Form::close() !!}
    <!--end::Form-->
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/network/network.js') }}" class="main-scripts"></script>
    </script>
@endpush
