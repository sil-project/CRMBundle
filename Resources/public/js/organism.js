
$(document).ready(function(){
    
    var formDataElement = $('.js-data#organism-form');
    var prefix = formDataElement.data('unique-id') + '_';
    var errors = formDataElement.data('errors');
    
    // ********** Individual / Collective

    function toggleIndividual(){
        var $individual_1 = $('#' + prefix + 'isIndividual_1');
        if( $individual_1.prop('checked') ) {
            $individual_1.closest('ul').next('.help-block').show();
            $('#sonata-ba-field-container-' + prefix + 'title').show();
            $('#sonata-ba-field-container-' + prefix + 'firstname').show();
        }
        else {
            $individual_1.closest('ul').next('.help-block').hide();
            $('#sonata-ba-field-container-' + prefix + 'title').hide();
            $('#sonata-ba-field-container-' + prefix + 'firstname').hide();
        }
    }

    toggleIndividual();
    $('#' + prefix + 'isIndividual').on('ifChanged', toggleIndividual);

    // ************ Customer Code

    // Move things around...
    var customer_container = $('#sonata-ba-field-container-' + prefix + 'isCustomer');
  
    customer_container.wrap('<div class="form-inline">');
    customer_container.find('.sonata-ba-field').css({display: 'inline-block', minWidth: '180px'});
    customer_container.find('label').css('margin-left', '0').css('margin-right', '1em');
    var customer_code_container = $('#sonata-ba-field-container-' + prefix + 'customerCode');
      console.log(customer_code_container.find('input'));
    customer_code_container.find('input').appendTo(customer_container);
    customer_code_container.find('a').appendTo(customer_container);
    customer_code_container.find('label').remove();

    function generateCustomerCode(){
        var $code = $('input#' + prefix + 'customerCode')
        var url = $('a#' + prefix + 'customerCode_generate_code').attr('href');
        var data = $code.closest('form').serializeArray();
        $.post(url, data, function(res){
            if (res['error'] !== undefined)
                alert(res['error']);
            else if (res['code'] !== undefined)
                $code.val(res['code']);
        });
    }

    function toggleCustomerCode(){
        var $code = $('#' + prefix + 'customerCode');
        var $link = $('#' + prefix + 'customerCode_generate_code');
        if( $('#' + prefix + 'isCustomer').prop('checked') ) {
            $('label[for=' + prefix + 'customerCode').addClass('required');
            if ($code.data('old') !== undefined)
                $code.val($code.data('old'));
            $code.show().prop('required', true);
            $link.show();
            if ( $code.val().trim() === "" && errors )
                generateCustomerCode();
        }
        else {
            $('label[for=' + prefix + 'customerCode').removeClass('required');
            $code.hide().prop('required', false).data('old', $code.val()).val('');
            $link.hide();
        }
    }

    toggleCustomerCode();
    $('#' + prefix + 'isCustomer').on('ifChanged', toggleCustomerCode);

    // ************ Supplier Code

    // Move things around...
    var supplier_container = $('#sonata-ba-field-container-' + prefix + 'isSupplier');
    supplier_container.wrap('<div class="form-inline">');
    supplier_container.find('.sonata-ba-field').css({display: 'inline-block', minWidth: '180px'});
    supplier_container.find('label').css('margin-left', '0').css('margin-right', '1em');
    var supplier_code_container = $('#sonata-ba-field-container-' + prefix + 'supplierCode');
    supplier_code_container.find('input').appendTo(supplier_container);
    supplier_code_container.find('a').appendTo(supplier_container);
    supplier_code_container.find('label').remove();

    function generateSupplierCode(){
        var $code = $('input#' + prefix + 'supplierCode')
        var url = $('a#' + prefix + 'supplierCode_generate_code').attr('href');
        var data = $code.closest('form').serializeArray();
        $.post(url, data, function(res){
            if (res['error'] !== undefined)
                alert(res['error']);
            else if (res['code'] !== undefined)
                $code.val(res['code']);
        });
    }

    function toggleSupplierCode(){
        var $code = $('#' + prefix + 'supplierCode');
        var $link = $('#' + prefix + 'supplierCode_generate_code');
        
        
        if( $('#' + prefix + 'isSupplier').prop('checked') ) {
            $('label[for=' + prefix + 'supplierCode').addClass('required');
            if ($code.data('old') !== undefined)
                $code.val($code.data('old'));
            $code.show().prop('required', true);
            $link.show();
            if ( $code.val().trim() === "" && errors )
                generateSupplierCode();
        }
        else {
            $('label[for=' + prefix + 'supplierCode').removeClass('required');
            $code.hide().prop('required', false).data('old', $code.val()).val('');
            $link.hide();
        }
    }

    toggleSupplierCode();
    $('#' + prefix + 'isSupplier').on('ifChanged', toggleSupplierCode);

});