<?php
    $balance = Whitenode::$clientd->getbalance();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Send")?></h4>
                    <p><?=tl("availible balance")?>: <?=$balance?> XWC</p>
                </div>
                <div class="content">
                    <form name="send" method="post" id="send" action="/send-preview">

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?=tl("Address")?></label>
                            <input type="text" class="form-control" name="sendToAddress" placeholder="<?=tl("address")?>" >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?=tl("amount")?></label>
                            <input type="number" class="form-control" name="sendAmount" placeholder="<?=tl("password")?>" autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><?=tl("comment")?></label>
                            <textarea class="form-control" name="sendComment" placeholder="<?=tl("comment")?>"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary"><?=tl("preview")?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




