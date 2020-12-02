<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="roleID")
     *
     * la propriété articles représente la seconde partie du lien qu'il y a entre article et category.
     * Dans la table category, c'est un ManyToOne donc ici il est question d'un OneToMany. Dans cette
     * même logique, mappedBy est le "renvoi d'ascenceur" du inversedBy de la table article. Ils se pointent
     * l'un à l'autre afin de faire le lien.
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * Cette méthode permet d'ajouter un article dans la super table de la category qui est mentionnée
     * sans effacer tout ceux qui seraient déjà là. C'est donc une nouvelle ligne dans ce tableau avec les infos
     * de l'article concerné.
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRoleID($this);
        }

        return $this;
    }

    /**
     * En suivant la meme logique que addArticle, cette méthode permet de supprimer l'article pointé
     * sans avoir d'incidence sur les autres.
     */
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRoleID() === $this) {
                $user->setRoleID(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
