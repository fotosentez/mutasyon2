$(document).ready(function() {
    // Smart Wizard
    $('#wizard').smartWizard();
    
    function onFinishCallback() {
        $('#wizard').smartWizard('showMessage', 'Finish Clicked');
        //alert('Finish Clicked');
    }
});

$(document).ready(function() {
    // Smart Wizard
    $('#wizard_verticle').smartWizard({
        transitionEffect: 'slide'
    });
    
});