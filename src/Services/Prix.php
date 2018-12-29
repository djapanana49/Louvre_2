<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Entity\Reservations;
use DateTime;

class Prix  {

    public function findPrice(Reservations $reservations) {
        
        $billets = $reservations->getBillets();
            foreach ($billets as $billet) {
                $date = $billet->getDateDeNaissance();
                $date2 = new DateTime("now");
                $date->format('d/m/Y');
                $date2->format('d/m/Y');
                $interval = $date->diff($date2);
                $age = (int) $interval->y;
                switch($reservations->getJournee()){
                    case true:
                    if ($billet->getReduit()==true){
                        $prix=$billet->setTarif(10);
                    }
               
                    else if ($age >= 12) {
                        $billet->setTarif(16);
                    } else if ($age >= 60) {
                        $billet->setTarif(12);
                    } else if (($age >= 4) && ($age < 12)) {
                        $billet->setTarif(8);
                    }
                    else if (($age == 0) && ($age < 4)) {
                        $billet->setTarif(0);
                    }
                    break;
                    case false:
                        if ($billet->getReduit()==true){
                        $billet->setTarif(5);
                    }
               
                    else if ($age >= 12) {
                        $billet->setTarif(8);
                    } else if ($age >= 60) {
                        $billet->setTarif(6);
                    } else if (($age >= 4) && ($age < 12)) {
                        $billet->setTarif(4);
                    }
                    else if (($age == 0) && ($age < 4)) {
                        $billet->setTarif(0);
                    }
                    break;
                    default: echo'Veuillez choisir une option svp';break;
        }
     }
    }

}
