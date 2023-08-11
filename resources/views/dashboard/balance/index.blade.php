@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom gutter-b">
        <div class="card-header card-header-stretch flex-wrap py-3">
            <div class="card-toolbar p-3">
                <button type="button" data-title="تحويل رصيد" data-size="modal-m"  href="{{ route('top-up.create') }}"
                        class="btn  btn-violet font-weight-bold openModal text-white">
                    <i class="fa fa-paper-plane text-white"></i>
                    تحويل رصيد
                </button>
            </div>
        </div>
        <div class="card-body">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_balance" data-url="{{ route('top-up.index')}}">
                        <thead>
                        <tr>
                            <th data-data="operationNumber">رقم العملية</th>
                            <th data-data="sender">المرسل</th>
                            <th data-data="receiver">المستقبل</th>
                            <th data-data="balance" width="100">الرصيد</th>
                            <th data-data="operationType">نوع العملية</th>
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
    <script src="{{ asset('js/balance/balance.js')}}" class="main-scripts"></script>
@endsection
