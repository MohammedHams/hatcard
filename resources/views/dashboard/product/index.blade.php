@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-header card-header-stretch flex-wrap py-3">
            <div class="card-toolbar p-3">
                <button type="button" data-title="اضافة منتج" data-size="modal-xl"  href="{{ route('product.create') }}"
                        class="btn  btn-success font-weight-bold openModal text-white">
                    <i class="fa fa-plus text-white"></i>
                    اضافة منتج
                </button>
            </div>
        </div>
        <div class="card-body">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_product" data-url="{{ route('product.index')}}">
                        <thead>
                        <tr>
                            <th data-data="imageCover" width="100">صورة المنتح</th>
                            <th data-data="title" width="250">العنوان</th>
                            <th data-data="description">الوصف</th>
                            <th data-data="availability">متاح</th>
{{--
                            <th data-data="ratingsQuantity"">عدد التقييمات</th>
--}}
                            <th data-data="stockQuantity">الكمية</th>
{{--
                            <th data-data="ratingsAverage" >نسبة التقيدد</th>
--}}
                            <th data-data="price">السعر بعد الخصم</th>
                            <th data-data="action">اجراءات</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/product/product.js')}}" class="main-scripts"></script>
    <script>
        var delRoute = "{{ route('product.destroy', "id") }}";
        var token = "{{ csrf_token() }}";
    </script>
@endsection
