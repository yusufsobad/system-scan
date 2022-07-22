<?php
function card($data, $content)
{
    ob_start(); ?>
    <?php foreach ($data as $key) {
    ?>
        <?php if (isset($key)) { ?>
            <form method="post" action="<?= base_url(@$key['action'])  ?>">
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
                    <div class="card-action">
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

function search($data)
{
    ob_start(); ?>
    <?php foreach ($data as $val) { ?>
        <!-- <div class=" mb-3" id="search-nav">
            <div class="navbar-left navbar-form nav-search mr-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pr-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" name="<?= $val['name'] ?>" id="<? $val['id'] ?>" placeholder="Search ..." class="form-control">
                </div>
            </div>
        </div> -->
        <div class="col-md-4 my-2 my-md-0">
            <div class=" mb-3" id="search-nav">
                <div class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend bg-light-secondary ">
                            <button type="submit" class="btn btn-search pr-1">
                                <span><i class="fa fa-search search-icon "></i></span>
                            </button>
                        </div>
                        <input type="text" name="<?= $val['name'] ?>" id="<? $val['id'] ?>" placeholder="Search ..." class="form-control">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php $contents = ob_get_clean();
    return $contents;
}
