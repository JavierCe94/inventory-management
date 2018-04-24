<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 24/04/18
 * Time: 12:04
 */

namespace App\Domain\Model\Entity\WorkerStatus;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Insfrastructure\Repository\WorkerStatusRepository\WorkerStatusRepository")
 */
class WorkerStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $firstContractDate;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $seniorityDate;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $expirationContractDate;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $possibleRenewal;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"= 0})
     */
    private $availableHollydays;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"= 0})
     */
    private $hollydaysPendingToApplyFor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\Department\Department")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\SubDepartment\SubDepartment")
     */
    private $subDepartment;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Model\Entity\Worker\Worker")
     */
    private $worker;

}
