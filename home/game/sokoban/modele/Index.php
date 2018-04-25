<?php
class Home_Game_Sokoban_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $niveaux = array();
        $d = dir(Core_Clbfw::getBaseDirname()."/data/game/sokoban");
        
        while (false !== ($entry = $d->read())) {
            if(preg_match("/level([0-9]{4})\.xsb/", $entry, $matches)) {
                $niveaux[] = intval($matches[1]);
            }
        }
        
        sort($niveaux);
        
        return $niveaux;
    }
}