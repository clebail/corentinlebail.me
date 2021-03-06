<?php
class Home_Ajax_Game_Sokoban_Vue_Index extends Core_Vue_Abstract {
    public function renderNiveau($datas) {
        $datas["scores"] = $this->callTemplate("/game/sokoban/score/index", $datas["scores"]);
        echo json_encode($datas);
    }
    
    public function renderScores($datas) {
        echo $this->callTemplate("/game/sokoban/score/index", $datas);
    }
}