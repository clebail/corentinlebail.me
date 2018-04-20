<?php
class Home_Ajax_Game_Mine_Vue_Index extends Core_Vue_Abstract {
    public function renderScores($datas) {
        echo $this->callTemplate("/game/mine/score/index", $datas);
    }
}