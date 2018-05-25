<?php
class Home_Paper_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $month = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        $db = Core_Dbaccess::getInstance();
        $parseDown = new Home_Paper_Modele_Parsedown();
        $userId = 0;
        
        $session = Core_Session::getInstance();
        if($session->hasData(Core_Login_Controller_Index::SESSION_DATA_NAME)) {
            $userData = $session->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
            $userId = $userData["login"]["id"];
        }
        
        $sql = "
            SELECT p.title, p.dateAdd, p.content, p.js
            FROM PAPERS AS p
            WHERE p.id = :idPaper AND (p.active = 1 OR :userId = 1)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array("idPaper" => $this->params[0], ":userId" => $userId));
        
        $ret = array();
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = Datetime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            self::getSince($dateAdd);
            
            $ret["date"] = $dateAdd->format("j")." ".$month[$dateAdd->format("n")-1]." ".$dateAdd->format("Y");
            $ret["publishDate"] = $dateAdd->format("Y-m-d");
            $ret["title"] = $row["title"];
            $ret["content"] = $parseDown->text($row["content"]);
            $ret["mdContent"] = htmlentities(strip_tags($row["content"]), ENT_QUOTES);
            $ret["js"] = $row["js"];
            
            $ret["comments"] = array_slice(self::getComments($this->params[0]), 0, 20);
        }
        
        return $ret;
    }
    
    public static function getComments($idPaper) {
        $db = Core_Dbaccess::getInstance();
        $ret = array();
        
        $sql = "
            SELECT c.id, u.firstname, u.lastname, u.avatar,
            c.content, c.dateAdd
            FROM COMMENTS AS c
            INNER JOIN USER AS u ON u.id = c.idWriter
            WHERE c.idPaper = :idPaper AND c.idParent IS NULL
            ORDER BY c.dateAdd DESC
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array("idPaper" => $idPaper));
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = Datetime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            
            $ret["cmtr-{$row["id"]}"] = $row;
            $ret["cmtr-{$row["id"]}"]["date"] = self::getSince($dateAdd);
            $ret["cmtr-{$row["id"]}"]["rang"] = 0;
            $ret = array_merge($ret, self::getChildComments($row["id"], 1));
        }
     
        return $ret;
    }
    
    private static function getChildComments($idParent, $rang) {
        $db = Core_Dbaccess::getInstance();
        $ret = array();
        
        $sql = "
            SELECT c.id, u.firstname, u.lastname, u.avatar,
            c.content, c.dateAdd
            FROM COMMENTS AS c
            INNER JOIN USER AS u ON u.id = c.idWriter
            WHERE c.idParent = :idParent
            ORDER BY c.dateAdd DESC
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array("idParent" => $idParent));
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateAdd = Datetime::createFromFormat("Y-m-d H:i:s", $row["dateAdd"]);
            
            $ret["cmtr-{$row["id"]}"] = $row;
            $ret["cmtr-{$row["id"]}"]["date"] = self::getSince($dateAdd);
            $ret["cmtr-{$row["id"]}"]["rang"] = $rang;
            $ret = array_merge($ret, self::getChildComments($row["id"], $rang+1));
        }
        
        return $ret;
    }
    
    private static function  getSince($date) {
        $diff = date_diff(new DateTime(), $date);
        $date = $date->format("d/m/Y H:i:s");
        
        if($diff->y > 0) {
            if($diff->m > 0) {
                return "<a href='#' title='{$date}'>Il y a plus de {$diff->y} ans</a>";
            }
            return "<a href='#' title='{$date}'>Il y a environ {$diff->y} ans</a>";
        }
        
        if($diff->m > 0) {
            if($diff->d > 0) {
                return "<a href='#' title='{$date}'>Il y a plus de {$diff->m} mois</a>";
            }
            return "<a href='#' title='{$date}'>Il y a environ {$diff->m} mois</a>";
        }
        
        if($diff->d > 0) {
            return "<a href='#' title='{$date}'>Il y a {$diff->d} jours</a>";
        }
        
        if($diff->h > 0) {
            return "<a href='#' title='{$date}'>Il y a {$diff->h} heures</a>";
        }
        
        if($diff->i > 0) {
            return "<a href='#' title='{$date}'>Il y a {$diff->i} minutes</a>";
        }
        
        if($diff->s > 0) {
            return "<a href='#' title='{$date}'>Il y a {$diff->s} secondes</a>";
        }
        
        return "<a href='#' title='{$date}'>A l'instant</a>";;
    }
}