@extends('layouts.dashboard.app')
@section('content')
    <button type="button" data-title="اضافة شبكة"  href="{{ route('network.create') }}"
            class="btn btn-success font-weight-bold openModal">
        <i class="fa fa-plus"></i>
        اضافة شبكة
    </button>

    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_netwroks" data-url="{{ route('network.index')}}">
                        <thead>
                        <tr>
                            <th data-data="name">اسم الشبكة</th>
                            <th data-data="owner">المالك</th>
                            <th data-data="phone">رقم الهاتف</th>
                            <th data-data="action" width="100px">اجراءات</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/network/network.js')}}" class="main-scripts"></script>
@endpush
