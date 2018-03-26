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
    
    public function add() {
        $db = Core_Dbaccess::getInstance();
        $userData = Core_Session::getInstance()->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
        
        $sql = "INSERT INTO PAPERS (title, dateAdd, idWriter) SELECT :title, NOW(), :idWriter";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(":title" => $this->params["post"]["titre"], ":idWriter" => $userData["login"]["id"]));
    }
    
    public function delete($id) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "DELETE FROM PAPERS WHERE id = :id";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(":id" => $id));
    }
}