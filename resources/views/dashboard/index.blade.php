@extends('layouts.dashboard.app')
@section('content')
    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer" id="datatable_netwroks" data-url="{{ route('network.index')}}">
                    <thead>
                    <tr>
                        <th data-data="name">Name</th>
                        <th data-data="owner">Owner</th>
                        <th data-data="phone">Phone</th>
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
    <script src="{{ asset('js/network/network.js') }}"></script>
@endpush
