//Send forms with ajax no reload
$(document).ready(function() {
    $(".noload").each(function(index) {   				    
        $(".noload").eq(index).submit(function(event){
            event.preventDefault();
            $("div.inf").addClass("displayBlock");
            $("div.inf").html("<img src='view/login/img/load.gif' />");
            $.post($(".noload").eq(index).attr("action"), $(".noload").eq(index).serialize(), function(gelen){
                $("div.inf").addClass("displayBlock");
                $("div.inf").html("");
                $("div.inf").html(gelen);
            });
        });
    });
});