$(".editConfig").click(function(){
    var inp = $(this).parent('label').parent('td').parent('tr').find('.name');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
});

//Delete input
function deleteRow(id, valueName, lang){
    (new PNotify({
        title: lang,
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true
        },
        buttons: {
            text: 'Fries',
            addClass: 'btn-primary',
        },
        history: {
            history: false
        }
    })).get().on('pnotify.confirm', function() {
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
    }).on('pnotify.cancel', function() {
        return false;
    });
}

//Update information
function changeDefault(id, where, lang){
    (new PNotify({
        title: lang,
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true
        },
        buttons: {
            text: 'Fries',
            addClass: 'btn-primary',
        },
        history: {
            history: false
        }
    })).get().on('pnotify.confirm', function() {
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
    }).on('pnotify.cancel', function() {
        return false;
    });
}

//Edit information
function editValue(where, lang){
    var name = $('#'+where).parent('div').parent('div').find('.name').val();
    var id = $('#'+where).attr('kml');
    var code = $('#'+where).parent('div').parent('div').find('.code').val();
    var star = $('#'+where).parent('div').parent('div').find('.star').val();
    (new PNotify({
        title: lang,
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true
        },
        buttons: {
            text: 'Fries',
            addClass: 'btn-primary',
        },
        history: {
            history: false
        }
    })).get().on('pnotify.confirm', function() {
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
    }).on('pnotify.cancel', function() {
        return false;
    });

}