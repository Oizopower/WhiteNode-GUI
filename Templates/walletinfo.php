<?php
    $info = Whitenode::$clientd->getinfo();

    if(!empty($info))
    {
        foreach($info as $infKey => $infValue)
        {
            if(!empty($infValue))
            {
                if(is_array($infValue))
                {
                    foreach($infValue as $infKey2 => $infValue2)
                    {
                        Template::addBlock(false,$infKey.' - '.$infKey2,$infValue2,'','');
                    }
                }
                else
                {
                    Template::addBlock(false,$infKey,$infValue,'','');
                }
            }

        }
    }