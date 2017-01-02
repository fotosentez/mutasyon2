var handleDataTableButtons = function() {
    "use strict";
    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [{
            extend: "copy",
            className: "btn-sm"
        }, {
            extend: "csv",
            className: "btn-sm"
        }, {
            extend: "excel",
            className: "btn-sm"
        }, {
            extend: "pdf",
            className: "btn-sm"
        }, {
            extend: "print",
            className: "btn-sm"
        }],
        responsive: !0
    })
},
TableManageButtons = function() {
    "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
}();
$(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
        keys: true
    });
    $('#datatable-responsive').DataTable();
    $('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
    });
    var table = $('#datatable-fixed-header').DataTable({
        fixedHeader: true
    });
});
TableManageButtons.init();