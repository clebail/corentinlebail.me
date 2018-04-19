<?php
class Home_Ajax_Game_Mine_Modele_Index extends Core_Modele_Abstract {
    public function setScore($idUser, $temps) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "INSERT INTO GAME_MINE_SCORE (idUser, temps) VALUES (:idUser, :temps) ON DUPLICATE KEY UPDATE temps = IF(:temps < temps, :temps, temps)";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(":idUser" => $idUser, ":temps" => $temps));
    }
}