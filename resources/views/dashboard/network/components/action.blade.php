<x-tables.menu title="العمليات">
    <x-tables.menu-item title="تعديل بيانات الشبكة  "  class="openModal" data-size="modal-lg" data-title="تعديل بيانات الشبكة"  href="{{ route('network.edit', ['id'=>$id]) }}"/>
    <x-tables.menu-item
        title="فئات الشبكة"
        class="OpenModal-lv-2"
        data-size="modal-xl"
        data-title="تصنيفات الشبكة"
        href="{!! route('card-category.index', ['id' => $id, 'is_view' => 1]) !!}"
    />

</x-tables.menu>
