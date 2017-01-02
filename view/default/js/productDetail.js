$(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
        keys: true
    });
    var table = $('#datatable-fixed-header').DataTable({
        fixedHeader: true
    });
});