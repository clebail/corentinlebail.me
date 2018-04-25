<?php
class Home_Ajax_Game_Sokoban_Modele_Index extends Core_Modele_Abstract {
    public function getNiveau($niveau) {
        $ok = array(' ', '#', '$', '.', '*', '@', '+');
        $result = array("nbRow" => 0, "nbCol" => 0, "data" => array());
        
        if(($handle = fopen(Core_Clbfw::getBaseDirname()."/data/game/sokoban/level".str_pad($niveau, 4, "0", STR_PAD_LEFT).".xsb", "r")) !== false) {
            while(($line = fgets($handle)) !== false) {
                $resultLine = array();
                
                for($i=0;$i<strlen($line);$i++) {
                    $car = substr($line, $i, 1);
                    if(in_array($car, $ok)) {
                        $resultLine[] = $car;
                    }
                }
                
                $result["nbRow"]++;
                $result["nbCol"] = max($result["nbCol"], count($resultLine));
                $result["data"][] = $resultLine;
            }
            
            fclose($handle);
        }
        
        return $result;
    }
}