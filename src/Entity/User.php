<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(name="student_number",type="string", length=255, nullable=true)
     */
    private $studentNumber;

    /**
     * @ORM\Column(type="integer", nullable=true,length=8)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(name="email_status",type="integer",options={"default" :0})
     */
    private $emailStatus=0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validation;

    /**
     * @ORM\Column(type="float",options={"default" :0})
     */
    private $salary=0;

    /**
     * user can have many roles (ROLE_ADMIN,ROLE_LIBRARIAN,ROLE_STUDENT) this roles used to guarantee access control
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * bidirectional - One user make many loans
     * @ORM\OneToMany(targetEntity=Loan::class, mappedBy="user",cascade={"persist", "remove"})
     */
    private $loans;

    public function __construct()
    {
        $this->loans= new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }



    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
    public function getStudentNumber(): ?int
    {
        return $this->studentNumber;
    }

    public function setStudentNumber(int $studentNumber): self
    {
        $this->studentNumber=$studentNumber;

        return $this;
    }

    public function getEmailStatus(): ?int
    {
        return $this->emailStatus;
    }

    public function setEmailStatus(int $emailStatus): self
    {
        $this->emailStatus = $emailStatus;

        return $this;
    }

    public function getValidation(): ?string
    {
        return $this->validation;
    }

    public function setValidation(?string $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }


    public function getLoans(): ArrayCollection
    {
        return $this->loans;
    }

    public function setLoans(ArrayCollection $loans): self
    {
        $this->loans = $loans;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_STUDENT
        $roles[] = 'ROLE_STUDENT';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "auto" algorithm in security configuration
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): ?string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function addLoan(Loan $loan): self
    {
        if (!$this->loans->contains($loan)) {
            $this->loans->add($loan);
        }
        return $this;
    }
    public function removeBook(Loan $loan): self
    {
        if ($this->loans->contains($loan)) {
            $this->loans->removeElement($loan);
        }
        return $this;
    }


}
