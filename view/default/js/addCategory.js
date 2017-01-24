$("#typeS").on("click", function(){
    $(".subCategory").removeClass("displayNone");
    $("input[name=prefix]").addAttr("required");
});
$("#typeM").on("click", function(){
    $(".subCategory").addClass("displayNone");
    $("input[name=prefix]").removeAttr("required");
});