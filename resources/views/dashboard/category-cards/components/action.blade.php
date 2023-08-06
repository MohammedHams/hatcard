{{--<x-tables.menu title="العمليات">
    <x-tables.menu-item title="تعديل الفئة"  class="openModal" data-size="modal-lg" data-title="تعديل بيانات الفئة"  href="{{ route('card-category.edit', ['id'=>$id]) }}"/>
    <x-tables.menu-item
        title="عرض بطاقات التصنيف"
        class="OpenModal-lv-3"
        data-size="modal-xl"
        data-title="تصنيفات الشبكة"
        href="{!! route('card.index', ['id' => $id, 'is_view' => 1]) !!}"
    />
    <x-tables.menu-item title="رفع البطاقات  "  class="openModal" data-size="modal-lg" data-title="رفع البطاقات"  href="{!! route('card.create', ['id'=>$id,'network'=>$network_id]) !!}"/>
</x-tables.menu>--}}
<button type="button" data-title="عرض بطاقات الفئة"  data-size="modal-xl"  href="{!! route('card.index', ['id' => $id, 'is_view' => 1]) !!}"
        class="btn btn-primary btn-sm m-1 OpenModal-lv-3">
    <i class="bi bi-eye"></i> عرض البطاقات
</button>

<button type="button" data-title="رفع البطاقات"  data-size="modal-lg"  href="{!! route('card.create', ['id'=>$id,'network'=>$network_id]) !!}"
        class="btn btn-info btn-sm m-1 openModal">
    <i class="bi bi-card-heading"></i> رفع بطاقات
</button>
<button type="button" data-title="تعديل الفئة" data-size="modal-lg"  href="{{ route('card-category.edit', ['id'=>$id]) }}"
        class="btn btn-warning btn-sm m-1 openModal">
    <i class="bi bi-pencil"></i>تعديل
</button>
