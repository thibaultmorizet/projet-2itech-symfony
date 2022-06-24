<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MovieRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get", "post"
    ],
    itemOperations: ["get", "put", "delete"],
    normalizationContext: ['groups' => "movie:read"],
    denormalizationContext: ['groups' => "movie:write"],
)]

class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["movie:read", "user:write", "user:read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["movie:read", "user:read"])]
    private $title;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(["movie:read", "user:read"])]
    private $year;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["movie:read", "user:read"])]
    private $type;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'users', cascade: ['persist'])]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addMovie($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeMovie($this);
        }

        return $this;
    }
}
