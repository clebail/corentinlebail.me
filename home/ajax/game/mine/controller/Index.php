<?php
class Home_Ajax_Game_Mine_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function setScoreAction() {
        if($this->isRequestGood()) {
            $datas = $this->modele->setScore($this->params["post"]["temps"]);
            $this->vue->renderScores($datas);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}