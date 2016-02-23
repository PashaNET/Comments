$(document).ready(function () {
    var admin_script = {
        initialize: function () {
            this.setUpListeners();
        },
        setUpListeners: function () {
            $(window).on('load', this.start);
            $('.edit-button').on('click', this.editComment);
            $('.publish-button').on('click', this.publishComment);
        },
        start: function(){
            //$('#admin-link').show();
            //$('#login-form').hide();
        },
        editComment: function(){
            var button = $(this),
                textarea = button.siblings('.text-area-container').find('textarea'),
                email = button.siblings('.email').find('div').text();
            if(textarea.attr('disabled')){
                textarea.removeAttr('disabled');
                button.text('Сохранить');
            } else {
                var data = new FormData();
                data.append('comment', textarea.val());
                data.append('is_edited_by_admin', 1);
                data.append('email', email);
                main_script.makeRequest({
                    url : 'updateComment',//main/updateComment
                    data: data,
                    success: function(){}
                });

                textarea.attr('disabled', 'disabled');
                button.text('Редактировать');
            }
        },
        publishComment: function () {
            var data = new FormData(),
                button = $(this),
                status = button.attr('value'),
                cls;

            if(status == 1){
                cls = 0;
                button.text('Cнять с публикации');
                button.attr('value', cls);
            } else {
                cls = 1;
                button.text('Опубликовать');
                button.attr('value', cls);
            }
            button.parents('.shadow-' + cls).toggleClass('shadow-1 shadow-0');

            data.append('is_published', status);
            data.append('email', button.siblings('.left-side-comment').find('.email div').text());
            main_script.makeRequest({
                url : 'updateComment',
                data: data,
                success: function(){}
            });
        }
    };

    admin_script.initialize();
});
