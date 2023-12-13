<?php
namespace App\Entity;

class Score extends Entity

{

    protected string $first_name;
    protected string $last_name;
    protected string $name;
    protected ?string $date_course = null;
    protected string $position_coureur;



    /**
     * Get the value of first_name
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     */
    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     */
    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

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
     * Get the value of position_coureur
     */
    public function getPositionCoureur(): string
    {
        return $this->position_coureur;
    }

    /**
     * Set the value of position_coureur
     */
    public function setPositionCoureur(string $position_coureur): self
    {
        $this->position_coureur = $position_coureur;

        return $this;
    }
}