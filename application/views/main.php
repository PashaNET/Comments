<section class="container">
    <div class="well" id="main-container">
        <label>Сортировка</label>
        <a class="order_by" href="/main/index?order_by=name"> имя</a>
        <a class="order_by" href="/main/index?order_by=published_date"> дата</a>
        <a class="order_by" href="/main/index?order_by=email"> email</a>
        <?php foreach($data as $value) {?>
            <div class="panel panel-default material_panel ">
                <div class="form-inline">
                    <div class="left-side-comment">
                        <div class="form-group comment-input">
                            <div class="">Имя: <?php echo $value['name'] ?></div>
                        </div>
                        <div class="form-group  comment-input">
                            <div class="">Дата: <?php echo $value['published_date'] ?></div>
                        </div>
                        <div class="form-group comment-input">
                            <div class="">Почта: <?php echo $value['email'] ?></div>
                        </div>
                        </br>
                        <hr>
                        <div class="">Комментарий: <?php echo $value['comment'] ?></div>
                        <hr>
                        <div class="admin-changed"><?php echo $value['is_edited_by_admin'] ? 'изменено администратором' : '' ?></div>
                    </div>
                    <img class="img-thumbnail upl-img" src="/assets/images/<?php echo $value['image'] ?>" />
                </div>
            </div>
        <?php } ?>
        <div class="panel panel-default material_panel shadow-2" id="preview-div">
            <div class="form-inline">
                <div class="left-side-comment">
                    <div class="form-group comment-input">
                        <div class="">Имя: <span id="name-pre"></span></div>
                    </div>
                    <div class="form-group  comment-input">
                        <div class="">Дата: <span id="date-pre"></span></div>
                    </div>
                    <div class="form-group comment-input">
                        <div class="">Почта: <span id="email-pre"></span></div>
                    </div>
                    </br>
                    <hr>
                    <div class="">Комментарий: <span id="comment-pre"></span></div>
                    <hr>
                </div>
                <img class="img-thumbnail upl-img" id="image-pre" src=""/>
                <span class="badge">X</span>
            </div>
        </div>
        <div class="panel panel-default material_panel material_panel_primary">
            <div class="panel-heading material_panel_heading">Добавить новый комментарий</div>
            <div class="panel-body material_panel_body">
                <form class="form-inline" action="main/addComment">
                    <div class="form-group materail_input_block comment-input">
                        <input type="text" name="name" class="form-control materail_input" placeholder="Имя">
                    </div>
                    <div class="form-group materail_input_block comment-input">
                        <input type="email" name="email" class="form-control materail_input" placeholder="Email">
                    </div></br>
                    <div class="form-group materail_input_block comment-input-textarea">
                        <textarea name="comment" class="form-control materail_input material_textarea" placeholder="Комментарий"></textarea>
                    </div>

                    <div class="left-side-comment">
                        <p for="comment-input-file">Выберите изображение для загрузки</p>
                        <input name="image_input" type="file"accept="image/jpeg, image/png, image/gif">
                        <p class="help-block">Допустимые форматы: JPG, GIF, PNG</p>
                    </div>
                    <img class="img-thumbnail upl-img" id="preview-img" src="" />
                    <input name="image" />
                    <div class="control-group" id="login_buttons">
                        <button id="prev-button" class="btn btn-default material_btn material_btn_primary">Предварительный просмотр</button>
                        <button type="submit" class="btn btn-default material_btn material_btn_success pull-right">Отправить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="loging-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog material_modal_dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Вход</h4>
                    </div>
                    <form class="modal-body" action="user/login">
                        <div class="form-group materail_input_block">
                            <input type="text" name="name" class="form-control materail_input" placeholder="Имя пользователя">
                        </div>
                        <div class="form-group materail_input_block">
                            <input type="password" name="password" class="form-control materail_input" placeholder="Пароль">
                        </div>

                        <div class="modal-footer material_modal_footer">
                            <button type="reset" class="btn btn-default material_btn material_btn_primary pull-left">Очистить</button>
                            <button type="submit" class="btn btn-primary material_btn material_btn_success">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="alert alert-danger material_alert" role="alert" id="message-container">
            <div></div>
        </div>
    </div>
</section>