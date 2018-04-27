<?php
class Home_Ajax_User_Modele_Index extends Core_Modele_Abstract {
    public function active($id, $active) {
        $db = Core_Dbaccess::getInstance();
        
        $sql = "
            UPDATE USER SET active = :active WHERE id = :id
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        try {
            $stmt->execute(array(
                ":active" => strtoupper($active) == "TRUE" ? 1 : 0,
                ":id" => $id,
            ));
        }catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
    }
}