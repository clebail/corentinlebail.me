<?php
class Home_Ajax_Paper_Modele_Index extends Core_Modele_Abstract {
    public function addComment() {
        $db = Core_Dbaccess::getInstance();
        
        $userData = Core_Session::getInstance()->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
        
        $sql = "
            INSERT INTO COMMENTS (idParent, idPaper, idWriter, content)
            VALUES(:idParent, :idPaper, :idWriter, :content)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(
            ":idParent" => isset($this->params["post"]["idParent"]) ? $this->params["post"]["idParent"] : NULL, 
            ":idPaper" => $this->params["post"]["idPaper"],
            ":idWriter" => $userData["login"]["id"],
            "content" => $this->params["post"]["comment"],
        ));
    }
}