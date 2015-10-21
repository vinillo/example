<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Twitter
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $post_content;

    /**
     * @ORM\Column(type="text")
     */
    protected $created;

    /**
     * @ORM\Column(type="text")
     */
    protected $last_edit;
}