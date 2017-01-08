<?php

class BalancesModel extends BaseModel {

    function originalSpreadsheet($agingID){
        $originalSpreadsheet =new AgingSpreadsheet1($agingID);
        return $originalSpreadsheet->getOriginalSpreadsheet();
    }
}

?>