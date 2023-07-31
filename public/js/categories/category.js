var Categories = function () {
    var datatable   = $('#datatable_category');
    var delBtnCls   = ".delete-category-btn";
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
            changePeriodType();  // Call changePeriodType instead of toggleInputField
        }
    };
}();
var getSelectedOptionText = function (selectedValue) {
    switch (selectedValue) {
        case "H":
            return "بالساعات";
        case "D":
            return "باليوم";
        case "W":
            return "بالأسبوع";
        case "M":
            return "بالشهر";
        default:
            return "";
    }
};


var toggleInputField = function () {
    var periodTypeSelect = document.getElementById("periodType");
    var inputFieldWrapper = document.getElementById("inputFieldWrapper");
    var periodLabel = document.getElementById("periodLabel");

    if (periodTypeSelect && periodTypeSelect.options) { // Check if the element exists and has options
        var selectedOption = periodTypeSelect.options[periodTypeSelect.selectedIndex].value;

        if (selectedOption !== "") {
            inputFieldWrapper.style.display = "block";
            periodLabel.innerText = "فترة البطاقة " + getSelectedOptionText(selectedOption);
            // Change the column sizes when the select dropdown is changed

        } else {
            inputFieldWrapper.style.display = "none";
        }
    }
};

var changePeriodType = function () {
    var periodTypeSelect = document.getElementById("periodType");
    if (periodTypeSelect) {
        toggleInputField(); // Call toggleInputField to set the initial state
        periodTypeSelect.addEventListener("change", toggleInputField);
    }
};


function setInitialValue() {
    var periodTypeSelect = document.getElementById("periodType");
    var initialValue = "{{$categoryCard->periodType? :'' }}"; // Use the value from PHP variable $categoryCard->periodType

    if (initialValue !== "") {
        periodTypeSelect.value = initialValue;
    }
}

jQuery(document).ready(function() {
    Categories.init();
});
