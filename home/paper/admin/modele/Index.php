<?php
class Home_Paper_Admin_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $db = Core_Dbaccess::getInstance();
        $ret = array();
        
        $sql = "SELECT id, title, dateAdd, active FROM PAPERS ORDER BY dateAdd DESC";
            
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = DateTime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            $row["dateAdd"] = $dateAdd->format("d/m/Y");
            
            $ret[] = $row;
        }
        
        return $ret;
    }
}