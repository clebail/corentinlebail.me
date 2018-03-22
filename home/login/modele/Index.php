<?php
class Home_Login_Modele_Index extends Core_Login_Modele_Index{
	public function loginSuccess($login, $password, &$userDatas) {
	    $db =Core_Dbaccess::getInstance();
	    
	    $sql = "
            SELECT u.id, u.firstname, u.lastname, u.avatar
            FROM USER AS u
            WHERE u.email = :email AND u.password = :password AND active = 1
        ";
	    
	    $stmt = $db->getPdo()->prepare($sql);
	    
	    $stmt->execute(array(
            ":email" => $login,
	        ":password" => md5(Core_Config::getConfigValue("customer/salt").$password),
	    ));
	    
	    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        $userDatas["login"] = $row;
	        return true;
	    }
	    
        return false;
	}
}