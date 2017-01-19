$(".grid").on("click", function(){
    $.ajax({
        type:'POST',
        url: 'controller/products/products.php',
        data : { 'view':'grid'},
        success:function(t){
            setTimeout(function(){ location.reload(); }, 100);
        }
    });
});

$(".list").on("click", function(){
    $.ajax({
        type:'POST',
        url: 'controller/products/products.php',
        data : { 'view':'list'},
        success:function(t){
            setTimeout(function(){ location.reload(); }, 100);
        }
    });
});

$('select').on('change', function() {
    var id = $('select').val();
    $.ajax({
        type:'POST',
        url: 'model/products.php',
        data : { 'cid':id},
        success:function(t){
            setTimeout(function(){ location.reload(); }, 100);
        }
    });
});

// Add ? or & on url
function removeOther(b, y) { 
    if(window.location.href.indexOf(y) != -1)
    {
        location.search = location.search.replace('&' + y, '');
    }
    else if(window.location.href.indexOf(b) != -1) {
        location.search = location.search.replace(b,y);
    }
    else if(b == '')
    {
        window.location.search += '&' + y;
    }
    else if(window.location.href.indexOf('?') != -1)
    {
        window.location.search += '&' + y;
    }
    else
    {
        window.location.search += '?' + y;
    }
    
}