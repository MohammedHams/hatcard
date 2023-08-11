
    <button type="button" data-title="تعديل بيانات المنتج"  data-size="modal-xl"  href="{{route('product.edit', ['id' => $id])}}"
            class="btn btn-success btn-sm m-1 openModal">
        <i class="bi bi-pencil"></i> تعديل

    </button>
    <button type="button" data-title="حذف المنتج"
            data-route="{{ route('product.destroy', ['id' => $id]) }}"
            class="btn btn-danger delete-product-btn btn-sm m-1" data-id="{{ $id }}">
        <i class="bi bi-trash"></i> حذف
    </button>


    {{--<button type="button" data-title="حذف المنتج" data-size="modal-xl" href="{!! route('card-category.index', ['id' => $id, 'is_view' => 1]) !!}" class="btn btn-warning btn-sm m-1 OpenModal-lv-2">
        <i class="bi bi-eye"></i>عرض
    </button>--}}


