"use strict";var KTAppEcommerceReportViews=function(){var t,e;return{init:function(){(t=document.querySelector("#kt_ecommerce_report_views_table"))&&(e=$(t).DataTable({info:!1,order:[],pageLength:10}),(()=>{var t=moment().subtract(29,"days"),e=moment(),r=$("#kt_ecommerce_report_views_daterangepicker");function o(t,e){r.html(t.format("MMMM D, YYYY")+" - "+e.format("MMMM D, YYYY"))}r.daterangepicker({startDate:t,endDate:e,ranges:{Today:[moment(),moment()],Yesterday:[moment().subtract(1,"days"),moment().subtract(1,"days")],"Last 7 Days":[moment().subtract(6,"days"),moment()],"Last 30 Days":[moment().subtract(29,"days"),moment()],"This Month":[moment().startOf("month"),moment().endOf("month")],"Last Month":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}},o),o(t,e)})(),(()=>{const e="Product Views CardReport";new $.fn.dataTable.Buttons(t,{buttons:[{extend:"copyHtml5",title:e},{extend:"excelHtml5",title:e},{extend:"csvHtml5",title:e},{extend:"pdfHtml5",title:e}]}).container().appendTo($("#kt_ecommerce_report_views_export")),document.querySelectorAll("#kt_ecommerce_report_views_export_menu [data-kt-ecommerce-export]").forEach((t=>{t.addEventListener("click",(t=>{t.preventDefault();const e=t.target.getAttribute("data-kt-ecommerce-export");document.querySelector(".dt-buttons .buttons-"+e).click()}))}))})(),document.querySelector('[data-kt-ecommerce-order-filter="search"]').addEventListener("keyup",(function(t){e.search(t.target.value).draw()})),(()=>{const t=document.querySelector('[data-kt-ecommerce-order-filter="rating"]');$(t).on("change",(t=>{let r=t.target.value;"all"===r&&(r=""),e.column(2).search(r).draw()}))})())}}}();KTUtil.onDOMContentLoaded((function(){KTAppEcommerceReportViews.init()}));
