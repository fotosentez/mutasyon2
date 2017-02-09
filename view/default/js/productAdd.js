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
$("select[name='category']").change(function(){
    var ctname = $("select[name='category']").val();
    $(".ctname").val(ctname);
});

//For add category
$("#typeS").on("click", function(){
    $(".subCategory").removeClass("displayNone");
    $("input[name=prefix]").addAttr("required");
});
$("#typeM").on("click", function(){
    $(".subCategory").addClass("displayNone");
    $("input[name=prefix]").removeAttr("required");
});
