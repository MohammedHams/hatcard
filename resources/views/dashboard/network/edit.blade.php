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
        {!! Form::model($network, ['route' => ['network.update', $network->id], 'method' => 'put', 'class' => 'form-horizontal network-edit', 'role' => 'form', 'files' => true]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رقم جوال المالك<span class="text-danger">*</span></label>
                        <input id="phone" value="{{$network->phone ?? ''}}" type="number" name="phone" class="form-control"
                               placeholder="رقم جوال المالك"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الشبكة<span class="text-danger">*</span></label>
                        <input id="name" value="{{$network->name ?? ''}}" type="text" name="name" class="form-control"
                               placeholder="اسم الشبكة"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم المالك<span class="text-danger">*</span></label>
                        <input id="owner" value="{{$network->owner ?? ''}}" type="text" name="owner" class="form-control"
                               placeholder="اسم المالك"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الحساب على فيسبوك</label>
                        <input  id="facebook" value="{{ $network->socialMediaLinks['facebook'] ?? '' }}"  type="text" name="facebook" class="form-control"
                                placeholder="اسم الحساب"
                                maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>اسم الحساب على انستغرام</label>
                        <input id="instagram"  value="{{ $network->socialMediaLinks['instagram'] ?? '' }}" type="text" name="instagram" class="form-control"
                               placeholder="اسم الحساب"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رابط موقعك الالكتروني ان وجد</label>
                        <input id="webUrl" value="{{ $network->socialMediaLinks['webUrl'] ?? '' }}" type="text" name="webUrl" class="form-control"
                               placeholder="رابط الموقع"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رابط الدخول للشبكة<span class="text-danger">*</span></label>
                        <input id="url" type="text" value="{{$network->url ?? ''}}" name="url" class="form-control"
                               placeholder="رابط الشبكة"
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اختر صورة غلاف الشبكة</label>
                        <input id="cover" type="file" name="cover" class="form-control"
                               placeholder=" صورة الغلاف"
                               maxlength="500"/>

                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            @if($network->rejected_Details != null)
            <div class="alert alert-danger mt-3">
                <p>سبب الرفض:</p>
                <ul>
                        <li>{{ $network->rejected_Details }}</li>
                </ul>
            </div>
            @endif
            <div class="card-footer text-right modal-footer">
                <button data-close-modal="#OpenModal" data-form-class="network-edit" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
            </div>

        {!! Form::close() !!}
        <!--end::Form-->
        </div>
    </div>
        @endsection
