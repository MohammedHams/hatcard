@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content">
        <div class="card-header">
            <h3 class="card-title">
                اضافة شبكة
            </h3>
        </div>
        <!--begin::Form-->
        {!! Form::open(['route' => 'network.store','method' => 'post','class' => 'form-horizontal network-store','role' => 'form','files' => true]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رقم جوال المالك<span class="text-danger">*</span></label>
                        <input id="phone" type="number" name="phone" class="form-control" placeholder="رقم جوال المالك" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الشبكة<span class="text-danger">*</span></label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="اسم الشبكة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم المالك<span class="text-danger">*</span></label>
                        <input id="owner" type="text" name="owner" class="form-control" placeholder="اسم المالك" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('city', 'المدينة', ['class' => 'control-label']) !!}
                    {!! Form::select('city', $cities->pluck('name', '_id'), null, ['class' => 'form-control', 'placeholder' => 'اختر مدينة', 'id' => 'citySelect']) !!}
                    <span class="form-text text-muted text-danger" style="color:red !important"></span>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('area', 'المنطقة', ['class' => 'control-label']) !!}
                    {!! Form::select('area', ['' => 'اختر منطقة'], null, ['class' => 'form-control', 'id' => 'areaSelect']) !!}
                    <span class="form-text text-muted text-danger" style="color:red !important"></span>
                </div>
                </div>

        </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label>اسم الحساب على فيسبوك</label>
                    <input id="facebook" type="text" name="facebook" class="form-control" placeholder="اسم الحساب" maxlength="500"/>

                    <span class="form-text text-muted text-danger" style="color:red !important"></span>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>اسم الحساب على انستغرام</label>
                    <input id="instagram" type="text" name="instagram" class="form-control" placeholder="اسم الحساب" maxlength="500"/>

                    <span class="form-text text-muted text-danger" style="color:red !important"></span>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>رابط موقعك الالكتروني ان وجد</label>
                    <input id="webUrl" type="text" name="webUrl" class="form-control" placeholder="رابط الموقع" maxlength="500"/>

                    <span class="form-text text-muted text-danger" style="color:red !important"></span>
                </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رابط الدخول للشبكة<span class="text-danger">*</span></label>
                        <input id="url" type="text" name="url" class="form-control" placeholder="رابط الشبكة" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر صورة غلاف الشبكة<span class="text-danger">*</span></label>
                        <input id="cover" type="file" name="cover" class="form-control" placeholder=" صورة الغلاف" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
        <div class="card-footer text-right modal-footer">
            <button data-close-modal="#OpenModal" data-form-class="network-store" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
        </div>

        {!! Form::close() !!}
    <!--end::Form-->
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/network/network.js') }}" class="main-scripts"></script>
    </script>
@endpush
