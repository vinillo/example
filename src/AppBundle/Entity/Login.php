<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="accounts")
 */
class Login
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="text")
     */
    protected $username;
    /**
     * @ORM\Column(type="text")
     */
    protected $password;
    /**
     * @ORM\Column(type="text")
     */
    protected $email;
    /**
     * @ORM\Column(type="text")
     */
    protected $create_date;
    /**
     * @ORM\Column(type="text")
     */
    protected $last_ip;
    /**
     * @ORM\Column(type="text")
     */
    protected $last_login;
    /**
     * @ORM\Column(type="text")
     */
    protected $session_hash;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @ORM\Column(type="text")
     */


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return mixed
     */
    public function getLastIp()
    {
        return $this->last_ip;
    }

    /**
     * @param mixed $last_ip
     */
    public function setLastIp($last_ip)
    {
        $this->last_ip = $last_ip;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @param mixed $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return mixed
     */
    public function getSessionHash()
    {
        return $this->session_hash;
    }

    /**
     * @param mixed $session_hash
     */
    public function setSessionHash($session_hash)
    {
        $this->session_hash = $session_hash;
    }


}