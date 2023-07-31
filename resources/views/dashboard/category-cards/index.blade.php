@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom main-content">
        <div class="card-header card-header-stretch flex-wrap py-3">
            <div class="card-toolbar p-3">
                <button type="button" data-title="اضافة فئة بطاقة" data-size="modal-lg"  href="{{ route('card-category.create',['id' => $id]) }}"
                        class="btn btn-success font-weight-bold openModal">
                    <i class="fa fa-plus"></i>
                    اضافة فئة جديدة
                </button>
            </div>
        </div>
        <div class="card-body getTabContent">
            <div class="card-header custom-header">
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped border-top border-start border-bottom gy-2 gy-5 gs-7 data-table dataTable no-footer"
                                               id="datatable_category"
                                               data-url="{{ route('card-category.index',['id' => $id])}}"
                                               style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th data-data="cname">اسم الفئة</th>
                                                <th data-data="price">السعر</th>
                                                <th data-data="periodType">الفئة</th>
                                                <th data-data="image" width="200px" >الصورة</th>
                                                <th data-data="action" width="100px">اجراءات</th>
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

