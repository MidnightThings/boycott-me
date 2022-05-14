<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=UserGoal::class, mappedBy="user")
     */
    private $userGoals;

    /**
     * @ORM\OneToMany(targetEntity=UserGoalDay::class, mappedBy="user")
     */
    private $userGoalDays;

    public function __construct()
    {
        $this->userGoals = new ArrayCollection();
        $this->userGoalDays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $userGoal->setUser($this);
        }

        return $this;
    }

    public function removeUserGoal(UserGoal $userGoal): self
    {
        if ($this->userGoals->removeElement($userGoal)) {
            // set the owning side to null (unless already changed)
            if ($userGoal->getUser() === $this) {
                $userGoal->setUser(null);
            }
        }

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
            $userGoalDay->setUser($this);
        }

        return $this;
    }

    public function removeUserGoalDay(UserGoalDay $userGoalDay): self
    {
        if ($this->userGoalDays->removeElement($userGoalDay)) {
            // set the owning side to null (unless already changed)
            if ($userGoalDay->getUser() === $this) {
                $userGoalDay->setUser(null);
            }
        }

        return $this;
    }
}
