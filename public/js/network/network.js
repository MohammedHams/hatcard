var Networks = function () {
    var datatable   = $('#datatable_netwroks');
    var delBtnCls   = ".delete-network-btn";
    var viewTable   = function () {
        if(datatable.length){
            datatable = FnDataTable(datatable);
        }
    };

    var deleteFn    = function (){
        $(document).on("click", delBtnCls , function (e) {
            var id = $(this).data('id');
            var route = $(this).data('route');
            e.preventDefault();
            Confirm('رسالة تأكيد','هل أنت متأكد أنك تريد الحذف',
                function (){
                    AjaxRequest('delete',route.replace("id", id),
                        {
                            "_token": token
                        },
                        function (data){
                            if( $('.data-table').length )
                            {
                                $('.data-table').DataTable().ajax.reload();
                            }
                        },function (data){
                            //toast('error', data.responseText)
                        }
                    );
                },
                function (){
                    //toast('info', 'لم تتم عملية الحذف ، لم يتم الحذف')
                }
            );
        });
    };



    return {
        init: function () {
            viewTable();
            deleteFn();
        }
    };
}();



jQuery(document).ready(function() {
    Networks.init();
});
