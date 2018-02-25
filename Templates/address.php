<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Address book</h4>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <th><?=tl("Label")?></th>
                    <th><?=tl("Address")?></th>

                    </thead>
                    <tbody>
                    <?php
                    $address = DataManager::getInstance()->getAddressOther();
                    //print_r($address);
                    foreach($address as $d)
                    {
                        ?>
                        <tr id="other-address-select_<?=$d['address']?>">
                            <td id="other-address-label_<?=$d['address']?>"><?=(!empty($d['label'])) ? $d['label'] : $d['label'];?></td>
                            <td id="other-address_value_<?=$d['address']?>"><?=$d['address']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                  
            </div>
           
        </div>
       
    </div>
    <div class="col-md-12">
        <button  class="btn btn-primary" data-toggle="modal" data-target="#other-address-add" data-title="<?=tl("New Address")?>"><?=tl("New Address")?></button>
        <button type="reset" class="btn btn-primary"  id="other-address-copy"><?=tl("Copy Address")?></button>
        <button type="submit" class="btn btn-primary" id="other-address-delete"><?=tl("Delete")?></button>
        <input type="text"  id="other-address-for-delete" hidden>
    </div>
    
</div>
</div>
