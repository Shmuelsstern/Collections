<?php

class Facility{

    private $facilityId;
    private $facilityName;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $zip;
    private $NPI;
    private $taxID;

    public function __construct($data){
        $this->facilityId = $data['facility_id'];
        $this->facilityName = $data['facility_name'];
        $this->address1 = $data['address_1'];
        $this->address2 = $data['address_2'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->zip = $data['zip'];
        $this->NPI = $data['NPI'];
        $this->taxID = $data['tax_id'];        
    }

    public function renderInWell(){
        return "<div class='well'>
                    <h3>".$this->facilityName .'</h3>'.
                    $this->address1 .'<br>'.
                    $this->address2 .'<br>'.
                    $this->city .' ' .$this->state .' ' .$this->zip .'<br><br>'.
                    "<div class='row'>
                                <div class='col-xs-6'>
                                    NPI: <strong>".                                    $this->NPI ."</strong>
                                </div>
                                <div class='col-xs-6'>
                                    Tax ID: <strong>".                                    $this->taxID ."</strong>
                                </div>
                    </div>   
                </div>         ";
    }
}

?>