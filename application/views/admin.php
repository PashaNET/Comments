<section class="container">
    <?php foreach($data as $value) {?>
        <div class="panel panel-default ">
            <div class="form-inline shadow-<?php echo $value['is_published'] ?>">
                <div class="left-side-comment">
                    <div class="form-group comment-input">
                        <div class=""><?php echo $value['name'] ?></div>
                    </div>
                    <div class="form-group comment-input">
                        <div class=""><?php echo $value['published_date'] ?></div>
                    </div>
                    <div class="form-group comment-input email">
                        <div class=""><?php echo $value['email'] ?></div>
                    </div>
                    </br>
                    <hr>
                    <div class="form-group materail_input_block text-area-container">
                        <textarea disabled="disabled" class="form-control materail_input material_textarea">
                            <?php echo $value['comment'] ?>
                        </textarea>
                    </div>
                    <button class="btn btn-default btn-xs material_btn material_btn_xs material_btn_primary edit-button">
                        Редактировать
                    </button>
                </div>

                <img class="img-thumbnail upl-img" src="/assets/images/<?php echo $value['image'] ?>" />

                <button class="btn btn-default btn-xs material_btn material_btn_xs material_btn_success publish-button"
                    value="<?php echo $value['is_published'] ? '0' : '1'?>">
                    <?php echo $value['is_published'] ? 'Cнять с публикации' : 'Опубликовать'?>
                </button>
            </div>
        </div>
    <?php } ?>
    <script src="/assets/js/admin.scripts.js"></script>
</section>
