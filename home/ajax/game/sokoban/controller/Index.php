<?php
class Home_Ajax_Game_Sokoban_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function getNiveauAction() {
        if($this->isRequestGood()) {
            $datas = $this->modele->getNiveau($this->params["post"]["niveau"]);
            $this->vue->renderNiveau($datas);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
    public function setScoreAction() {
        if($this->isRequestGood()) {
            $datas = $this->modele->setScore($this->params["post"]["niveau"], $this->params["post"]["nbMove"], $this->params["post"]["nbPush"]);
            $this->vue->renderScores($datas);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}