$(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
        keys: true
    });
    var table = $('#datatable-fixed-header').DataTable({
        fixedHeader: true
    });
});

//Add images
new Dropzone("#addimagesform", { 
    maxFilesize: 2, // MB
    acceptedFiles: 'image/*',
    init: function() {
        this.on("success", function(file, responseText) {
            new PNotify({
                title: false,
                text: responseText,
                type: 'info',
            });
        });
    }
});

//Change big image
function changeImage(e, id){
    var cover = $("#cover").attr('src');
    var newCover = "view/img/products/" + id + "/big/" + e + ".jpg";
    $("#cover").attr('src', newCover);
}