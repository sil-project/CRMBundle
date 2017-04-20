    
var setupNPAIFields = function(e) {

    var id = $('#form-id').data('id');
    var emailNpai = $('#' + id + '_emailNpai');
    var email = $('#' + id + '_email');
    
    colorize(emailNpai, email);
    //'ifChanged' is the event triggered by iCheck plugin http://icheck.fronteed.com/
    $(emailNpai).on('ifChanged', function(){

        colorize($(this), email);
    });
    
    
}; 
    
var colorize = function(npai, element){
    if($(npai).is(':checked'))
        $(element).css('border', '1px dashed red');
    else
        $(element).css('border', '1px solid #d2d6de');
};

$(document).ready(setupNPAIFields);
$(document).on('sonata-admin-setup-list-modal sonata-admin-append-form-element sonata.add_element', setupNPAIFields);