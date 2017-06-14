<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn
     */
    private $post;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="isEdited", type="boolean")
     */
    private $isEdited;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifiedAt", type="datetime")
     */
    private $modifiedAt;

    public function __construct()
    {
       $this->modifiedAt = new \DateTime();
       $this->isEdited = false;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set edited
     *
     * @return Comment
     */
    public function setIsEdited($bool)
    {
        $this->isEdited = $bool;

        return $this;
    }

    /**
     * Get edited
     *
     * @return bool
     */
    public function getIsEdited()
    {
        return $this->isEdited;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return Comment
     */
    public function setModifiedAt()
    {
        $this->modifiedAt = new \DateTime();

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    public function setPost($Post)
    {
        $this->post = $Post;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getModifiedDiff()
    {
        $now = new \DateTime();
        $Diff = $now->diff($this->modifiedAt)->format("%h heures %i minutes %s s");
        return $Diff;
    }
}

