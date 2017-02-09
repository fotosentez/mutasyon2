$('.virtual').click(function(){
    var inp = $('.buybank').find('.notpay');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
});