<?php
// src/Entity/User.php
namespace App\Entity;
 

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle;

/**
 * User
 *
 * @ORM\Table("fos_user")
 * @ORM\Entity
 */
class  FOSUserBundle extends BaseUser 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
?>