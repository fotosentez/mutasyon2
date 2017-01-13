$(function(){
    tinymce.init({
        selector: "#editor"
    });
});

//Add images
//For add images
$("input[name='product_name']").change(function(){
    var stname = $("input[name='product_name']").val();
    $(".stname").val(stname);
});

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