var main_script = {};
$(function () {
         main_script = {
        initialize: function () {
            this.setUpListeners();
        },
        setUpListeners: function () {
            $(window).on('load', this.start);
            $('#login-form').on('click', this.showLoginForm);
            $('button[type="submit"]').on('click', this.submitForm);
            $('form').on('keydown', 'input', this.deleteErrors);
            $('input[type="file"]').on('change', this.imageUpload);
            $('#prev-button').on('click', this.preview);
            $('.badge').on('click', this.hidePreview);
        },
        start: function () {
            var link = location.href.split('/').pop(),
                page = (link.indexOf('?') > -1) ? link.split('?')[0] : link;
            $('#' + page + '-link').addClass('active');
        },
        showLoginForm: function () {
            $('#loging-modal').modal('show');
        },
        submitForm: function (e) {
            e.preventDefault();
            var form = $(this).parents('form'),
                inputs = $(form).find('input, textarea').not('input[name="image_input"]'),
                data = new FormData();

            if (main_script.dataValidation(inputs)) {
                $.each(inputs, function (index, val) {
                    var key = $(val).attr('name'),
                        value = $(val).val();
                    console.log(key, value);
                    data.append(key, value);
                });

                var form_action = $(form).attr('action'),
                    params = {
                        url: form_action,
                        data: data
                    };

                var action = form_action.split('/').pop(),
                    input = $('input[name="name"]');
                if (action == 'login') {
                    params['error'] = function () {
                        main_script.showMessage({
                            type: 'error',
                            input: input,
                            text: 'Не удалось авторизоваться!'
                        });
                    };
                    params['success'] = function () {
                        $('#loging-modal').modal('hide');
                        location.reload();
                    }
                } else if (action == 'addComment') {
                    params['success'] = function () {
                        main_script.showMessage({
                            type: 'success',
                            input: input,
                            text: 'Комментарий успешно добавлен!'
                        });
                    };

                    params['error'] = function () {
                        main_script.showMessage({
                            type: 'error',
                            input: input,
                            text: 'Комментарий не добавлен!'
                        });
                    };
                }

                main_script.makeRequest(params);
            }
        },
        dataValidation: function (data) {
            var valide = true;
            $.each(data, function (index, val) {
                var input = $(val),
                    value = input.val(),
                    name = input.attr('name'),
                    form_group = input.parents('.form-group');

                if (name !== 'image' && value.length === 0) {
                    main_script.showMessage({
                        type: 'error',
                        input: input,
                        form_group: form_group,
                        text: 'Заполните, пожалуйста, все поля!'
                    });
                    valide = false;
                } else if (name === 'email') {
                    var reg = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

                    if (!reg.test(value)) {
                        main_script.showMessage({
                            type: 'error',
                            input: input,
                            form_group: form_group,
                            text: 'Поле "Email" заполнено неверно!'
                        });
                        valide = false;
                    }
                }
            });

            return valide;
        },
        showMessage: function (params) {
            var message_container = $('#message-container');

            if (params.type == 'error') {
                if(params.form_group){
                    params.form_group.addClass('materail_input_error');
                }
                $(params.input).focus();
                message_container.addClass('material_alert_danger');
            } else {
                message_container.addClass('material_alert_success');
            }

            message_container.find('div').text(params.text);
            $(params.input).parents('.material_panel_body').prepend(message_container);
            message_container.show();
        },
        deleteErrors: function () {
            $('#message-container').hide();
            $(this).parent().removeClass('materail_input_error');
        },
        imageUpload: function () {
            var allowed_formats = ['image/jpeg', 'image/png', 'image/gif'],
                file = this.files[0];
            if (allowed_formats.indexOf(file.type) > -1) {
                var data = new FormData();
                data.append('image', file);
                main_script.makeRequest({
                    url: '/image/upload',
                    data: data,
                    success: function (response) {
                        var image_container = $('#preview-img');
                        $('input[name="image"]').val(response);
                        image_container.attr('src', '/assets/images/' + response);
                        image_container.show();
                    },
                    error: function () {
                        main_script.showMessage({
                            type: 'error',
                            input: $('input[name="name"]'),
                            text: 'Не удалось загрузить изображение!'
                        });
                    }
                });
            }
        },
        preview: function(e) {
            e.preventDefault();

            var form = $(this).parents('form'),
                inputs = $(form).find('input, textarea').not('input[name="image_input"]');
            if(main_script.dataValidation(inputs)){
                $.each(inputs, function (index, val) {
                    var name = $(val).attr('name');
                    if(name == 'image'){
                        $('#' + name + '-pre').attr('src', '/assets/images/' + $(val).val());
                    }else{
                        $('#' + name + '-pre').text($(val).val());
                    }
                });
                $('#preview-div').show();
            }
        },
        hidePreview: function(){
            $('#preview-div').hide();
        },
        makeRequest: function (params) {
             $.ajax({
                 url: params.url,
                 type: 'POST',
                 data: params.data,
                 processData: false,
                 contentType: false,
                 //dataType: 'json',
                 success: function (response) {
                     params.success(response);
                 },
                 error: function (response) {
                     params.error(response);
                 }
             });
        }
    };

    main_script.initialize();
});