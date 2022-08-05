<?php
function card($data, $content)
{
    ob_start(); ?>
    <?php foreach ($data as $key) { ?>
        <?php if (isset($key)) { ?>
            <?php if (isset($key['action'])) { ?>
                <form method="post" action="<?= base_url(@$key['action'])  ?>">
                <?php } else { ?> <form> <?php } ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row mt-3">
                                <div class="col">
                                    <h4 class="card-title"><?= @$key['title'] ?></h4>
                                </div>
                                <div class="col text-right">
                                    <a class="btn btn-<?= $key['button']['button_color'] ?>" href="<?= base_url($key['button']['button_link']) ?>" role="button"><?= $key['button']['button_title'] ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (is_array($content)) { ?>
                                <?php foreach ($content as $val) { ?>
                                    <?= $val ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?= $content ?>
                            <?php  } ?>
                        </div>
                        <div class="card-footer">
                            <?php if (isset($key['button_cancel'])) { ?>
                                <a class="btn btn-<?= $key['button_cancel']['button_color'] ?>" href="<?= base_url($key['button_cancel']['button_action']) ?>" role="button"><?= $key['button_cancel']['button_title'] ?></a>
                            <?php } else {
                            } ?>
                            <?php if (isset($key['button_save'])) { ?>
                                <button type="submit" class="btn btn-<?= $key['button_save']['button_color'] ?> ml-2"><?= $key['button_save']['button_title'] ?></button>
                            <?php } else {
                            } ?>
                        </div>
                    </div>
                    </form>
                <?php } ?>
            <?php } ?>
        <?php $contents = ob_get_clean();
        return $contents;
    }
    function card_2($data, $content)
    {
        ob_start(); ?>
            <?php foreach ($data as $key) {
            ?>
                <?php if (isset($key)) { ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row mt-3">
                                <div class="col">
                                    <h4 class="card-title"><?= @$key['title'] ?></h4>
                                </div>
                                <div class="col text-right">
                                    <?php if (isset($key['button'])) { ?>
                                        <a class="btn btn-<?= $key['button']['button_color'] ?>" href="<?= base_url($key['button']['button_link']) ?>" role="button"><?= $key['button']['button_title'] ?></a>
                                    <?php } else {
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (is_array($content)) { ?>
                                <?php foreach ($content as $val) { ?>
                                    <?= $val ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?= $content ?>
                            <?php  } ?>
                        </div>
                        <div class="card-footer">
                            <?php if (isset($key['button_cancel'])) { ?>
                                <a class="btn btn-<?= $key['button_cancel']['button_color'] ?>" href="<?= base_url($key['button_cancel']['button_action']) ?>" role="button"><?= $key['button_cancel']['button_title'] ?></a>
                            <?php } else {
                            } ?>
                            <?php if (isset($key['button_save'])) { ?>
                                <button type="submit" class="btn btn-<?= $key['button_save']['button_color'] ?> ml-2"><?= $key['button_save']['button_title'] ?></button>
                            <?php } else {
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php $contents = ob_get_clean();
        return $contents;
    }


    function search($data)
    {
        ob_start(); ?>
            <?php foreach ($data as $val) { ?>
                <div class="col-md-3 my-1 my-md-0">
                    <div class="app-search">
                        <div class="position-relative">
                            <input type="text" name="<?= $val['name'] ?>" id="<? $val['id'] ?>" class="form-control" placeholder="Search...">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php $contents = ob_get_clean();
        return $contents;
    }

    function card_new($data, $content)
    {
        ob_start(); ?>
            <?php foreach ($data as $key) { ?>
                <?php if (isset($key)) { ?>
                    <?php if (isset($key['action'])) { ?>
                        <form method="post" action="<?= base_url(@$key['action'])  ?>">
                        <?php } else { ?> <form> <?php } ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <h4 class="card-title"><?= @$key['title'] ?></h4>
                                        </div>
                                        <div class="col text-right">
                                            <?php if (is_array($key['card_header'])) { ?>
                                                <?php foreach ($key['card_header'] as $val) { ?>
                                                    <?= $val ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?= $key['card_header'] ?>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if (is_array($content)) { ?>
                                        <?php foreach ($content as $val) { ?>
                                            <?= $val ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?= $content ?>
                                    <?php  } ?>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                            </form>
                        <?php } ?>
                    <?php } ?>
                <?php $contents = ob_get_clean();
                return $contents;
            }
