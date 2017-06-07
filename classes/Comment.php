<?php

Class Comment{

    private $commentId;
    private $authorId;
    private $author;
    private $collectibleId;
    private $comment;
    private $callRefNumber;
    private $date;
    private $nextAction;
    private $nextActionDate;
    private $statusId;
    private $status;

    public function __construct($data){
        $this->commentId=$data['comment_id'];
        $this->authorId=$data['author_id'];
        $this->author=$data['first_name'].' '.$data['last_name'];
        $this->collectibleId=$data['collectible_id'];
        $this->comment=$data['comment'];
        $this->callRefNumber=$this->checkIfSet($data['call_ref#']);
        $this->date=$data['date'];
        $this->nextAction=$data['next_action'];
        $this->nextActionDate=$this->checkIfSet($data['next_action_date']);
        $this->statusId=$this->checkIfSet($data['status_id']);
        $this->status=$this->checkIfSet($data['status']);
    }

    public function checkIfSet($item){
        if(isset($item) && !empty($item)){
            return $item;
        }else{
            return null;
        }
    }

    public function getNextAction(){
        return $this->nextAction;
    }

    public function getNextActionDate(){
        return $this->nextActionDate;
    }

    public function getStatus(){
        return $this->status;
    }

    public function render(){
        return '<span class="dateHeader">'.$this->date.'</span>'
                .$this->comment.$this->getCallRefNumberLine().
                '<em>'.$this->nextAction.'</em> follow up by: '.$this->nextActionDate.
                '<div class="pull-right">author '.$this->author.' </div>';
    }

    private function getCallRefNumberLine(){
        if($this->callRefNumber){
            return '<span class="pull-right">call ref#  '.$this->callRefNumber.'</span>';
        }else{
            return '';
        }
    }    
}
?>