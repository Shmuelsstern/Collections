<?php

Class NavbarModel extends BaseModel{

    private $facilities;
    private $username;
    private $agingListArrays=[];

    public function __construct(){
        $this->facilities=$this->getFacilities();
        $this->username=$_SESSION['user'];
        if((!$this->isSetSessionFacility())){$this->setSessionFacility($this->getDefaultFacility());}
        $this->setAgingList();
    }

    function getFacilities(){
        //selecting only role of user not set up yet
        $facilityQuery=new Query('SELECT `facility_name` 
                                  FROM `facilities` ');
        $facilitiesARYARY= $facilityQuery->getResultsArrayArray();
        $facilities=[];
        foreach($facilitiesARYARY as $facilitiesARY){
            $facilities[]=$facilitiesARY[0];
        }
        return $facilities;
    }

    function getNavbarData(){
        $data=[];
        foreach($this as $key=> $value){
            $data[$key]=$value;
        }
        return $data;
    }

    function isSetSessionFacility(){
        if(!isset($_SESSION['facility'])){
            return false;
        }else{
            return true;
        }
    }

    function getDefaultFacility(){
        return $this->facilities[0];
    }

    function setSessionFacility($facility){
        return $_SESSION['facility']=$facility;
    }

    function setAgingList(){
            $agingQuery= new PreparedQuery("SELECT at.aging_id as aging_id, at.aging_name as aging_name
                                            FROM aging_table at 
                                            JOIN facilities f 
                                            ON at.facility_id = f.facility_id
                                            WHERE f.facility_name =?",[$_SESSION['facility']]);
            return $this->agingListArrays=$agingQuery->getResultsArrayArray();
    }
}

?>