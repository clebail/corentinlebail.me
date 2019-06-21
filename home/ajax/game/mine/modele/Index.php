<?php
class Home_Ajax_Game_Mine_Modele_Index extends Core_Modele_Abstract {
    public function setScore($temps) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            INSERT INTO GAME_MINE_SCORE (idUser, temps)
            SELECT u.id, :temps
            FROM USER AS u
            WHERE u.provider = :provider AND u.email = :email
            ON DUPLICATE KEY UPDATE `date` = IF(:temps < temps, :date, `date`), temps = IF(:temps < temps, :temps, temps)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        try {
            $stmt->execute(array(
                ":temps" => $temps,
                ":date" => (new Datetime())->format("Y-m-d H:i:s"),
                ":provider" => Home_Openid_Modele_Abstract::getProvider(),
                ":email" => Home_Openid_Modele_Abstract::getEmail(),
            ));
            
            $modele = new Home_Game_Mine_Modele_Index(null);
            
            return $modele->getContent();
        }catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
    }
}