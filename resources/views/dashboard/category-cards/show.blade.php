@extends('layouts.dashboard.app')

@section('content')

    <div class="card card-custom main-content">
        <div class="card-header">
            <h3 class="card-title">
                تفاصيل الشبكة
            </h3>
        </div>
        <div class="card-body">
            <div class="card-header custom-header">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 openTab"
                               data-bs-toggle="tab"
                               aria-controls="tab1"
                               id="tab1_sh"
                               href="#tab1"
                               data-url="{{ route('network.index',['is_view'=>1]) }}"
                            >
                                <span class="nav-icon">
                                    <i class="fas fa-file px-1"></i>
                                </span>
                                <span class="nav-text">بيانات الاعضاء </span>
                            </a>
                        </li>




                    </ul>
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

@section('scripts')
    <script src="{{ asset('js/network/network.js')}}" class="main-scripts"></script>
@endsection
