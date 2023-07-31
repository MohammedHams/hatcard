@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom main-content">
        <div class="card-body getTabContent">
            <div class="card-header custom-header">
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer"
                                               id="datatable_cards"
                                               data-url="{{ route('card.index',['id' => $id])}}"
                                               style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th data-data="code">رقم البطاقة</th>
                                                <th data-data="password">كلمة السر</th>
                                                <th data-data="isUsed">حالة البطاقة</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>


                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1_sh"></div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right modal-footer">
        </div>
    </div>
@endsection

