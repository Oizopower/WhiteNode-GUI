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
                        <input type="password" class="form-control" id="js--encryptpassword">
                    </div>
                </form>
                <div class="form-group">
                    <label for="recipient-verify" class="control-label"><?=tl("verify password")?>:</label>
                    <input type="password" class="form-control" id="js--encryptpassword-verify">
                </div
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="js--submitencrypt">Send</button>
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