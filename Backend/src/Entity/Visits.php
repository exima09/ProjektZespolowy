<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * attributes={"access_control"="is_granted('ROLE_USER')"},
 * routePrefix="/visits",
 * collectionOperations={
 *     "get"={
 *          "method"="GET",
 *          "path"=""
 *      },
 *     "post"={
 *          "method"="POST",
 *          "path"=""
 *     }
 * },
 * itemOperations={
 *      "get"={
 *          "method"="GET",
 *          "path"="/{id}"
 *      },
 *     "patch"={
 *          "method"="PATCH",
 *          "path"="/{id}"
 *     },
 *     "delete"={
 *          "method"="DELETE",
 *          "path"="/{id}"
 *     },
 *  }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\VisitsRepository")
 */
class Visits
{
    const TYPE_PHONE = "P";
    const TYPE_EMAIL = "E";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prisoner", inversedBy="visits")
     */
    private $prisoner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStop;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statusAccepted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookingPerson;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $contactType;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $contact;

    /**
     * Visits constructor.
     * @param $prisoner
     * @param $dateStart
     * @param $dateStop
     * @param $bookingPerson
     * @param $contactType
     * @param $contact
     */
    public function __construct($prisoner, $dateStart, $dateStop, $bookingPerson, $contactType, $contact)
    {
        $this->prisoner = $prisoner;
        $this->dateStart = $dateStart;
        $this->dateStop = $dateStop;
        $this->statusAccepted = false;
        $this->bookingPerson = $bookingPerson;
        $this->contactType = $contactType;
        $this->contact = $contact;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrisoner(): ?Prisoner
    {
        return $this->prisoner;
    }

    public function setPrisoner(?Prisoner $prisoner): self
    {
        $this->prisoner = $prisoner;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateStop(): ?\DateTimeInterface
    {
        return $this->dateStop;
    }

    public function setDateStop(\DateTimeInterface $dateStop): self
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    public function getStatusAccepted(): ?bool
    {
        return $this->statusAccepted;
    }

    public function setStatusAccepted(bool $statusAccepted): self
    {
        $this->statusAccepted = $statusAccepted;

        return $this;
    }

    public function getBookingPerson(): ?string
    {
        return $this->bookingPerson;
    }

    public function setBookingPerson(string $bookingPerson): self
    {
        $this->bookingPerson = $bookingPerson;

        return $this;
    }

    public function getContactType(): ?string
    {
        return $this->contactType;
    }

    public function setContactType(string $contactType): self
    {
        $this->contactType = $contactType;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
