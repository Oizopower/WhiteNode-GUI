<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Receive Whitecoin")?></h4>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th><?=tl("Label")?></th>
                            <th><?=tl("Address")?></th>
                            <th><?=tl("Receive")?></th>
                        </thead>
                        <tbody>
                        <?php
                        $address = DataManager::getInstance()->getAddress();
                        if(count($address)==0){
                            echo "<tr>
                                    <td></td><td></td><td></td>
                                 </tr>";
                        }else{
                            foreach($address as $d)
                            {
                                ?>
                                <tr id="select_<?=$d['address']?>">
                                    <td>
                                    <span id="edit_<?=$d['address']?>"><?=(!empty($d['label'])) ? $d['label'] : $d['label'];?></span>
                                    <input style="display:none;" id="input_<?=$d['address']?>" type="text" value="<?=$d['label']?>"/>
                                    </td>
                                    <td id="copy_<?=$d['address']?>"><?=$d['address']?></td>
                                    <td ><?=Wallet::getReceivedByAddress($d['address'])?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        <?php    
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
             <button  class="btn btn-primary" data-toggle="modal" data-target="#new-address" data-title="<?=tl("New Address")?>">
                 <?=tl("New Address")?>
             </button>
             <button  class="btn btn-primary"  id="copyaddress" data-clipboard-target="" style="display: none">
                <?=tl("Copy Address")?>
             </button>
             <button type="submit" class="btn btn-primary" id="signature-btn" data-toggle="modal" data-target="#signature-modal" data-title="<?=tl("Signature")?>"  style="display: none">
                <?=tl("Signature")?>
             </button>
        </div>
    </div>
</div>