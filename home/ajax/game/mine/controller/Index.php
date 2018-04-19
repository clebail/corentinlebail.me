<?php
class Home_Ajax_Game_Mine_Controller_Index extends Core_Controller_Abstract {
    public function setScoreAction() {
        $this->modele->setScore($this->params["post"]["idUser"], $this->params["post"]["temps"]);
    }
}