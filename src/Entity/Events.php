<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     attributes={"order"={"start": "ASC"}},
 *     collectionOperations={
 *     "get",
 *     "post"={
 *          "security_post_denormalize"="is_granted('ROLE_ADMIN') and user.getGroups().contains(object.getGroep())"
 *          },
 *      },
 *     itemOperations={
 *     "get"={
 *          "security" = "is_granted('ROLE_ADMIN') and user.getGroups().contains(object.getGroep())",
 *          },
 *     "put"={
 *          "security"="is_granted('ROLE_ADMIN') and user.getGroups().contains(object.getGroep())",
 *          "denormalization_context"={"groups"={"event:item:put"}}
 *          },
 *     "delete"={
 *          "security"="is_granted('ROLE_ADMIN') and object.getUser() = user",
 *          },
 *      },
 *     normalizationContext={"groups"={"event:read"}},
 *     denormalizationContext={"groups"={"event:write"}},
 * )
 * @ApiFilter(PropertyFilter::class)
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\EventEntityListener"})
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
