<?php
namespace App\Entity;

class Course {

    protected ?int $id_course = null;
    protected string $name;
    protected string $description;
    protected ?string $date_course = null;
    protected string $image;
    protected int $id_stade;





    /**
     * Get the value of id_course
     */
    public function getIdCourse(): ?int
    {
        return $this->id_course;
    }

    /**
     * Set the value of id_course
     */
    public function setIdCourse(?int $id_course): self
    {
        $this->id_course = $id_course;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of date_course
     */
    public function getDateCourse(): ?string
    {
        return $this->date_course;
    }

    /**
     * Set the value of date_course
     */
    public function setDateCourse(?string $date_course): self
    {
        $this->date_course = $date_course;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of id_stade
     */
    public function getIdStade(): int
    {
        return $this->id_stade;
    }

    /**
     * Set the value of id_stade
     */
    public function setIdStade(int $id_stade): self
    {
        $this->id_stade = $id_stade;

        return $this;
    }
}