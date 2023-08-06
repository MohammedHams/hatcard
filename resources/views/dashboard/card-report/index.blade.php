@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_card_report" data-url="{{ route('report.index')}}">
                            <thead>
                            <tr>
                                <th data-data="invoice_number">رقم الفاتورة</th>
                                <th data-data="network_id">الشبكة</th>
                                <th data-data="category">التصنيف</th>
                                <th data-data="quantity" width="100">الكمية</th>
                                <th data-data="createdAt">تاريخ الرفع</th>
                                <th data-data="status" >الحالة</th>
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
    <script src="{{ asset('js/card-report/card-report.js')}}" class="main-scripts"></script>
@endsection
