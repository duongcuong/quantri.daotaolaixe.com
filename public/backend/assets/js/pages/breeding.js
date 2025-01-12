var classSubmitSearch = '.form-submit-search';
var formSubmitSearch = $(classSubmitSearch);
var classFormSubmitDelete = '.form-breeding-submit-delete';
var elmContentHeathyRender = $('#female-pig');
var elmBreedingTableResult = $('#form-breeding-list-table tbody');
var elmBreedingFormSubmit = $('.form-breeding-submit-create');
var elmBreedingModalCreate = $('#modalCreateBreeding');
var elmBreedingModalEdit = $('#modalEditBreeding');
var classToggleEditBreeding = '.toggleEditBreeding';
var elmBreedingFormSubmitEdit = $('.form-breeding-submit-edit');
var classConfirm = '.delete-confirm';

function getDataBreedings(url) {
    loading.show();
    if(pigId){
        var data = {};
        data.pig_id = pigId;
    }else{
        var data;
        var form = formSubmitSearch;
        data = form.serialize();
    }

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: data,
        success: function(response) {
            elmContentHeathyRender.html(response.data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            loading.hide();
        }
    });
}
function validateForm(form) {
    if(pigId) return true;
    var elmPigCode = form.find('select[name="pig_code"]');
    var valPigCode = elmPigCode.val();

    if (!valPigCode) elmPigCode.addClass('is-invalid')
    else elmPigCode.removeClass('is-invalid');

    if (!valPigCode) return false;

    return true;
}

function getBreedingDetail(id){
    loading.show();
    let url = '';
    url = urlEdit.replace('__id__', id);
    urlUpdate = urlUpdate.replace('__id__', id);
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(!pigId){
                elmBreedingFormSubmitEdit.find('select[name="pig_code"]').val(response.datas.code);
                elmBreedingFormSubmitEdit.find('select[name="pig_code"]').attr('data-selected-id', response.datas.code);
            }
            
            elmBreedingFormSubmitEdit.find('input[name="oestrous_day"]').val(convertDateVn(response.datas.oestrous_day));
            elmBreedingFormSubmitEdit.find('input[name="week"]').val(response.datas.week);
            elmBreedingFormSubmitEdit.find('input[name="breeding_date_first"]').val(convertDateVn(response.datas.breeding_date_first));
            elmBreedingFormSubmitEdit.find('select[name="male_first"]').val(response.datas.male_first_code);
            elmBreedingFormSubmitEdit.find('select[name="male_first"]').attr('data-selected-id', response.datas.male_first_code);
            elmBreedingFormSubmitEdit.find('input[name="breeding_date_second"]').val(convertDateVn(response.datas.breeding_date_second));
            elmBreedingFormSubmitEdit.find('select[name="male_second"]').val(response.datas.male_second_code);
            elmBreedingFormSubmitEdit.find('select[name="male_second"]').attr('data-selected-id', response.datas.male_second_code);
            elmBreedingFormSubmitEdit.find('input[name="expected_pregnancy_day"]').val(convertDateVn(response.datas.expected_pregnancy_day));
            elmBreedingFormSubmitEdit.find('input[name="pregnancy_day"]').val(convertDateVn(response.datas.pregnancy_day));
            elmBreedingFormSubmitEdit.find('input[name="expected_birth_date"]').val(convertDateVn(response.datas.expected_birth_date));
            elmBreedingFormSubmitEdit.find('input[name="actual_date_of_birth"]').val(convertDateVn(response.datas.actual_date_of_birth));
            elmBreedingFormSubmitEdit.find('input[name="code_children"]').val(response.datas.code_children);
            elmBreedingFormSubmitEdit.find('select[name="breed_id"]').val(response.datas.breed_id);
            elmBreedingFormSubmitEdit.find('input[name="number_of_children_to_raise"]').val(response.datas.number_of_children_to_raise);
            elmBreedingFormSubmitEdit.find('select[name="result"]').val(response.datas.result);
            elmBreedingModalEdit.modal();
            resetSelectAjax();
        },
        error: function(xhr, status, error) {
            alertErrorAPI(xhr.responseJSON.errors);
        },
        complete: function() {
            loading.hide();
        }
    });
}

$(function () {
    elmBreedingFormSubmit.on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        if (!validateForm(form)) return;
        loading.show();
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();
    
        $.ajax({
            url: url,
            type: method,
            data: data,
            dataType: 'json',
            success: function(response) {
                alertSuccess(response.msg);
                form[0].reset();
                resetSelectAjax('resetForm');
                elmBreedingModalCreate.modal('hide');
                getDataBreedings(routeBreedingList);
            },
            error: function(xhr, status, error) {
                loading.hide();
                alertErrorAPI(xhr.responseJSON.errors);
            },
            complete: function() {
                loading.hide();
            }
        });
    });

    $(document).on('click', classFormSubmitDelete, function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        url = urlDelete.replace('__id__', id);
        showDeleteConfirmation(function () {
            loading.show();
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    getDataBreedings(routeBreedingList);
                },
                error: function(xhr, status, error) {
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        });
    });

    $(document).on('click', classToggleEditBreeding, function() {
        let id = $(this).data('id');
        getBreedingDetail(id);
    });

    elmBreedingFormSubmitEdit.on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        if (!validateForm(form)) return;
        loading.show();
        var data = form.serialize();

        $.ajax({
            url: urlUpdate,
            type: 'PUT',
            data: data,
            dataType: 'json',
            success: function(response) {
                alertSuccess(response.msg);
                form[0].reset();
                elmBreedingModalEdit.modal('hide');
                getDataBreedings(routeBreedingList);
            },
            error: function(xhr, status, error) {
                alertErrorAPI(xhr.responseJSON.errors);
            },
            complete: function() {
                loading.hide();
            }
        });
    });

    if(!pigId){
        getDataBreedings(routeBreedingList );

        $(document).on('submit', classSubmitSearch, function(e) {
            e.preventDefault();
            getDataBreedings(routeBreedingList );
        });

        $(document).on('click', '.pagination-heathy-render .pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            getDataBreedings(url);
        });
    }
    
});