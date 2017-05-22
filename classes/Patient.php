<?php

class Patient{

    private $firstName;
    private $lastName;
    private $middleName;
    private $DOB;
    private $medicaidId;
    private $medicareId;
    private $ssId;
    private $otherInsurer1;
    private $otherInsurer1Id;
    private $otherInsurer2;
    private $otherInsurer2Id;
    private $facilityPatientId;
    private $patientId;

    public function __construct($dataObject){
        $this->firstName = $dataObject['first_name'];
        $this->lastName = $dataObject['last_name'];
        $this->middleName = $dataObject['middle_name'];
        $this->DOB = $dataObject['DOB'];
        $this->medicaidId = $dataObject['medicaid_id'];
        $this->medicareId = $dataObject['medicare_id'];
        $this->ssId = $dataObject['ss_id'];
        $this->otherInsurer1=$dataObject['other_insurer_1'];
        $this->otherInsurer1Id=$dataObject['other_insurer_1_id'];
        $this->otherInsurer2=$dataObject['other_insurer_2'];
        $this->otherInsurer2Id=$dataObject['other_insurer_2_id'];
        $this->facilityPatientId= $dataObject['facility_patient_id'];
        $this->patientId= $dataObject['patient_id'];
    }

    public function renderInWell(){
            
            return "<div class ='well'>
                        <h3>" . $this->firstName .' '. $this->middleName .' '. $this->lastName . ' ('. $this->facilityPatientId.')</h3>'.
                        "<div class='row'>
                            <div class='col-xs-6'>
                                DOB: <strong>". $this->DOB . "</strong>
                            </div>
                            <div class='col-xs-6'>
                                SS#: <strong>". $this->ssId . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Medicare: <strong>". $this->medicareId . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Medicaid: <strong>". $this->medicaidId . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Insurance1: <strong>". $this->otherInsurer1 . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Policy#: <strong>". $this->otherInsurer1Id . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Insurance2: <strong>". $this->otherInsurer2 . "</strong>
                            </div>
                            <div class='col-xs-6 padding-right-0'>
                                Policy#: <strong>". $this->otherInsurer2Id . "</strong>
                            </div>
                        </div> 
                    </div>";
                        
        }

        
}
?>