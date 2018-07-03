<?php
class Home_Ajax_Paper_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function loginAction() {
        if($this->isRequestGood()) {
            $modele = new Home_Login_Modele_Index(null);
        
            if($modele->loginSuccess($this->params["post"]["login"], $this->params["post"]["password"], $userData)) {
                Core_Session::getInstance()->setData(Core_Login_Controller_Index::SESSION_DATA_NAME, $userData);
                
                $comments = array("comments" => Home_Paper_Modele_Index::getComments($this->params["post"]["idPaper"]));
                $this->vue->renderLoginOk($comments);
            }else {
                $this->vue->renderError();
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
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
            $userData = Core_Session::getInstance()->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
            $datas = array(
                "rang" => $this->params["post"]["rang"]+1,
                "idParent" => $this->params["post"]["idParent"],
                "avatar" => $userData["login"]["avatar"],
                "firstname" => $userData["login"]["firstname"],
                "lastname" => $userData["login"]["lastname"],
            );
            $this->vue->renderReply($datas);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}