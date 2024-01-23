"use strict";
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.ajax-modal').click(function(event){
        event.preventDefault();
        var href = $(this).attr('href');

        $.ajax({
            method: "GET",
            url: href,
            data: {}
        }).done(function( data ) {
                $('#ajax-model-content').html(data);
                $('#ajaxGetModel').modal('show');
            });


    });


    $('.menu-click a').click(function(event){
        event.preventDefault();
        if(! $(this).hasClass('ajax-modal'))
            document.location.href = $(this).attr('href');
    });


    $('#kt_quick_panel_toggle2').click(function(event){
        event.preventDefault();
        $('#kt_quick_panel_toggle').click();
    });

    $('#kt_quick_user_toggle2').click(function(event){
        event.preventDefault();
        $('#kt_quick_user_toggle').click();
    });


    $('.custom-offcanvas-close').click(function(event){
        var El = $(this).data('target');
        $("#" + El).addClass('offcanvas-off').removeClass('offcanvas-on');
    });

    $('.custom-offcanvas-open').click(function(event){
        var El = $(this).data('target');
        $("#" + El).addClass('offcanvas-on').removeClass('offcanvas-off');
    });


    $(document).on('click', '.parent-nav', function (){
        jQuery(this).siblings('.child-nav').toggleClass('d-none');
        jQuery(this).children('.fas').toggleClass('fa-angle-right');
    });

    $('.right-radio-update').change(function() {
        var data = new FormData();
        data.append("slug", $(this).data('slug'));
        data.append("newVal", $(this).prop('checked'));
        data.append("type", $(this).data('type'));
        data.append("type_id", $(this).data('typeId'));
        data.append("member_id", $(this).data('member-id'));
        $.ajax({
            data: data,
            url: HOST_URL + '/rights/parent/update',
            type: "POST",
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.status === 200){
                    showToastr('success', data.message)
                }
            }
        });
    });
});

$(document).on('click', '.file-link', function () {
    $('#file-details-modal').modal('show');
})

$(document).on('click', '.file-link-history', function () {
    $('#file-details-history-modal').modal('show');
})

$(document).on('click', '.edit-form-modal', function () {
    var project_id = $(this).data('project-id');
    var project_space_id = $(this).data('project-space-id');
    var folder_id = $(this).data('folder-id');
    var file_id = $(this).data('file-id');

    //HOST_URL
    $.ajax({
        url: HOST_URL + '/projects/' + project_id + '/spaces/' + project_space_id + '/' + folder_id + '/file/' + file_id + '/form',
        type: "get",
        cache:false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#update_file_ajax').attr('action', HOST_URL + '/projects/' + project_id + '/spaces/' + project_space_id + '/' + folder_id + '/file/' + file_id  );
            $('#update_file_ajax').data('project-id', project_id);
            $('#update_file_ajax').data('project-space-id', project_space_id);
            $('#update_file_ajax').data('folder-id', folder_id);
            $('#edit-file-form-data').html(data);
        }
    });
    $('#editFileForm').modal('show');
})

$(document).on('submit', '#update_file_ajax', function (event) {
    event.preventDefault();
    var project_id = $(this).data('project-id');
    var project_space_id = $(this).data('project-space-id');
    var folder_id = $(this).data('folder-id');
    var reload = $(this).data('reload');


    $.ajax({
        url: $(this).attr('action'),
        type: 'PATCH',
        data: $(this).serialize(),

        success: function(data) {
            if(data.status == 200){
                if(reload) {
                    var loadingURL = HOST_URL + "/projects/" + project_id + "/spaces/" + project_space_id + "/" + folder_id + "/files";
                    $("#files-grid").load(loadingURL);
                    $('#editFileForm').modal('hide');
                    showToastr('success', data.message);
                } else {
                    window.location.reload();
                }
            } else if(data.status == 400) {
                showToastr('error', data.errors, 'list');
            } else {
                showToastr('error', "Something went wrong");
            }
        }
    });
});



$(document).on('change', '.file-type-id', function() {
    var url_temp = $(this).data('url');
    $("#file-values").load(url_temp + "/filetype/" + $(this).val() + "/values");
});


function getNextRate() {
    var ts = String(new Date().getTime()),
        i = 0,
        out = '';

    for (i = 0; i < ts.length; i += 2) {
        out += Number(ts.substr(i, 2)).toString(36);
    }
    return out;
}

function showToastr(type, message, messageType = 'single') {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var showMessage = '';

    if (messageType == 'list') {
        var error = message;
        var array = $.map(error, function(value, index) {  return [value]; });

        for (var i = 0; i < array.length; i++)
            showMessage += array[i] + '\n <br>';
    } else {
        showMessage = message;
    }

    switch (type) {
        case 'success' :
            toastr.success(showMessage);
            break;
        case 'error' :
            toastr.error(showMessage);
            break;
    }
}


function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

$(document).ready(function(){

    $(document).on('click', '.file_move_modal', function(){
        URL = $(this).data('href');
        $.ajax({
            url: URL,
            type: "get",
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                showToastr('success', 'File Move Started, Navigate to Desire folder');
            }
        });
    });

});


$(document).on('click', '.rich_text-editor', function() {
    $('.note-toolbar').toggleClass('note-toolbar-block');
})

function trim(string, mask) {
    while (~mask.indexOf(string[0])) {
        string = string.slice(1);
    }
    while (~mask.indexOf(string[string.length - 1])) {
        string = string.slice(0, -1);
    }
    return string;
}

function showToastr(type, message, messageType = 'single') {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var showMessage = '';

    if (messageType == 'list') {
        var error = message;
        var array = $.map(error, function(value, index) {  return [value]; });

        for (var i = 0; i < array.length; i++)
            showMessage += array[i] + '\n <br>';
    } else {
        showMessage = message;
    }

    switch (type) {
        case 'success' :
            toastr.success(showMessage);
            break;
        case 'error' :
            toastr.error(showMessage);
            break;
    }
}


