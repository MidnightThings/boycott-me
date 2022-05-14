<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category extends Base
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=UserGoal::class, mappedBy="category")
     */
    private $userGoals;

    public function __construct()
    {
        parent::__construct();
        $this->userGoals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, UserGoal>
     */
    public function getUserGoals(): Collection
    {
        return $this->userGoals;
    }

    public function addUserGoal(UserGoal $userGoal): self
    {
        if (!$this->userGoals->contains($userGoal)) {
            $this->userGoals[] = $userGoal;
            $userGoal->setCategory($this);
        }

        return $this;
    }

    public function removeUserGoal(UserGoal $userGoal): self
    {
        if ($this->userGoals->removeElement($userGoal)) {
            // set the owning side to null (unless already changed)
            if ($userGoal->getCategory() === $this) {
                $userGoal->setCategory(null);
            }
        }

        return $this;
    }
}
