<?php
/*
$niz=array();
$niz[]="crveno";
$niz[]="plavo";
// $niz=array("crveno", "plavo");
*/
/*
$niz=array("crveno", "plavo");

$str=implode("-", $niz); //str ce biti "crveno-plavo"

$ponovo_niz=explode("-",$str); //ponovo_niz ce biti array("crveno", "plavo")
*/

Class Validacija {

	var $tekstgreske=array();
	var $greska=false;
	
	function MaksimumKaraktera($tekst, $broj_karaktera, $nazivpolja) {
		if (strlen($tekst)>$broj_karaktera) {
			$this->tekstgreske[]="{$nazivpolja} ima previse karaktera, maksimalno je dozovljeno {$broj_karaktera}";
			$this->greska=true;
			return false;
		}
	}
	function MinimumKaraktera($tekst, $broj_karaktera, $nazivpolja) {
		if (strlen($tekst)<$broj_karaktera) {
			$this->tekstgreske[]="{$nazivpolja} ima premalo karaktera, minimum je {$broj_karaktera}";
			$this->greska=true;
			return false;
		}
	}
	function ObaveznoPolje($tekst, $nazivpolja) {
		if (strlen($tekst)==0) {
			$this->tekstgreske[]="{$nazivpolja} je obavezno popuniti.";
			$this->greska=true;
			return false;
		}
	}
	function IstaPolja($p1, $p2, $nazivpolja) {
		if ($p1!=$p2) {
			$this->tekstgreske[]="{$nazivpolja} nisu iste.";
			$this->greska=true;
			return false;
		}
	}
	function ValidanEmail($email, $nazivpolja) {
		//pera@peric.com
		$email=explode("@", $email);

		if (count($email)==2) {
			$niz=explode(".", $email[1]);
			if (count($niz)<2) {
				//email je ok
			}
			else {
				$this->tekstgreske[]="{$nazivpolja} nije validna email adresa";
				$this->greska=true;
				return false;	
			}
		}
		else {
				$this->tekstgreske[]="{$nazivpolja} nije validna email adresa";
				$this->greska=true;
				return false;
		}
	}

	function ValidanEmail1($email, $nazivpolja) {
		
		//mail@mailcom
		$niz1=explode("@", $email);

		if (isset($niz1[1]))
		$niz2=explode(".", $niz1[1]);

		//$niz1 = array("mail", "mail.com");
		//$niz2 = array("mail", "com");

		if (count($niz1)!=2 OR count($niz2)<2) {
			$this->tekstgreske[]="{$nazivpolja} nije validna email adresa";
				$this->greska=true;
				return false;
		}
	}

	function DaLiJeSlika($fajl, $nazivpolja) {
		//print_r($fajl);
		if ($fajl['error']==0) {
			$image_info=getimagesize($fajl['tmp_name']);

			if ($image_info[0]>0 and $image_info[1]>0) {
			
			}
			else {
				$this->tekstgreske[]="{$nazivpolja} nije slika.";
				$this->greska=true;
				return false;
			}
		}
		else {
				$this->tekstgreske[]="{$nazivpolja} nije slika.";
				$this->greska=true;
				return false;

		}
	}

}

?>