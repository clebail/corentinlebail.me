<?php
class Home_Modele_Index extends Core_Modele_Abstract {
    public static function isLoggedIn() {
        return Core_Session::getInstance()->hasData(Core_Login_Controller_Index::SESSION_DATA_NAME);
    }
    
    public static function getCurrentUserId() {
        if(self::isLoggedIn()) {
            $userData = Core_Session::getInstance()->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
            
            return $userData["login"]["id"];
        }
        
        return null;
    }
    
    public function logout() {
        Core_Session::getInstance()->destroy();
    }
    
    public function getContent() {
        $month = array("Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec");
        
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            SELECT p.id, p.title, p.dateAdd
            FROM PAPERS AS p
            WHERE active = 1
            ORDER BY p.dateAdd DESC
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute();
        
        $ret = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = Datetime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            
            $ret[$dateAdd->format("Y")][$row["id"]] = array("title" => $row["title"], "date" => $dateAdd->format("j")." ".$month[$dateAdd->format("n")]);
        }
        
        return $ret;
    }
    
    public static function rot5($str) {
        return strtr($str, "0123456789", "5678901234");
    }    
}