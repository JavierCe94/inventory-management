<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\RequestEmployee\FilmRepository")
 * @ORM\Table(name="film")
 */
class Firm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee", inversedBy="request_employees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $requestEmployee;

    /**
     * @ORM\Column(type="string", length=75, nullable=true, options={"default"=null})
     */
    private $url;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreation;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRequestEmployee(): RequestEmployee
    {
        return $this->requestEmployee;
    }

    public function setRequestEmployee(RequestEmployee $requestEmployee): void
    {
        $this->requestEmployee = $requestEmployee;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }
}
