<?php
class Home_Game_Mine_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            SELECT u.firstname, u.lastname, gms.temps, gms.`date`
            FROM GAME_MINE_SCORE AS gms
            INNER JOIN USER AS u ON u.id = gms.idUser
            ORDER BY gms.temps
            LIMIT 10
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute();
        
        $ret = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = Datetime::createFromFormat("Y-m-d H:i:s", $row["date"]);
            $row["date"] = $date->format("d/m/Y H:i:s");
            
            $ret[] = $row; 
        }
        
        return $ret;
    }
}