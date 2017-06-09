<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
 */
class Post
{

    /**
     *
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Comment", mappedBy="post")
     */
    private $comments;

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
     * @ORM\Column(name="title", type="string", length=127)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="edited", type="boolean")
     */
    private $edited;

    /**
     *
     * @ORM\Column(name="modifiedat", type="datetime")
     */
    private $modifiedat ;

    public function __construct()
    {
        $this->modifiedat = new \DateTime();
        $this->edited = false;
        //comme un post peut avoir plusieurs commentaires, on déclare que l'attribut comment sera un arrayCllection
        $this->comments = new ArrayCollection();
    }
//les deux méthodes suivantes permettent de manipuler les commentaires d'un article
//ajout d'un commentaire
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
//on doit définir la relation dans l'entité proprietaire
        $comment->setPost($this);
    }

    //supression d'un "lien vers un commentaire lié a l'article
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    public function getComments()
    {
        return $this->comments;
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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
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
     * @return mixed
     */
    public function getModifiedat()
    {
        return $this->modifiedat;
    }

    /**
     * @param mixed $modifiedat
     */
    public function setModifiedat()
    {
        $this->modifiedat = new \DateTime();
    }

    /**
     * @param bool $edited
     */
    public function setEdited($edited)
    {
        $this->edited = $edited;
    }

    /**
     * @return bool
     */
    public function isEdited()
    {
        return $this->edited;
    }

    /**
     * renvoie le nombre de commentaires liés a un post
     * @return int
     */
    public function nbOfComments(){
        return $this->comments->count();

    }
}

