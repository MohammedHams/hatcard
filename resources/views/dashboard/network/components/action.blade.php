<x-tables.menu title="العمليات">
    <x-tables.menu-item title="تعديل بيانات الشبكة  "  class="openModal" data-size="modal-lg" data-title="تعديل بيانات الشبكة"  href="{{ route('network.edit', ['id'=>$id]) }}"/>
    <x-tables.menu-item
        title="تصنيفات الشبكة"
        data-page-load="#tab1_sh"
        class="OpenModal-lv-1"
        data-size="modal-xl"
        data-title="تصنيفات الشبكة"
        href="{{ route('network.show', ['id' => $id]) }}"
    />

</x-tables.menu>
