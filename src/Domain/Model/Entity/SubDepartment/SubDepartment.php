<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 24/04/18
 * Time: 12:43
 */

namespace App\Domain\Model\Entity\SubDepartment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Insfrastructure\Repository\SubDepartmentRepository\SubDepartmentRepository")
 */
class SubDepartment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\Department\Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;
}
