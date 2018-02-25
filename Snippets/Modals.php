<div id="encrypt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <div id="js--encrypt-error"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Password:</label>
                        <input type="password" class="form-control" id="encryptpassword">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitencrypt">Send</button>
            </div>
        </div>
    </div>
</div>

<div id="changepasswd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <div id="js--changepasswd-error"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Old Password:</label>
                        <input type="password" class="form-control" id="oldpasswdvalue_input">
                        <?php 
                            $password = DataManager::getInstance()->getPassword();
                            //print_r($password);
                            $cfgpasswd = $password[0]['passwd'];
                           // print_r($cfgpasswd);
                        ?>
                        <input type="password" value="<?php echo $cfgpasswd; ?>" class="form-control" id="oldpasswdvalue_conf" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">New Password:</label>
                        <input type="password" class="form-control" id="changepasswdvalue">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmpasswdvalue">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitchangepasswd">Send</button>
            </div>
        </div>
    </div>
</div>

<div id="stakepassword" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <div id="js--unlock-error"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Password:</label>
                        <input type="password" class="form-control" id="unlockpassword">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitpass">Send</button>
            </div>
        </div>
    </div>
</div>

<div id="new-address" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitnewaddress">Ok</button>
            </div>
        </div>
    </div>
</div>

<div id="other-address-add" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <div id="js--newaddress-error"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label"><?=tl("Label")?>:</label>
                        <input type="text" class="form-control" id="other-address-lable">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label"><?=tl("Address")?>:</label>
                        <input type="text" class="form-control" id="ohter-address-value">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="other-address-commit">Ok</button>
            </div>
        </div>
    </div>
</div>

<div id="signature-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#sign" aria-controls="sign" role="tab" data-toggle="tab"><?=tl("Sign Message Label")?></a></li>
                    <li role="presentation"><a href="#vail" aria-controls="vail" role="tab" data-toggle="tab"><?=tl("Verify Message Label")?></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="sign">
                        <form>
                            <span><?=tl("Signature Tips")?></span>
                            <input type="text" class="form-control signature-address" placeholder="<?=tl("Whitecoin Address Input Hint")?>" id="whitecoin-address">
                            <textarea class="form-control" rows="3" id="sign-message" placeholder="<?=tl("Sign Message")?>"></textarea>
                            <input type="text" class="form-control" placeholder="<?=tl("Create Signature Message Hint")?>" id="signature">
                            <button type="button" class="btn btn-primary" id="signature-message-btn"><?=tl("Sign Message Label")?></button>
                            <input type="reset" class="btn btn-default reset-btn" value="Reset" />
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="vail">
                        <form>
                            <span><?=tl("Validation Tips")?></span>
                            <input type="text" class="form-control signature-address" placeholder="<?=tl("Whitecoin Address Input Hint")?>" id="whitecoin-address-v">
                            <textarea class="form-control" rows="3" id="sign-message-v"></textarea>
                            <input type="text" class="form-control" placeholder="<?=tl("Enter Whitecoin Signature")?>" id="signature-v">
                            <button type="button" class="btn btn-primary" id="validation-message-btn"><?=tl("Verify Message Label")?></button>
                            <input type="reset" class="btn btn-default reset-btn" value="Reset" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <!-- <button type="button" class="btn btn-primary" id="submitnewaddress">Ok</button> -->
            </div>
        </div>
    </div>
</div>


<div id="open-address-book" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Window</h4>
            </div>
            <div class="modal-body">
                <div id="js--newaddress-error"></div>
                <form role="form">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label"><?=tl("Label")?>:</label>
                        <input type="text" class="form-control" id="other-address-lable">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label"><?=tl("Address")?>:</label>
                        <input type="text" class="form-control" id="ohter-address-value">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="other-address-commit">Ok</button>
            </div>
        </div>
    </div>