<?php
class Home_Ajax_Game_Sokoban_Vue_Index extends Core_Vue_Abstract {
    public function renderNiveau($datas) {
        echo json_encode($datas);
    }
}