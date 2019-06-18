<?php
class Home_Ajax_Game_Sokoban_Modele_Index extends Core_Modele_Abstract {
    public function getNiveau($niveau) {
        $ok = array(' ', '#', '$', '.', '*', '@', '+');
        $result = array("nbRow" => 0, "nbCol" => 0, "data" => array(), "scores" => array());
        
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
        
        $result["scores"] = $this->getScores($niveau);
        
        return $result;
    }
    
    public function setScore($niveau, $nbMove, $nbPush) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            INSERT INTO GAME_SOKOBAN_SCORE (niveau, idUser, nbMove, nbPush)
            SELECT :niveau, u.id, :nbMove, :nbPush
            FROM USER AS u
            WHERE u.email = :email
            ON DUPLICATE KEY UPDATE `date` = IF(:nbMove < nbMove OR :nbPush < nbPush, :date, `date`), nbMove = IF(:nbMove < nbMove OR :nbPush < nbPush, :nbMove, nbMove), nbPush = IF(:nbMove < nbMove OR :nbPush < nbPush, :nbPush, nbPush)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        try {
            $stmt->execute(array(
                ":niveau" => $niveau,
                ":nbMove" => $nbMove,
                ":nbPush" => $nbPush,
                ":date" => (new Datetime())->format("Y-m-d H:i:s"),
                ":email" => Home_Openid_Google_Modele_Index::getEmail(),
            ));
            
            return $this->getScores($niveau);
        }catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
    }
    
    private function getScores($niveau) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            SELECT u.name, gss.nbPush, gss.nbMove, gss.date
            FROM GAME_SOKOBAN_SCORE AS gss
            INNER JOIN USER AS u ON u.id = gss.iduser
            WHERE gss.niveau = :niveau
            ORDER BY CONCAT(LPAD(gss.nbPush, 10, '0'), '-', LPAD(gss.nbMove, 10, '0')) LIMIT 10
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(":niveau" => $niveau));
        
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = Datetime::createFromFormat("Y-m-d H:i:s", $row["date"]);
            $row["date"] = $date->format("d/m/Y H:i:s");
            
            $result[] = $row;
        }
        
        return $result;
    }
}