<?php

if (isset($_POST) && !empty($_POST)) {
    Whitenode::write_php_ini($_POST, ROOT . '/settings.ini');
}

$checked = (isset(Whitenode::$settings['app_enable_login']) && Whitenode::$settings['app_enable_login'] == 1) ? "checked" : "";
$checked_console = (isset(Whitenode::$settings['app_enable_console']) && Whitenode::$settings['app_enable_console'] == 1) ? "checked" : "";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form name="savesettings" method="post" id="savesettings">
                    <div class="header">
                        <h4 class="title"><?= tl("Settings") ?></h4>
                        <p class="small"><?= tl("Apply custom settings here") ?></p>
                    </div>

                    <div class="content">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="app_enable_login" class="form-check-input"
                                           type="checkbox" <?= $checked ?> value="1"> <?= tl("Enable login") ?>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?= tl("Username") ?></label>
                            <input type="text" class="form-control" name="app_name" placeholder="<?= tl("username") ?>"
                                   value="<?= Whitenode::$settings['app_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?= tl("Password") ?></label>
                            <input type="password" class="form-control" name="app_password"
                                   placeholder="<?= tl("password") ?>" autocomplete="false">
                        </div>


                        <div class="form-group">
                            <label for="label_explorer"><?= tl("Block Explorer") ?></label>
                            <input type="text" class="form-control" id="label_explorer" readonly name="block_explorer"
                                   value="<?= Whitenode::$settings['block_explorer'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="label_coinm"><?= tl("Coin marketcap") ?></label>
                            <input type="text" class="form-control" id="label_coinm" readonly name="coinmarketcap"
                                   value="<?= Whitenode::$settings['coinmarketcap'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?= tl("Save settings") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?= tl("Experimental") ?></h4>
                    <p class="small"><?= tl("Apply custom settings here") ?></p>
                </div>

                    <div class="row">
                        <div class="col-lg-2 col-sm-4">
                            <div class="content">
                                <form action="/Operators/Action.php" method="get">
                                    <input type="hidden" name="action" value="updatewallet">
                                    <button type="update" class="btn btn-primary"><?= tl("Update wallet") ?></button>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-4">
                            <div class="content">
                                <form action="/Operators/Action.php" method="get">
                                    <input type="hidden" name="action" value="deleteblockchain">
                                    <button type="update" class="btn btn-primary"><?= tl("Delete blockchain files") ?></button>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-4">
                            <div class="content">
                                <form action="/Operators/Action.php" method="get">
                                    <input type="hidden" name="action" value="backupwallet">
                                    <button type="update" class="btn btn-primary"><?= tl("Backup and download wallet") ?></button>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>