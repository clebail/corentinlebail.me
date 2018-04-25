<?php
class Home_Ajax_Game_Sokoban_Controller_Index extends Core_Controller_Abstract {
    public function getNiveauAction() {
        $datas = $this->modele->getNiveau($this->params["post"]["niveau"]);
        $this->vue->renderNiveau($datas);
    }
}