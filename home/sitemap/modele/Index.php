<?php
class Home_Sitemap_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            SELECT p.id FROM PAPERS AS p
            WHERE p.active = 1
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute();
        
        $ret = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ret[] = Home_Paper_Controller_Index::getUrl("index", "index", array($row["id"]), true);
        }
        
        return $ret;
    }
}