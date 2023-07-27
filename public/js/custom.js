var Custom = function () {
    let selectCls   = ".select-input";
    let selectFn    = function (){
        $(selectCls).select2({
            dir:'rtl',
            "language": {
                "noResults": function(){
                    return "لا يوجد نتائج";
                }
            },


        });
    }
    return {
        init: function () {
            selectFn();
        }
    };
}();



jQuery(document).ready(function() {
    Custom.init();
});
