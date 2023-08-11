@extends('layouts.dashboard.app')
@section('content')
    <div class="card card-custom main-content" xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <h3 class="card-title">
                اضافة منتج
            </h3>
        </div>
        <!--begin::Form-->
        {!! Form::open(['route' => 'product.store','method' => 'post','class' => 'form-horizontal product-store','role' => 'form','files' => false]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>عنوان المنتج<span class="text-danger">*</span></label>
                        <input id="title" type="text" name="title" class="form-control" placeholder="عنوان المنتج"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>السعر<span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price" class="form-control" placeholder="السعر"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>عدد التقييمات<span class="text-danger">*</span></label>
                        <input id="ratingsQuantity" type="number" name="ratingsQuantity" class="form-control"
                               placeholder="عدد المقيمين" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>نسبة الخصم</label>
                        <input id="discount" type="number" name="discount" class="form-control" placeholder="نسبة الخصم"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الكمية<span class="text-danger">*</span></label>
                        <input id="stockQuantity" type="text" name="stockQuantity" class="form-control"
                               placeholder="الكمية">
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>صورة المنتج<span class="text-danger">*</span></label>
                        <input id="imageCover" type="text" name="imageCover" class="form-control"
                               placeholder="صورة المنتج" maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>وصف المنتج<span class="text-danger">*</span></label>
                        <textarea id="description" type="text" name="description" class="form-control"
                                  placeholder="وصف المنتج" rows="4" cols="50"></textarea>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>البراند</label>
                        <input id="brand" type="text" name="brand" class="form-control" placeholder="البراند"
                               maxlength="500"/>
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>رابط الصورة 1 </label>
                        <input id="images[0]" type="text" name="images[]" class="form-control" placeholder="رابط الصورة"
                               rows="4" cols="50">
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رابط الصورة 2 </label>
                        <input id="images[1]" type="text" name="images[]" class="form-control" placeholder="رابط الصورة"
                               rows="4" cols="50">
                        <span class="form-text text-muted text-danger" style="color:red !important"></span>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right modal-footer">
                <button data-close-modal="#OpenModal" data-form-class="product-store" type="button"
                        class="btn btn-success btn-save mr-2">حفظ
                </button>


                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                     y="0px"
                     width="20px" height="30px" viewBox="0 0 40 40" enable-background="new 0 0 40 40"
                     xml:space="preserve" class="svg-hide" style="display: none">
      <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
          s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
          c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
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

        {!! Form::close() !!}
        <!--end::Form-->
        </div>
    </div>
@endsection


