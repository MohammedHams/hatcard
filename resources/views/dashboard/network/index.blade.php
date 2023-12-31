@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-header card-header-stretch flex-wrap py-3">
            <div class="card-toolbar p-3">
                <button type="button" data-title="اضافة شبكة" data-size="modal-xl"  href="{{ route('network.create') }}"
                        class="btn btn-success font-weight-bold openModal">
                    <i class="fa fa-plus"></i>
                    اضافة شبكة
                </button>
            </div>
        </div>
        <div class="card-body">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_netwroks" data-url="{{ route('network.index')}}">
                        <thead>
                        <tr>
                            <th data-data="name">اسم الشبكة</th>
                            <th data-data="city_name">المدينة</th>
                            <th data-data="area_name">المنطقة</th>
                            <th data-data="status" width="100">حالة الشبكة</th>
                            <th data-data="createdAt">تاريخ الانشاء</th>
                            <th data-data="cover" >الصورة</th>
                            <th data-data="action" width="200">اجراءات</th>
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
    <script src="{{ asset('js/network/network.js')}}" class="main-scripts"></script>
    <script src="{{ asset('js/categories/category.js')}}" class="main-scripts"></script>
    <script src="{{ asset('js/cards/cards.js')}}" class="main-scripts"></script>

@endsection
