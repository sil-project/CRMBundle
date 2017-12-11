$(document).ready(function() {
    var formDataElement = $('.js-data#organism-form-data');
    var prefix = formDataElement.data('unique-id') + '_';

    // ********** Individual / Collective

    function toggleIndividual() {
        var individual = $('[id$="isIndividual_1"]');

        if (individual.is('input[type="radio"]') && individual.prop('checked') || individual.is('input[type="hidden"]') && parseInt(individual.val(), 10) === 1) {
            $('#' + prefix + 'title').prop('disabled', false);
            $('#sonata-ba-field-container-' + prefix + 'title').show();
            $('#' + prefix + 'firstname').prop('disabled', false);
            $('#sonata-ba-field-container-' + prefix + 'firstname').show();
            $('#' + prefix + 'lastname').prop('disabled', false);
            $('#sonata-ba-field-container-' + prefix + 'lastname').show();
            $('#sonata-ba-field-container-' + prefix + 'name').hide();
            $('#' + prefix + 'name').prop('disabled', true);

            $('.sonata-ba-field-' + prefix + 'addresses-firstName').show().find('input').prop('disabled', false);
            $('.sonata-ba-field-' + prefix + 'addresses-lastName').find('label.control-label').html(Translator.trans('sil.crm.organism.form.label.lastname', {}, 'messages'));
        } else {
            $('#sonata-ba-field-container-' + prefix + 'title').hide();
            $('#' + prefix + 'title').prop('disabled', true);
            $('#sonata-ba-field-container-' + prefix + 'firstname').hide();
            $('#' + prefix + 'firstname').prop('disabled', true);
            $('#sonata-ba-field-container-' + prefix + 'lastname').hide();
            $('#' + prefix + 'lastname').prop('disabled', true);
            $('#' + prefix + 'name').prop('disabled', false);
            $('#sonata-ba-field-container-' + prefix + 'name').show();

            $('.sonata-ba-field-' + prefix + 'addresses-firstName').hide().find('input').prop('disabled', true);
            $('.sonata-ba-field-' + prefix + 'addresses-lastName').find('label.control-label').html(Translator.trans('sil.crm.organism.form.label.name', {}, 'messages'));
        }
    }

    toggleIndividual();
    $('#' + prefix + 'isIndividual').on('ifChanged', toggleIndividual);

    $(document).on('sonata.add_element', function(e) {
        toggleIndividual();
    });

    // ************ Customer Code

    var customerContainer = $('#sonata-ba-field-container-' + prefix + 'isCustomer');

    if (customerContainer.length) {
        customerContainer.addClass('form-inline');
        customerContainer.find('.sonata-ba-field').css({ display: 'inline-block', minWidth: '200px' });
        customerContainer.find('label').css({ 'margin-left': '0', 'margin-right': '1em' });
        var customerCodeContainer = $('#sonata-ba-field-container-' + prefix + 'customerCode');
        customerCodeContainer.find('input').css({ display: 'inline-block' }).appendTo(customerContainer);
        customerCodeContainer.find('a').appendTo(customerContainer);
        customerCodeContainer.find('div.loader').appendTo(customerContainer);
        customerCodeContainer.remove();

        toggleCustomerCode();
    }

    function generateCustomerCode() {
        var code = $('input#' + prefix + 'customerCode');
        var url = $('a#' + prefix + 'customerCode_generate_code').attr('href');
        var data = code.closest('form').serializeArray();

        $.post(url, data, function(res) {
            if (res['error'] !== undefined)
                alert(res['error']);
            else if (res['code'] !== undefined)
                code.val(res['code']);
        });
    }

    function toggleCustomerCode() {
        var code = $('#' + prefix + 'customerCode');
        var link = $('#' + prefix + 'customerCode_generate_code');

        if (code.length > 0) {
            if ($('#' + prefix + 'isCustomer').prop('checked')) {

                $('label[for=' + prefix + 'customerCode').addClass('required');
                if (code.data('old') !== undefined)
                    code.val(code.data('old'));

                code.show().prop('required', true);
                link.show();

                if (code.val().trim() === "" && formDataElement.data('customer-error')) {
                    generateCustomerCode();
                }
            } else {
                $('label[for=' + prefix + 'customerCode').removeClass('required');
                code.hide().prop('required', false).data('old', code.val()).val('');
                link.hide();
            }
        }
    }

    $('#' + prefix + 'isCustomer').on('ifChanged', toggleCustomerCode);

    // ************ Supplier Code

    var supplierContainer = $('#sonata-ba-field-container-' + prefix + 'isSupplier');

    // Move things around...
    if (supplierContainer.length) {
        supplierContainer.addClass('form-inline');
        supplierContainer.find('.sonata-ba-field').css({ display: 'inline-block', minWidth: '200px' });
        supplierContainer.find('label').css({ 'margin-left': '0', 'margin-right': '1em' });
        var supplierCodeContainer = $('#sonata-ba-field-container-' + prefix + 'supplierCode');
        supplierCodeContainer.find('input').css({ display: 'inline-block' }).appendTo(supplierContainer);
        supplierCodeContainer.find('a').appendTo(supplierContainer);
        supplierCodeContainer.find('div.loader').appendTo(supplierContainer);
        supplierCodeContainer.remove();

        toggleCustomerCode();
    }

    function generateSupplierCode() {
        var code = $('input#' + prefix + 'supplierCode');
        var url = $('a#' + prefix + 'supplierCode_generate_code').attr('href');
        var data = code.closest('form').serializeArray();
        $.post(url, data, function(res) {
            if (res['error'] !== undefined)
                alert(res['error']);
            else if (res['code'] !== undefined)
                code.val(res['code']);
        });
    }

    function toggleSupplierCode() {
        var code = $('#' + prefix + 'supplierCode');
        var link = $('#' + prefix + 'supplierCode_generate_code');

        if (code.length > 0) {
            if ($('#' + prefix + 'isSupplier').prop('checked')) {
                $('label[for=' + prefix + 'supplierCode').addClass('required');

                if (code.data('old') !== undefined)
                    code.val(code.data('old'));

                code.show().prop('required', true);
                link.show();
                if (code.val().trim() === "" && formDataElement.data('supplier-error'))
                    generateSupplierCode();
            } else {
                $('label[for=' + prefix + 'supplierCode').removeClass('required');
                code.hide().prop('required', false).data('old', code.val()).val('');
                link.hide();
            }
        }
    }

    toggleSupplierCode();
    $('#' + prefix + 'isSupplier').on('ifChanged', toggleSupplierCode);
});
