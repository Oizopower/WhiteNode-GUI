<?php
    $cols = (!$icon) ? 12 : 7;
?>
<div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="content">
            <div class="row">
                <?php if($icon) { ?>
                <div class="col-xs-5">
                    <div class="icon-big icon-success text-center">
                        <i class="<?=$icon?>"></i>
                    </div>
                </div>
                <?php } ?>
                <div class="col-xs-<?=$cols?>">
                    <div class="numbers">
                        <p style="white-space: nowrap;"><?=$title?></p>
                        <?=$value?>
                    </div>
                </div>
            </div>
            <div class="footer">
                <hr />
                <div class="stats">
                    <i class="<?=$subicon?>"></i> <?=$subtext?>
                </div>
            </div>
        </div>
    </div>
</div>