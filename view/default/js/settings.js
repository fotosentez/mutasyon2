$(".editConfig").click(function(){
    var inp = $(this).parent('label').parent('td').parent('tr').find('.name');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
});

//Delete input
function deleteRow(id, valueName, lang){
    if(confirm(lang)){
        $.ajax({
            type:'POST',
            url: 'controller/settings/settings.php',
            data : { id : id, where : valueName },
            success:function(t){
                new PNotify({
                    title: false,
                    text: t,
                    type: 'info',
                });
            }
        });
    }
    else{
        return false;
    }
}

//Update information
function changeDefault(id, where, lang){
    if(confirm(lang)){
        $.ajax({
            type:'POST',
            url: 'controller/settings/settings.php',
            data : { id : id, where : where },
            success:function(t){
                new PNotify({
                    title: false,
                    text: t,
                    type: 'info',
                });
            }
        });
    }
    else{
        return false;
    }
}

//Edit information
function editValue(where, lang){
    var name = $('#'+where).parent('td').parent('tr').find('.name').val();
    var id = $('#'+where).attr('kml');
    var code = $('#'+where).parent('td').parent('tr').find('.code').val();
    var star = $('#'+where).parent('td').parent('tr').find('.star').val();
    if(confirm(lang)){
        $.ajax({
            type:'POST',
            url: 'controller/settings/settings.php',
            data : { where : where, name:name, code:code, id:id, star:star },
            success:function(t){
                new PNotify({
                    title: false,
                    text: t,
                    type: 'info',
                });
            }
        });
    }
    else{
        return false;
    }
}