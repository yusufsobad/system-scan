<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php foreach ($sidebar as $value) { ?>
                    <?php if ($value['sub_menu'] == '' || $value['sub_menu'] == null) { ?>
                        <li <?= $value['condition'] == "true" ? 'class="mm-active"' : '' ?>>
                            <a href="<?= base_url($value['link']) ?>" <?= $value['condition'] == "true" ? 'class=" waves-effect active"' : 'class=" waves-effect"'   ?>>
                                <i class="<?= $value['icon'] ?>"></i>
                                <span><?= $value['title'] ?></span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <?php if ($value['title-group'] == '' || $value['title-group'] == null) { ?>
                        <?php } else { ?>
                            <li class="menu-title"><?= $value['title-group'] ?></li>
                        <?php } ?>
                        <li <?= $value['condition'] == "true" ? 'class="mm-active"' : '' ?>>
                            <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="<?= $value['condition'] == "true" ? 'true' : 'false' ?>">
                                <i class="<?= $value['icon'] ?>"></i>
                                <span><?= $value['title'] ?></span>
                            </a>
                            <ul <?= $value['condition'] == "true" ? 'class="sub-menu mm-collapse mm-show"' : 'class="sub-menu mm-collapse"' ?> aria-expanded="false">
                                <?php foreach ($value['sub_menu'] as $val) { ?>
                                    <li <?= $val['condition'] == "true" ? 'class="mm-active"' : '' ?>><a href="<?= base_url($val['link']) ?>"><?= $val['title'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->