var err_msg     = "حدثت مشكلة أثناء الحفظ.";
var success_msg = "تمت العملية بنجاح";

function getModalContent(sourceUrl, modalWrapper, Title,modalSize,pageLoad) {

    $(modalWrapper + ' .modal-dialog').addClass(modalSize);
    $(modalWrapper).modal('show');
    $(modalWrapper + " .modal-title").html(Title);
// Assuming you already have the 'modalWrapper' variable defined.
    $(modalWrapper + " .modal-body").html(`
  <!-- SVG loading animation -->
  <div class="svg-loader">
    <svg class="svg-container" height="100" width="100" viewBox="0 0 100 100">
      <circle class="loader-svg bg" cx="50" cy="50" r="45"></circle>
      <circle class="loader-svg animate" cx="50" cy="50" r="45"></circle>
    </svg>
  </div>
`);
    $.ajax({
        method: "GET",
        url: sourceUrl,
        data :{'IsModel' :true}
    }).done(function (result) {
        var parsed = $.parseHTML(result,true);
        var scripts = $(parsed).find("script").add($(parsed).filter(".main-scripts")).detach();
        datatable = $(parsed).find(".data-table");
        if(datatable.length)
            FnDataTable(datatable)
        if($(parsed).find('.select-input').length)
        {
            $(parsed).find('.select-input').select2({
                dir:'rtl',
                dropdownParent: $(modalWrapper),
                // width: 'resolve',
                "language": {
                    "noResults": function(){
                        return "لا يوجد نتائج";
                    }
                },
            });
        }
        result = $(parsed).find(".main-content");
        // scripts = $(parsed).find("script");
        // $(parsed).find(".main-content").each(function (i, el) {
        //     console.log(i+" "+ el+ " "+$(el))
        // })
        // console.log(parsed,scripts)
        $(result).removeClass('card');
        // console.log($(result).find('.card-header').hasClass('custom-header'));
        if(!$(result).find('.card-header').hasClass('custom-header')){
            $(result).find('.card-header').remove();
        }
        // $(result).find('.card-header').remove();

        footer = $(result).find('.modal-footer')
        if(footer.length){
            $(modalWrapper + " .modal-footer").html(footer.html());
        }else {
            $(modalWrapper + " .modal-footer").remove()
        }
        $(modalWrapper + " .modal-body").html(result);
        $(modalWrapper + " .modal-body").append(scripts);
        if(typeof pageLoad !== undefined )
        {
            // setTimeout(function() {
            //     console.log(pageLoad);
               $(pageLoad).trigger("click");
               if($(pageLoad).attr('data-bs-toggle') !== undefined)
                    $(pageLoad).tab("show");
            // },5000);
        }
        footer.remove();
    })
        .fail(function () {
            $(modalWrapper).modal('hide');
        });
}
$(document).on("click", ".openModal", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    var pageLoad  = $(this).data('page-load');
    getModalContent(href, "#OpenModal", title,modalSize,pageLoad);
});
$(document).on("click", ".OpenModal-lv-1", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    var pageLoad  = $(this).data('page-load');
    // console.log(pageLoad);
    getModalContent(href, "#OpenModal-lv-1", title,modalSize,pageLoad);
});
$(document).on("click", ".OpenModal-lv-2", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    var pageLoad  = $(this).data('page-load');
    getModalContent(href, "#OpenModal-lv-2", title, modalSize,pageLoad);
});
$(document).on("click", ".OpenModal-lv-3", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    var pageLoad  = $(this).data('page-load');
    getModalContent(href, "#OpenModal-lv-3", title, modalSize,pageLoad);
});
$(document).on("click", ".OpenModal-lv-4", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    var pageLoad  = $(this).data('page-load');
    getModalContent(href, "#OpenModal-lv-4", title, modalSize,pageLoad);
});


function getTabContent(sourceUrl, modalWrapper, pageLoad) {
    $.ajax({
        method: "GET",
        url: sourceUrl,
    }).done(function (result) {

        var parsed = $.parseHTML(result,document,true);
        var scripts = $(parsed).find("script").add($(parsed).filter(".main-scripts")).detach();

        result = $(parsed).find(".getTabContent");
        // console.log(result.has("[class*='popover-btn']").length)
        // if(result.has("[class*='popover-btn']").length !== 0) {
        //     console.log('ddd')
        //     result.has("[class*='popover-btn']").each(function (i){
        //         $(this).popover({
        //             placement: 'top',
        //             title: 'المٌلاك',
        //             container: $(this),
        //             html: true,
        //             content: function () {
        //                 console.log($(this)+" "+this.data('owners'))
        //                 return this.data('owners');
        //             }
        //         })
        //     })
        //
        // }
        $(result).find('.header-remove').remove();
        //$(modalWrapper).find("script").remove($(modalWrapper).filter(".main-scripts"));
        $(modalWrapper).html(result);
        $(modalWrapper).append(scripts);

        if(typeof pageLoad !== undefined )         // use this if you are using id to check
        {
            $(pageLoad).trigger("click");
        }

    }).fail(function (data) {

    });
}

$(document).on("click", ".openTab", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    var href = $(this).attr("href");
    var pageLoad  = $(this).data('page-load');
    getTabContent(url, href,pageLoad);
});


function toast(type, message) {
    /* type = (error, info, warning, success) */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    Command: toastr[type](message);
}

function Confirm(title,text,Confirmed,NotConfirme){
    Swal.fire({
        title: title,
        text: text ,
        icon: "info",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "<i class='las la-check-circle'></i> نعم ",
        cancelButtonText: '<i class="las la-times-circle"></i> لا',
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then(function(result){
        if(result.isConfirmed){
            Confirmed()
        }else if(result.dismiss == 'cancel'){
            NotConfirme()
        }
    })
}


$(document).on("click", ".btn-search", function (){
    var form =  "."+$(this).data('form-class');
    var datatable_name  = $(this).data('table-name');

    var formData = convertFormToJSON($(form));

    // console.log(formData);

    $(datatable_name).DataTable().destroy();
    FnDataTable($(datatable_name),formData);


});

// $(document).on("click", ".btn-save", function (){
//     var formClass = "."+ $(this).data('form-class');
//     var pageLoad  = $(this).data('page-load');
//     var isClose  = $(this).data('close-modal');
//     var messageConfirm  = (typeof $(this).data('msg-confirm') !== undefined) ? $(this).data('msg-confirm') : 'هل أنت متأكد أنك تريد تنفيذ هذه العملية';
//     var form =  $(formClass);
//     var file = null;

//     if (form.find('input[type=file]').length) {
//         if($('.input-file-wrapper').length)
//         {
//             file = $('.input-file-wrapper').prop('files')[0];
//             form.append('file', file);
//         }
//     }
//     var formData = new FormData(form[0]);

//     $("*").removeClass('is-invalid');
//     $(formClass + " .text-muted").html('');

//     Confirm('رسالة تأكيد',messageConfirm,
//         function (){
//             $.ajax({
//                 url     : form.attr("action"),
//                 type    : form.attr("method"),
//                 contentType : false,
//                 processData : false,
//                 beforeSend: function(){
//                     //console.log( this.data );
//                 },
//                 data    : formData,
//                 success : function ( json )
//                 {
//                     if(typeof isClose !== undefined )         // use this if you are using id to check
//                     {
//                         $(isClose).modal('hide');
//                     }
//                     if(typeof pageLoad !== undefined )         // use this if you are using id to check
//                     {
//                         $(pageLoad).trigger("click");
//                     }
//                     if( $('.data-table').length )         // use this if you are using id to check
//                     {
//                         $('.data-table').DataTable().ajax.reload();
//                     }
//                 },
//                 error   : function ( jqXhr, json, errorThrown )
//                 {
//                     var errors = jqXhr.responseJSON;
//                     if(jqXhr.status == 422){
//                         $.each(errors.errors, function( key, value ) {
//                             var _tag="input[name="+key+"]";
//                             $(_tag).addClass('is-invalid')
//                             $(_tag).siblings('.text-muted').html(value)
//                             errorsHtml += '<p class="text-danger">' + value[0] + '</p>';
//                         });
//                     }
//                     else
//                     {
//                         var errorsHtml= '';
//                         $.each( errors, function( key, value ) {
//                             errorsHtml += '<li>' + value[0] + '</li>';
//                         });
//                         toast("error","Error " + jqXhr.status +': '+ errorThrown);
//                     }
//                 }
//             });
//         },
//         function (){

//         }
//     );



// });

$(document).on("click", ".btn-save", function (){

    var formClass = ($(this).data('form-class') !== undefined) ?  ("."+ $(this).data('form-class')) : $(".submit-form");
    var pageLoad  = $(this).data('page-load');
    var isClose  = $(this).data('close-modal');
    var messageConfirm  = (typeof $(this).data('msg-confirm') !== undefined) ? $(this).data('msg-confirm') : 'هل أنت متأكد أنك تريد تنفيذ هذه العملية';
    var form =  ($(this).data('form-class') !== undefined) ? $(formClass) : formClass  ;
    var file = null;

    if (form.find('input[type=file]').length) {
        if($('.input-file-wrapper').length)
        {
            file = $('.input-file-wrapper').prop('files')[0];
            form.append('file', file);
        }
    }
    var formData = new FormData(form[0]);

    $("*").removeClass('is-invalid');
    $(".submit-form .text-muted").html('');

    Confirm('رسالة تأكيد',messageConfirm,
        function () {
            $(".svg-hide").show();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    //console.log( this.data );
                },
                data: formData,
                success: function (json) {
                    $(".svg-hide").hide();
                    if(typeof isClose !== undefined )         // use this if you are using id to check
                    {
                        $(isClose).modal('hide');
                    }
                    if(typeof pageLoad !== undefined )         // use this if you are using id to check
                    {
                        $(pageLoad).trigger("click");
                    }
                    if ($('.data-table').length)         // use this if you are using id to check
                    {
                        $('.data-table').DataTable().ajax.reload();
                    }
                },
                error: function (jqXhr, json, errorThrown) {
                    $(".svg-hide").hide();
                    var errors = jqXhr.responseJSON;
                    if (jqXhr.status == 422) {
                        $.each(errors.errors, function (key, value) {
                            var _tag = "input[name=" + key + "]";
                            var _tag2 = "select[name=" + key + "]";
                            $(_tag).addClass('is-invalid');
                            $(_tag).siblings('.text-muted').html(value);
                            $(_tag2).addClass('is-invalid');
                            $(_tag2).siblings('.text-muted').html(value);
                        });
                    }
                }
            });
        },
        function (){
        }
    );
});
function AjaxRequest(type,ajaxurl,formData,successCallback,errorCallback){
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    });
}
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    complete: function(result, textStatus) {
        if(result.status == 200 ){
            if(isJson(result.responseText)){
                var data = JSON.parse(result.responseText);
                if(data.hasOwnProperty("message")) {
                    toast("success", data.message);
                }
            }
        }
        // else  if(result.status == 500 ){
        //     var data = JSON.parse(result.responseText);
        //     if(data.hasOwnProperty("message")) {
        //         toast("error", data.message);
        //     }
        // }
        else if(result.status == 422 ){
            //validation error
        } else if(result.status == 403 ){
            var data = JSON.parse(result.responseText);
            if(data.hasOwnProperty("message")) {
                toast("error", data.message);
            }
        } else{
            toast("error", err_msg);
        }
    }
});

function FnDataTable (dtable,search_data=[]){
    var route =  dtable.data('url');
    var table = dtable.DataTable({
        destroy: true,

        processing: true,
        serverSide: true,
        contentType : false,
        processData : false,
        ajax: {
            url:((route.indexOf("?") == -1) ? (route+"?IsDataTable=true") : (route+"&IsDataTable=true")),
            data:search_data
        },
        lengthMenu: [5, 10, 25, 50], // Display 5, 10, 25, 50 records per page
        pageLength: 5, // Set the default page length to 5
        language: {
            "paginate": {
                "first":      "الأول",
                "last":       "الأخير",
                "previous": "السابق",
                "next": "التالي"
            },
            "decimal":        "",
            "emptyTable":     "لا يوجد بيانات",
            "info":           "عرض _START_ الى _END_ من _TOTAL_ عنصر ",
            "infoEmpty":      "اظهار 0 ال 0 من 0 عنصر",
            "infoFiltered":   "( تم البحث في _MAX_ عنصر )",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "عرض _MENU_ من الصفوف",
            "loadingRecords": "جاري التحميل ، يرجى الانتظار.............",
            "processing":     "جاري التنفيذ ....",
            "search":         "بحث : ",
            "zeroRecords":    "لم يتم العثور على نتائج",
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
    table.on( 'draw', function () {
        KTMenu.createInstances();

    } );
}


function convertFormToJSON(form) {
    return $(form)
        .serializeArray()
        .reduce(function (json, { name, value }) {
            json[name] = value;
            return json;
        }, {});
}


function getChildSelectOptions(parentSelectCls , childSelectCls,...relatedSelects) {
    var parentVal=$(parentSelectCls).val();
    var url=$(parentSelectCls).data('url')
    var key=$(parentSelectCls).data('key');
    var value=$(parentSelectCls).data('value');
    var superParent=$(parentSelectCls).data('super-parent');
    var data={
            'parent':parentVal,
            'key':key,
            'value':value,
        };
    if(parentSelectCls===".special_case")
        data.special_case=true;
    if (superParent!=""){
        var superParentVal=$(superParent).val();
        data.superParent=superParentVal;
    }
    if(parentVal!==""){
        $.ajax({
                url: url,
                type: 'get',
                data: data,
                success: function (json) {
                    clearChildSelects(relatedSelects);
                    if(json.status==200){
                        $(childSelectCls).html( `<option value="" selected>اختر</option>`);
                        if(parentSelectCls===".special_case") {
                            $(childSelectCls).val(json.data['value']);
                        }
                        else {
                            $.each(json.data, function (i, item) {
                                var newOption = new Option(item.value,item.key, false, false);
                                // $(childSelectCls).append($("<option />").val(item.key).text(item.value));
                                $(childSelectCls).append(newOption);
                                if($(childSelectCls).hasClass('select-input')) {
                                    $(childSelectCls).select2({
                                        dir:'rtl'
                                    });
                                }
                            });
                        }
                    }else{
                        $(parentSelectCls).val('');
                        clearChildSelects(relatedSelects);
                    }
                },
                error:function(e) {
                    $(parentSelectCls).val('');
                    clearChildSelects(relatedSelects);
                }
            }
        );
   }else{
        clearChildSelects(relatedSelects);
    }
}
function clearChildSelects(relatedSelects){
    $.each(relatedSelects, function( index, value ) {
        if(value==='.street_name_special')
            $(value).val('');
        else
            $(value).html(`<option value="" selected>اختر</option>`);
    });
}


