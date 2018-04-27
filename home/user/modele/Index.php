<?php
class Home_User_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            SELECT u.id, u.firstname, u.lastname, u.email, u.avatar, u.active
            FROM USER AS u
            ORDER BY u.id
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute();
        
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        
        return $result;
    }
}