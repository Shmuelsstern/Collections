<?php
// select comments, set status, next action, action date from the most recent comment
class Collectible{
    
    private $collectibleId;
    private $monthlyBalance;
    private $beginDOS;
    private $endDOS;
    private $originalBalance;
    private $assignedTo;
    private $isWorkedOn;
    private $linkToOtherCollectible;
    private $status;
    private $nextAction;
    private $nextActionDate;
    private $comments=[];

    public function __construct($data){
        $this->collectibleId=$data['collectible_id'];
        $this->monthlyBalance=$this->checkIfSet($data['monthly_balance']);
        $this->beginDOS=$this->checkIfSet($data['begin_DOS']);
        $this->endDOS=$this->checkIfSet($data['end_DOS']);
        $this->originalBalance=$this->checkIfSet($data['original_balance']);
        $this->assignedTo=$this->checkIfSet($data['assigned_to']);
        $this->isWorkedOn=$this->checkIfSet($data['is_worked_on']);
        $this->linkToOtherCollectible=$this->checkIfSet($data['link_to_other_collectible']);
        $this->setComments();/*
        echo '  *** collectible****';
        print_r($this);*/
    }

    public function checkIfSet($item){
        if(isset($item) && !empty($item)){
            return $item;
        }else{
            return null;
        }
    }

    private function setComments(){
        echo 'comments query';
        $commentsQuery=new PreparedQuery('SELECT * 
                                            FROM comments c
                                            JOIN employees e 
                                            ON c.author_id = e.employee_id
                                            JOIN statuses s 
                                            ON c.status_id = s.status_id
                                            WHERE c.collectible_id = ?
                                            ORDER BY c.date DESC',[$this->collectibleId]);
        $comments= $commentsQuery->getResultsArrayArray(PDO::FETCH_ASSOC);
        $commentsObjects=[];
        foreach($comments as $comment){
            $commentsObjects[]= new Comment($comment);
        }
        $this->comments=$commentsObjects;
        $recentComment=$this->comments[0];
        $this->nextAction= $recentComment->getNextAction();
        $this->nextActionDate= $recentComment->getNextActionDate();
        $this->status= $recentComment->getStatus();
    }

    public function getComments(){
        return $this->comments;
    }

    public function renderCollectible(){
        return '<div class="col-xs-2"><strong>DOS from</strong></br/>'.
                $this->beginDOS.
             '</div>
             <div class="col-xs-2"><strong>DOS through</strong></br/>'.
                $this->endDOS.
             '</div>
             <div class="col-xs-2"><strong>status</strong></br/>'.
                $this->status.
             '</div>
             <div class="col-xs-2"><strong>next action</strong></br/>'.
                $this->nextAction.
             '</div>
             <div class="col-xs-2"><strong>f/u date</strong></br/>'.
                $this->nextActionDate.
             '</div>
             <div class="col-xs-2"><strong>original balance</strong></br/>'.
                $this->originalBalance.
             '</div>';
    }
}
?>