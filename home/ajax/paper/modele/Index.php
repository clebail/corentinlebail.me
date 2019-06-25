<?php
class Home_Ajax_Paper_Modele_Index extends Core_Modele_Abstract {
    public function addComment() {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            INSERT INTO COMMENTS (idParent, idPaper, idWriter, content)
            SELECT :idParent, :idPaper, u.id, :content
            FROM USER AS u
            WHERE u.provider = :provider AND u.email = :email
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        try {
            $values = array(
                ":idParent" => isset($this->params["post"]["idParent"]) ? $this->params["post"]["idParent"] : NULL, 
                ":idPaper" => $this->params["post"]["idPaper"],
                ":content" => $this->params["post"]["comment"],
                ":provider" => Home_Openid_Modele_Abstract::getProvider(),
                ":email" => Home_Openid_Modele_Abstract::getEmail(),
            );
            
            $stmt->execute($values);
        } catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
    }
}