<?php

namespace App\Entity;

use App\Repository\UserGoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserGoalRepository::class)
 */
class UserGoal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userGoals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="userGoals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $data = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $sortOrder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\OneToMany(targetEntity=UserGoalDay::class, mappedBy="userGoal")
     */
    private $userGoalDays;

    public function __construct()
    {
        $this->userGoalDays = new ArrayCollection();
    }

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return Collection<int, UserGoalDay>
     */
    public function getUserGoalDays(): Collection
    {
        return $this->userGoalDays;
    }

    public function addUserGoalDay(UserGoalDay $userGoalDay): self
    {
        if (!$this->userGoalDays->contains($userGoalDay)) {
            $this->userGoalDays[] = $userGoalDay;
            $userGoalDay->setUserGoal($this);
        }

        return $this;
    }

    public function removeUserGoalDay(UserGoalDay $userGoalDay): self
    {
        if ($this->userGoalDays->removeElement($userGoalDay)) {
            // set the owning side to null (unless already changed)
            if ($userGoalDay->getUserGoal() === $this) {
                $userGoalDay->setUserGoal(null);
            }
        }

        return $this;
    }
}
