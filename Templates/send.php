<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Send Whitecoin")?></h4>
                    <p >Balance:<?=Whitenode::$clientd->getbalance();?> XWC</p>
                </div>
                <div class="content">

                <form name="send-whitecoin" method="post" id="sendwhitecoin">

                        <div class="form-group">
                            <label for="exampleFormControlInput1" style="display: block;"><?=tl("Send To")?></label>
                            <input type="text" class="form-control" id="send-address"  value="" style="display: inline-block;width: 60%;">
                            <button type="'button" id="js-open-address-book" style="display: inline-block;height:44px;">...</button>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlInput1" style="display: block;"><?=tl("Label")?></label>
                            <input type="text" class="form-control" id="send-label" value="" style="display: inline-block;width: 60%;">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1" style="display: block;"><?=tl("Amount")?></label>
                            <input type="text" class="form-control" id="send-amount" value="" style="display: inline-block;width: 30%;">
                            <select id="send-type" style="display: inline-block;height:44px;">
                                <option>XWC</option>
                                <option>mXWC</option>
                                <option>uXWC</option>
                            </select>
                        </div>
                        
<!--                        <button type="submit" class="btn btn-primary" id="addreceiveaddress">--><?//=tl("Add Receive Address")?><!--</button>-->
                        <button type="reset" class="btn btn-primary"><?=tl("Clear Receive Address")?></button>
                        <button type="submit" class="btn btn-primary" id="js-submit-send"><?=tl("Send")?></button>
                    </form>

                </div>
            </div>
            <div id="js--deal-infor"></div>
        </div>
        <div class="col-md-12">
       
         </div>
    </div>
</div>

<div id="js-select-address-book" title="Basic dialog" hidden>
    <div class="card">
        <div class="content table-responsive table-full-width">
            <table class="table table-striped">
                <thead>
                <th><?=tl("Label")?></th>
                <th><?=tl("Address")?></th>

                </thead>
                <tbody>
                <?php
                $address = DataManager::getInstance()->getAddressOther();
                if(count($address)==0){
                    echo "<tr>
                            <td></td><td></td><td></td>
                         </tr>";
                }else{
                    foreach($address as $d)
                    {
                        ?>
                        <tr id="send-address-select_<?=$d['address']?>">
                            <td id="send-address-label_<?=$d['address']?>"><?=(!empty($d['label'])) ? $d['label'] : $d['label'];?></td>
                            <td id="send-address_value_<?=$d['address']?>"><?=$d['address']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                <?php
                }?>
                
                </tbody>
            </table>

        </div>
    </div>
    <input type="text"  id="send-address-for-select" hidden>
</div>
