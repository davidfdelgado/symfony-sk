<?php

namespace AppBundle\Helper;


use AppBundle\Entity\ArtikelKategorie;

class Widget {

    public function __construct()
    {

    }

    public function ZeitenWandler(ArtikelKategorie $kategorie){

        $kat = $kategorie->getAKId();
        if(!intval($kat)) {
            return false;
        }

        $zeiten = array();
        $info_cache = array();
        $info = array();
        $min = null;
        $max = null;
        $zeitraum_von = date('Y-m-d');
        $zeitraum_bis = date('Y-m-d', strtotime('+3 Month'));


        $table_zeiten = array();
        foreach($kategorie->getAKZeitenTabelle() as $tabelle){

            $table_zeiten[$kategorie->getAKId()][$tabelle->getAztId()]['von'] = $tabelle->getAztVon()->format('Y-m-d');
            $table_zeiten[$kategorie->getAKId()][$tabelle->getAztId()]['bis'] = $tabelle->getAztBis()->format('Y-m-d');

            foreach($tabelle->getAztZeiten() as $zeit){

            $table_zeiten[$kategorie->getAKId()][$tabelle->getAztId()]['wochentage'][$zeit->getAzDay()]['zeiten'][$zeit->getAzTime()->format('H:i')]['info'] = $zeit->getAzZusatz();
            $table_zeiten[$kategorie->getAKId()][$tabelle->getAztId()]['wochentage'][$zeit->getAzDay()]['zeiten'][$zeit->getAzTime()->format('H:i')]['typ'] = $zeit->getAzTyp();
            }



        }

        $table_index = $zeitraum_von;

        while($table_index < $zeitraum_bis){
            if(array_key_exists($kat, $table_zeiten) && is_array($table_zeiten[$kat])){
                foreach($table_zeiten[$kat] as $tabelle){

                    $wday = date('w', strtotime($table_index));

                    if($table_index >= $tabelle['von'] && $table_index <= $tabelle['bis'] && array_key_exists($wday, $tabelle['wochentage']) && sizeof($tabelle['wochentage'][$wday]['zeiten'])){

                        $monat_info = strftime('%B', strtotime($table_index));
                        $erste_zeit = null;

                        $info_cache[$monat_info] = array();

                        foreach($tabelle['wochentage'][$wday]['zeiten'] as $zeit => $status){

                            if($status['typ'] == 2 && !$erste_zeit){
                                $erste_zeit = $zeit;
                            } else {
                                if($erste_zeit && $status['typ'] == 2){
                                    $zeiten[$table_index][$zeit]['open'] = date('H:i', strtotime($erste_zeit))." - ".date('H:i', strtotime($zeit));
                                    $erste_zeit = null;
                                } else {
                                    $zeiten[$table_index][$zeit]['uhrzeit'] = $zeit;
                                }

                                $min = !$min ? $table_index : ($min < $table_index ? $min : $table_index);

                                $max = $max > $table_index ? $max : $table_index;

                                $s_index = "";

                                $s_a = sizeof($info_cache[$monat_info]);

                                if($status['info']){
                                    if($status['info']){
                                        if(!in_array($status['info'], $info_cache[$monat_info])) {

                                            while($s_a >= 0) {
                                                $s_index .= '*';
                                                $s_a--;
                                            }

                                            $info[$monat_info][$s_index] = $info_cache[$monat_info][] = $status['info'];

                                        } else {
                                            $s_a = array_search($status['info'], $info_cache[$monat_info]);
                                            while($s_a >= 0) {
                                                $s_index .= '*';
                                                $s_a--;
                                            }

                                            $info[$monat_info][$s_index] = $status['info'];
                                        }

                                        $zeiten[$table_index][$zeit]['info'] = $s_index;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $table_index = date('Y-m-d', strtotime($table_index." +1 day"));
        }

        foreach($kategorie->getAKZeiten() as $zeit){

            $datum = $zeit->getAAbDatum()->format('Y-m-d');
            $monat_info = $zeit->getAAbDatum()->format('M');
            $uhrzeit = $zeit->getAAbDatum()->format('H:i:s');

            if($datum >= date('Y-m-d')){

                $interval_zeit = $zeit->getAAbInterval()->format('H:i:s');
                $interval_ende_zeit = $zeit->getAAbIntEnde()->format('H:i:s');

                if($interval_zeit > '00:00:00') {

                    if($interval_zeit && $uhrzeit < $interval_ende_zeit) {

                        $anfang     =   $uhrzeit;
                        $ende       =   $interval_ende_zeit;

                        $interval = ($zeit->getAAbInterval()->format('H') * 60 * 60) + ($zeit->getAAbInterval()->format('i') * 60 ) + $zeit->getAAbInterval()->format('s');
                        $i = 0;
                        while($anfang <= $ende) {
                            $zeiten[$datum][$anfang]['uhrzeit'] = $anfang;
                            $s_index = "";

                            if($row['a_ab_info']) {
                                $s_a = sizeof($info_cache[$monat_info]);

                                if(!in_array($row['a_ab_info'], $info_cache[$monat_info])) {


                                    while($s_a>=0) {
                                        $s_index .= '*';
                                        $s_a--;
                                    }
                                    $info[$monat_info][$s_index] = $info_cache[$monat_info][] = $zeit->getAAbInfo();
                                } else {
                                    $s_a = array_search($zeit->getAAbInfo(), $info_cache[$monat_info]);
                                    while($s_a >= 0) {
                                        $s_index .= '*';
                                        $s_a--;
                                    }
                                    $info[$monat_info][$s_index] = $zeit->getAAbInfo();
                                }

                                $zeiten[$datum][$anfang]['info'] = $s_index;
                            }
                            $anfang = date('H:i:s', strtotime($anfang) + $interval);
                        }

                    }
                } else {

                    $datum_time = $uhrzeit;

                    if($zeit->getAAbTyp() == 1){ // Ergänzende Zeiten

                        $zeiten[$datum][$uhrzeit]['uhrzeit'] = $datum_time;

                        if($zeit->getAAbInfo()) {

                            $s_index = "";

                            $s_a = sizeof($info_cache[$monat_info]);


                            if(!in_array($zeit->getAAbInfo(), $info_cache[$monat_info])) {

                                while($s_a >= 0) {
                                    $s_index .= '*';
                                    $s_a--;
                                }

                                $info[$monat_info][$s_index] = $info_cache[$monat_info][] = $zeit->getAAbInfo();

                            } else {
                                $s_a = array_search($zeit->getAAbInfo(), $info_cache[$monat_info]);
                                while($s_a >= 0) {
                                    $s_index .= '*';
                                    $s_a--;
                                }

                                $info[$monat_info][$s_index] = $zeit->getAAbInfo();

                            }

                            $zeiten[$datum][$uhrzeit]['info'] = $s_index;
                        }
                    } elseif($zeit->getAAbTyp() == 2) { // Ausschliessende Zeiten...
                        if($datum_time == "00:00:00"){
                            unset($zeiten[$datum]); // Schliesst den gesammten Tag aus
                        } else {
                            if(is_array($zeiten[$datum][$datum_time])){
                                unset($zeiten[$datum][$datum_time]); // Schliesst nur diese Zeit aus.
                            }

                        }
                    }

                }
                $min = !$min ? $datum : ($min < $datum ? $min : $datum);
                $max = $max > $datum ? $max : $datum;

            }
        }

        $kalendar = array();

        if(sizeof($zeiten)) {

            setlocale(LC_ALL, "de_DE");

            $min_wt = date('w', strtotime($min));

            if ($min_wt > 1) {
                while (1 < $min_wt) {

                    $min = date('Y-m-d', strtotime($min) - 24 * 3600);
                    $min_wt = $min_wt - 1;
                }

            }

            $max_wt = date('w', strtotime($max));

            if ($max_wt < 7 && $max_wt != 0) {
                while (7 > $max_wt) {

                    $max = date('Y-m-d', strtotime($max) + 24 * 3600);
                    $max_wt = $max_wt + 1;

                }
            }
            $akt = strtotime($min);
            $max = strtotime($max);


            while ($akt <= $max) {

                $strakt = $akt;

                $m_jahr = date('Y', $strakt);
                $m_monat = strftime('%B', $strakt);
                $m_kw = date('W', $strakt);
                $m_wt = date('w', $strakt);
                $m_date = date('Y-m-d', $strakt);

                $array = array('tag' => $m_date);

                if(array_key_exists($m_date, $zeiten)){
                    $array['zeiten'] = $zeiten[$m_date];
                }

                $kalendar[$m_jahr][$m_monat][$m_kw][$m_wt] = $array;

                $akt = $strakt + (24 * 3600);

            }
        }

        return $kalendar;
    }

}