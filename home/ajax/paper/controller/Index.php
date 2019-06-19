<?php
class Home_Ajax_Paper_Controller_Index extends Home_Ajax_Controller_Abstract { 
    public function addCommentAction() {
        if($this->isRequestGood()) {
            $this->modele->addComment();
        
            $comments = array("comments" => Home_Paper_Modele_Index::getComments($this->params["post"]["idPaper"]));
            $this->vue->renderAddComment($comments);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
    public function replyAction() {
        if($this->isRequestGood()) {
            $datas = array(
                "rang" => $this->params["post"]["rang"]+1,
                "idParent" => $this->params["post"]["idParent"],
                "avatar" => Home_Openid_Modele_Abstract::getAvatar(),
                "name" => Home_Openid_Modele_Abstract::getName(),
            );
            $this->vue->renderReply($datas);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}