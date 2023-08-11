{{--
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رقم جوال المالك<span class="text-danger">*</span></label>
                        <input id="phone" value="{{$network->phone ?? ''}}" type="number" name="phone" class="form-control"
                               placeholder="رقم جوال المالك"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رابط حساب فيسبوك الشبكة ان وجد</label>
                        <input  id="facebook" value="{{ $network->socialMediaLinks['facebook'] ?? '' }}"  type="text" name="facebook" class="form-control"
                                placeholder="اسم الحساب"
                                maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>رابط حساب انستغرام الشبكة ان وجد</label>
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
                               placeholder="رابط الشبكة (مثال:/http://8.8.8.8)"
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


            @if($network->status == "rejected")
                <input type="hidden" name="status" value="pending">

                <div class="alert alert-danger mt-3">
                    <p>سبب الرفض:</p>
                    <ul>
                        <li>{!! $network->rejected_Details !!} </li>
                    </ul>
                </div>
                <div class="card-footer text-right modal-footer">
                    <button data-close-modal="#OpenModal" data-form-class="network-edit" type="button" class="btn btn-danger btn-save mr-2">حفظ وطلب مراجعة</button>
                </div>

            @else
                <div class="card-footer text-right modal-footer">
                    <button data-close-modal="#OpenModal" data-form-class="network-edit" type="button" class="btn btn-success btn-save mr-2">حفظ</button>
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

                </div>

            @endif


        {!! Form::close() !!}
        <!--end::Form-->
        </div>
    </div>
        @endsection
--}}
