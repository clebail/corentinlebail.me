<?php
class Home_Ajax_Paper_Modele_Index extends Core_Modele_Abstract {
    public function addComment() {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            INSERT INTO COMMENTS (idParent, idPaper, idWriter, content)
            VALUES(:idParent, :idPaper, :idWriter, :content)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        try {
            $stmt->execute(array(
                ":idParent" => isset($this->params["post"]["idParent"]) ? $this->params["post"]["idParent"] : NULL, 
                ":idPaper" => $this->params["post"]["idPaper"],
                ":idWriter" => Home_Modele_Index::getCurrentUserId(),
                "content" => $this->params["post"]["comment"],
            ));
        } catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
    }
}