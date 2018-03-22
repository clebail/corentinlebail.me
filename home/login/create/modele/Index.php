<?php
class Home_Login_Create_Modele_Index extends Core_Modele_Abstract {
    public function create() {
        $db =Core_Dbaccess::getInstance();
        
        $ok = false;
        
        if(isset($this->params["post"]["g-recaptcha-response"])) {
            if($this->validRecaptcha($this->params["post"]["g-recaptcha-response"])) {
                try {
                    $hash = md5($this->params["post"]["firstname"]." ".$this->params["post"]["lastname"]);
                    $avatarpath = Core_Config::getConfigValue("avatars/path").$hash.".png";
                   
                    $sql = "
                        INSERT INTO USER (firstname, lastname, email, password, comments, avatar)
                        VALUES (:firstname, :lastname, :email, :password, :comments, :avatar)
                    ";
                    
                    $stmt = $db->getPdo()->prepare($sql);
                    
                    $stmt->execute(array(
                        ":firstname" => $this->params["post"]["firstname"],
                        ":lastname" => $this->params["post"]["lastname"],
                        ":email" => $this->params["post"]["email"],
                        ":password" => md5(Core_Config::getConfigValue("customer/salt").$this->params["post"]["password"]),
                        ":comments" => $this->params["post"]["comments"],
                        ":avatar" => $hash.".png",
                    ));
                    
                    $avatar = $this->createAvatar($hash);
                    imagepng($avatar, $avatarpath);
                    
                    $ok = $stmt->rowCount() == 1;
                }catch(Exception $e) {
                    Core_Clbfw::log("Ouverture de compte : ".$e->getMessage());
                }
            }
        }
        
        if($ok == 1) {
            $message = "";
            $message .="<ul>";
            $message .="<li>Prénom : {$this->params["post"]["firstname"]}</li>";
            $message .="<li>Nom : {$this->params["post"]["lastname"]}</li>";
            $message .="<li>Email : {$this->params["post"]["email"]}</li>";
            $message .="<li>Commentaires :<br />{$this->params["post"]["comments"]}</li>";
            $message .="</ul>";
            
            Core_Clbfw::sendHTMLMail("no-reply@corentinlebail.me", "no-reply@corentinlebail.me", "corentin.lebail@gmail.com", "Demande de création de compte", $message);
            
            return true;
        }
        
        return false;
    }
    
    private function validRecaptcha($responseKey) {
        try {
            $url = Core_Config::getConfigValue("captcha/endpoint");
           
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_POST, 2);
            curl_setopt($ch,CURLOPT_POSTFIELDS, "secret=".Core_Config::getConfigValue("captcha/secretKey")."&response={$responseKey}");
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($response, true);
            
            return $response["success"];
        }catch(Exception $e) {
            Core_Clbfw::log($e->getMessage());
        }
        
        return false;
    }
    
    private function createAvatar($hash) {
        $arrayOfSquare = array();
        preg_match_all('/(\w)(\w)/', $hash, $chars);
        
        foreach ($chars[1] as $i => $char) {
            $index = (int) ($i / 3);
            $data = (bool) round(hexdec($char) / 10);
            $items = [
                0 => [0, 4],
                1 => [1, 3],
                2 => [2],
            ];
            
            
            foreach ($items[$i % 3] as $item) {
                $arrayOfSquare[$index][$item] = $data;
            }
            ksort($arrayOfSquare[$index]);
        }
        $color = array_map(function ($data) {
            return hexdec($data) * 16;
        }, array_reverse($chars[1]));
        
        $generatedImage = imagecreatetruecolor(100, 100);
        $background = imagecolorallocate($generatedImage, 0, 0, 0);
        imagecolortransparent($generatedImage, $background);
        $gdColor = imagecolorallocate($generatedImage, $color[0], $color[1], $color[2]);
        
        foreach($arrayOfSquare as $lineKey => $lineValue) {
            foreach($lineValue as $colKey => $colValue) {
                if(true === $colValue) {
                    imagefilledrectangle($generatedImage, $colKey * 20, $lineKey * 20, ($colKey + 1) * 20, ($lineKey + 1) * 20, $gdColor);
                }
            }
        }
        
        return $generatedImage;
    }
}