<?php
class Home_Ajax_Game_Mine_Controller_Index extends Core_Controller_Abstract {
    public function setScoreAction() {
        $datas = $this->modele->setScore($this->params["post"]["temps"]);
        $this->vue->renderScores($datas);
    }
}