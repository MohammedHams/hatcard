<x-tables.menu title="العمليات">
    <x-tables.menu-item title="تعديل الفئة  "  class="openModal" data-size="modal-lg" data-title="تعديل بيانات الفئة"  href="{{ route('card-category.edit', ['id'=>$id]) }}"/>
    <x-tables.menu-item
        title="عرض بطاقات التصنيف"
        class="OpenModal-lv-3"
        data-size="modal-xl"
        data-title="تصنيفات الشبكة"
        href="{!! route('card.index', ['id' => $id, 'is_view' => 1]) !!}"
    />

    <x-tables.menu-item title="رفع البطاقات  "  class="openModal" data-size="modal-lg" data-title="رفع البطاقات"  href="{{ route('card.create', ['id'=>$id,'network'=>$network_id]) }}"/>
</x-tables.menu>
