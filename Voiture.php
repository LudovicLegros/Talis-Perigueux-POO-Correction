<?php

class Voiture
{

    private $couleur;
    private $marque;
    private $nbPortes;
    private $phare;
    private $compteur;
    private $reservoir;
    private $consommation;
    private $essence;

    function __construct(
        $marque,
        $nbPortes,
        $couleur = 'blanc',
        $compteur = 0,
        $reservoir = 80,
        $essence = 80,
        $consommation = 0.07
    ) {
        $this->setPhare('off');
        $this->setCouleur($couleur);
        $this->setMarque($marque);
        $this->setnbPortes($nbPortes);
        $this->setCompteur($compteur);
        $this->setReservoir($reservoir);
        $this->setEssence($essence);
        $this->setConsommation($consommation);
    }

    //GETTER ET SETTER -- PRINCIPE D'ENCAPSULATION

    public function getEssence()
    {
        return $this->essence;
    }

    public function setEssence($essence)
    {
        $this->essence = $essence;
    }

    public function getConsommation()
    {
        return $this->consommation;
    }

    public function setConsommation($consommation)
    {
        $this->consommation = $consommation;
    }

    public function getReservoir()
    {
        return $this->reservoir;
    }

    public function setReservoir($reservoir)
    {
        $this->reservoir = $reservoir;
    }

    public function getCompteur()
    {
        return $this->compteur;
    }

    public function setCompteur($compteur)
    {
        $this->compteur = $compteur;
    }

    public function getPhare()
    {
        return $this->phare;
    }

    public function setPhare($phare)
    {
        $this->phare = $phare;
    }

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getNbPortes()
    {
        return $this->nbPortes;
    }

    public function setNbPortes($nbPortes)
    {
        $this->nbPortes = $nbPortes;
    }



    //--METHODES DE L'OBJET--


    public function phare()
    {
        if ($this->getPhare() == 'off') {
            $this->setPhare('on');
        } else {
            $this->setPhare('off');
        }
    }

    public function rouler($km)
    {
        //CALCUL DE L'ESSENCE CONSOMME PAR RAPPORT AU KM CHOISI
        $essenceConsomme = $this->getEssence() - ($km * $this->getConsommation());

        //SI IL Y A PLUS D'ESSENCE
        if ($essenceConsomme < 0) {
            //RECUPERATION DE L'ESSENCE EN TROP
            $essenceEnTrop = -$essenceConsomme;
            //ON ACTUALISE L'ESSENCE POUR QUE LA VALEUR NE SOIT PAS NEGATIVE
            $essenceActu = 0;
            //ON LIMITE LES KM UTILISES EN FONCTION DE L'ESSENCE
            $km = $km - ($essenceEnTrop / $this->getConsommation());
        } else {
            //SINON ON SOUSTRAIT L'ESSENCE CONSOMME
            $essenceActu = $essenceConsomme;
        }


        echo 'La ' . $this->marque  . ' roule ' . $km . 'km.<br>';
        $this->setCompteur($this->getCompteur() + $km);
        $this->setEssence($essenceActu);
    }

    public function tableauDeBord()
    {
        //ON DEFINI UNE VARIABLE A 10% DU RESERVOIR
        $alertEssence = $this->getReservoir() * 0.1;

        echo        $this->getCompteur() . 'km<br>
        Phare : ' . $this->getPhare() . '<br>
        Esmax : ' . $this->getReservoir() . '<br>
        Ess  : ' . $this->getEssence() . '<br>';
        //SOUS LES 10% ON MET LE SIGNAL ROUGE
        if ($this->getEssence() <= $alertEssence) {
            echo 'Signal Essence : rouge ';
        } else {
            echo 'Signal Essence : Vert';
        }
    }

    public function faireLePlein()
    {
        $this->setEssence($this->getReservoir());
    }
}
