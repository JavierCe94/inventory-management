<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 24/04/18
 * Time: 12:43
 */

namespace App\Domain\Model\Entity\Department;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Insfrastructure\Repository\DepartmentRepository\DepartmentRepository")
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Model\Entity\WorkerStatus\WorkerStatus")
     */
    private $workerStatus;
}
