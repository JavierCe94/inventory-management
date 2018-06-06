<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\RequestEmployee\FirmRepository")
 * @ORM\Table(name="firm")
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
     * @ORM\OneToOne(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee", inversedBy="firm")
     */
    private $requestEmployee;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, options={"default"=null})
     */
    private $url;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreation;

    public function __construct(RequestEmployee $requestEmployee, string $url)
    {
        $this->requestEmployee = $requestEmployee;
        $this->url = $url;
        $this->dateCreation = new \DateTime();
    }

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
