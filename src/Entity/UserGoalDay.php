<?php

namespace App\Entity;

use App\Repository\UserGoalDayRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserGoalDayRepository::class)
 */
class UserGoalDay
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userGoalDays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=UserGoal::class, inversedBy="userGoalDays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userGoal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accomplished;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUserGoal(): ?UserGoal
    {
        return $this->userGoal;
    }

    public function setUserGoal(?UserGoal $userGoal): self
    {
        $this->userGoal = $userGoal;

        return $this;
    }

    public function getAccomplished(): ?bool
    {
        return $this->accomplished;
    }

    public function setAccomplished(bool $accomplished): self
    {
        $this->accomplished = $accomplished;

        return $this;
    }
}
