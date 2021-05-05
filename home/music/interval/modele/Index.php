<?php
class Home_Music_Interval_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
		$notes = array("Do", "Do#", "Ré", "Ré#", "Mi", "Fa", "Fa#", "Sol", "Sol#", "La ", "Sib", "Si");
        $intervals = array(
            "T" => "#F76D82",
            "2m" => "#B4E080",
            "2" => "#9ED36A",
            "3m" => "#62DDBD",
            "3" => "#46CEAD",
            "4" => "#FC8370",
            "5b" => "#B3A5EF",
            "5" => "#AC92EA",
            "6m" => "#FCD277",
            "6" => "#FECD57",
            "7" => "#F299CE",
            "7M" => "#EB87BF"
        );

        $modes = array(
            "ionien / M" => array(2, 2, 1, 2, 2, 2, 1),
            "dorien" => array(2, 1, 2, 2, 2, 1, 2),
            "phrygien" => array(1, 2, 2, 2, 1, 2, 2),
            "lydien" => array(2, 2, 2, 1, 2, 2, 1),
            "mixolydien" => array(2, 2, 1, 2, 2, 1, 2),
            "eolien / m" => array(2, 1, 2, 2, 1, 2, 2),
            "locrien" => array(1, 2, 2, 1, 2, 2, 2),
        );
        
        return array(
            "notes" => $notes,
            "intervals" => $intervals,
            "modes" => $modes);
 	}
}
