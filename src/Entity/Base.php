<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass; 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\PreFlushEventArgs;
use DateTime;

/** @MappedSuperclass */
class Base{

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $crdate;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $tstamp;

    public function __construct()
    {
        $this->crdate = new DateTime();
        $this->tstamp = new DateTime();
    }

    public function preFlush(PreFlushEventArgs $args)
    {
        $this->tstamp = new DateTime();
    }

    public function getCrdate():DateTime
    {
        return $this->crdate;
    }

    /**
     *
     * @return  self
     */ 
    public function setCrdate(DateTime $crdate):self
    {
        $this->crdate = $crdate;

        return $this;
    }    

    public function getTstamp():DateTime
    {
        return $this->tstamp;
    }

    /**
     *
     * @return  self
     */ 
    public function setTstamp(DateTime $tstamp):self
    {
        $this->tstamp = $tstamp;

        return $this;
    }
}