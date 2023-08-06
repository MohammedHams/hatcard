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
    var attachEventHandlers = function () {
        // Event delegation for the change event on #citySelect
        $(document).on('change', '#citySelect', function () {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: `/overview/network/area/${cityId}`,
                    type: 'GET',
                    data: { cityId: cityId },
                    dataType: 'json',
                    success: function (data) {
                        var options = '<option value="">اختر منطقة</option>';
                        $.each(data, function (key, area) {
                            options += '<option value="' + area._id + '">' + area.name + '</option>';
                        });
                        $('#areaSelect').html(options);
                    },
                    error: function (error) {
                        console.error('Error fetching areas:', error);
                    }
                });
            } else {
                $('#areaSelect').html('<option value="">اختر منطقة</option>');
            }
        });
    };



    return {
        init: function () {
            viewTable();
            deleteFn();
            attachEventHandlers();
        }
    };
}();



jQuery(document).ready(function() {
    Networks.init();
});
