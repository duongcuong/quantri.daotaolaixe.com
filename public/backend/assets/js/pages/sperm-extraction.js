
var classSpermSubmitSearch = '.form-sperm-submit-search';
var formSpermSubmitSearch = $(classSpermSubmitSearch);
var elmContentSpermRender = $('#male-pig');
var elmSpermTableResult = $('#form-sperm-list-table tbody');
var elmSpermFormSubmit = $('.form-sperm-submit-create');
var elmSpermModalCreate = $('#modalCreateSpermExtractions');
var elmSpermModalEdit = $('#modalEditSpermExtractions');
var classToggleEditSpermExtractions = '.toggleEditSpermExtractions';
var elmSpermToggleEdit = $(classToggleEditSpermExtractions);
var elmSpermFormSubmitEdit = $('.form-sperm-submit-edit');
var classDeleteSperm = '.form-sperm-submit-delete';
var classConfirm = '.delete-confirm';
function getDataSperms(url) {
    loading.show();
    if(pigId){
        var data = {};
        data.pig_id = pigId;
    }else{
        var data;
        var form = formSpermSubmitSearch;
        data = form.serialize();
    }
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: data,
        success: function(response) {
            elmContentSpermRender.html(response.data);
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            loading.hide();
        }
    });
}

function validateFormSperm(form) {
    var elmDateAt = form.find('input[name="dated_at"]');
    var elmWeight = form.find('input[name="weight"]');
    var valName = elmDateAt.val();
    var valUnit = elmWeight.val();
    if (!valName) elmDateAt.addClass('is-invalid')
    else elmDateAt.removeClass('is-invalid');
    if (!valUnit) elmWeight.addClass('is-invalid')
    else elmWeight.removeClass('is-invalid');

    if (!valName || !valUnit) return false;
    return true;
}

$(function () {
    

    elmSpermFormSubmit.on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        if (!validateFormSperm(form)) return;
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
                elmSpermModalCreate.modal('hide');
                getDataSperms(routeSpermList);
            },
            error: function(xhr, status, error) {
                alertErrorAPI(xhr.responseJSON.errors);
            },
            complete: function() {
                loading.hide();
            }
        });
    });

    var urlUpdate = '';

    function getSpermDetail(id){
        loading.show();
        let url = '';
        url = urlEditSperm.replace('__id__', id);
        urlUpdate = urlUpdateSperm.replace('__id__', id);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.datas);
                elmSpermFormSubmitEdit.find('input[name="dated_at"]').val(convertDateVn(response.datas.dated_at));
                elmSpermFormSubmitEdit.find('input[name="weight"]').val(response.datas.weight);
                elmSpermModalEdit.modal();
            },
            error: function(xhr, status, error) {
                alertErrorAPI(xhr.responseJSON.errors);
            },
            complete: function() {
                loading.hide();
            }
        });
    }

    $(document).on('click', classToggleEditSpermExtractions, function() {
        let id = $(this).data('id');
        getSpermDetail(id);
    });

    elmSpermFormSubmitEdit.on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        if (!validateFormSperm(form)) return;
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
                elmSpermModalEdit.modal('hide');
                getDataSperms(routeSpermList );
            },
            error: function(xhr, status, error) {
                alertErrorAPI(xhr.responseJSON.errors);
            },
            complete: function() {
                loading.hide();
            }
        });
    });

    $(document).on('click', classDeleteSperm, function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        url = urlDeleteSperm.replace('__id__', id);
        showDeleteConfirmation(function () {
            loading.show();
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    getDataSperms(routeSpermList );
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

    if(!pigId){
        getDataSperms(routeSpermList );

        $(document).on('submit', classSpermSubmitSearch, function(e) {
            e.preventDefault();
            getDataSperms(routeSpermList );
        });

        $(document).on('click', '.pagination-sperm-render .pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            getDataSperms(url);

        });
    }
});