{{--<x-tables.menu title="العمليات">
    <x-tables.menu-item title="تعديل بيانات الشبكة  "  class="openModal" data-size="modal-lg" data-title="تعديل بيانات الشبكة"  href="{{ route('network.edit', ['id'=>$id]) }}"/>
    <x-tables.menu-item
        title="فئات الشبكة"
        class="OpenModal-lv-2"
        data-size="modal-xl"
        data-title="تصنيفات الشبكة"
        href="{!! route('card-category.index', ['id' => $id, 'is_view' => 1]) !!}"
    />

</x-tables.menu>--}}
<button type="button" data-title="تعديل تصنيفات الشبكة - <span>{{$network_name}}</span>" data-size="modal-xl" href="{!! route('card-category.index', ['id' => $id, 'is_view' => 1]) !!}" class="btn btn-warning btn-sm m-1 OpenModal-lv-2">
    <i class="bi bi-eye"></i>عرض
</button>


<button type="button" data-title="تعديل بيانات الشبكة"  data-size="modal-xl"  href="{{ route('network.edit', ['id'=>$id]) }}"
        class="btn btn-success btn-sm m-1 openModal">
    <i class="bi bi-pencil"></i> تعديل

</button>

