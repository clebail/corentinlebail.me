<?php
class Home_Paper_Admin_Edit_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $db = Core_Dbaccess::getInstance();
        $parseDown = new Home_Paper_Modele_Parsedown();
        $ret = array();
        
        $sql = "SELECT id, title, content, js, dateAdd, active FROM PAPERS WHERE id = :id";
            
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(":id" => $this->params["0"]));
        
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = DateTime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            $row["date"] = $dateAdd->format("d/m/Y");
            $row["origContent"] = $row["content"];
            $row["content"] = $parseDown->text($row["content"]);
            
            $ret = $row;
        }
        
        return $ret;
    }
    
    public function save($id) {
        $db = Core_Dbaccess::getInstance();
        
        $date = Datetime::createFromFormat("d/m/Y", $this->params["post"]["dateAdd"]);
        if($date === false) {
            $date = new DateTime();    
        }
        $date = $date->format("Y-m-d");
        
        $sql = "UPDATE PAPERS SET title = :title, content = :content, js = :js, dateAdd = :dateAdd, active = :active WHERE id = :id";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(
            ":title" => $this->params["post"]["title"],
            ":content" => $this->params["post"]["content"],
            ":js" => $this->params["post"]["js"],
            ":dateAdd" => $date,
            ":active" => isset($this->params["post"]["active"]) ? 1 : 0,
            ":id" => $id,
        ));
    }
}