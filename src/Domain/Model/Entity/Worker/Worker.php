<?php

namespace App\Domain\Model\Entity\Worker;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Insfrastructure\Repository\WorkerRepository\WorkerRepository")
 */
class Worker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=9, nullable=false, unique=true, options={"default"="-"})
     */
    private $nif;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, options={"default"="-"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30, nullable=false, unique=true, options={"default"="-"})
     */
    private $inssnumber;

    /**
     * @ORM\Column(type="string", length=12, nullable=false, unique=true, options={"default"="-"})
     */
    private $tel;
}
