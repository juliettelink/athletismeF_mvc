<?php
namespace App\Entity;

class Coureur extends Entity
{

    protected ?int $id_coureur = null;
    protected string $first_name;
    protected string $last_name;
    protected ?string $date_naissance = null;
    protected string $nationalite;
    protected int $id_equipe;
    protected int $compteur_course;



    /**
     * Get the value of id_coureur
     */
    public function getIdCoureur(): ?int
    {
        return $this->id_coureur;
    }

    /**
     * Set the value of id_coureur
     */
    public function setIdCoureur(?int $id_coureur): self
    {
        $this->id_coureur = $id_coureur;

        return $this;
    }

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
     * Get the value of date_naissance
     */
    public function getDateNaissance(): ?string
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of date_naissance
     */
    public function setDateNaissance(?string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * Get the value of nationalite
     */
    public function getNationalite(): string
    {
        return $this->nationalite;
    }

    /**
     * Set the value of nationalite
     */
    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get the value of id_equipe
     */
    public function getIdEquipe(): int
    {
        return $this->id_equipe;
    }

    /**
     * Set the value of id_equipe
     */
    public function setIdEquipe(int $id_equipe): self
    {
        $this->id_equipe = $id_equipe;

        return $this;
    }

    /**
     * Get the value of compteur_course
     */
    public function getCompteurCourse(): int
    {
        return $this->compteur_course;
    }

    /**
     * Set the value of compteur_course
     */
    public function setCompteurCourse(int $compteur_course): self
    {
        $this->compteur_course = $compteur_course;

        return $this;
    }
}
