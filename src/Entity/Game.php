<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"games:read"},
 *          "enable_max_depth"=true
 *     },
 *     denormalizationContext={
 *     "groups"={"games:write"}
 *     })
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"games:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"games:read", "games:write", "tipgiven:read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"games:read", "games:write", "tipgiven:read"})
     */
    private $room;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"games:read", "games:write"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"games:read", "games:write"})
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity=TipGiven::class, mappedBy="game")
     * @Groups({"games:read"})
     */
    private $tipsGiven;

    public function __construct()
    {
        $this->tipsGiven = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $user): self {
        $this->user = $user;

        return $this;
    }

    public function getRoom(): ?Room {
        return $this->room;
    }

    public function setRoom(?Room $room): self {
        $this->room = $room;

        return $this;
    }

    public function getStartDate(): ?string {
        return $this->startDate->format('d-m-Y h:m:s');
    }

    public function setStartDate(\DateTimeInterface $startDate): self {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string {
        return $this->endDate->format('d-m-Y h:m:s');
    }

    public function setEndDate(\DateTimeInterface $endDate): self {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, TipGiven>
     */
    public function getTipsGiven(): Collection
    {
        return $this->tipsGiven;
    }

    public function addTipsGiven(TipGiven $tipsGiven): self
    {
        if (!$this->tipsGiven->contains($tipsGiven)) {
            $this->tipsGiven[] = $tipsGiven;
            $tipsGiven->setGame($this);
        }

        return $this;
    }

    public function removeTipsGiven(TipGiven $tipsGiven): self
    {
        if ($this->tipsGiven->removeElement($tipsGiven)) {
            // set the owning side to null (unless already changed)
            if ($tipsGiven->getGame() === $this) {
                $tipsGiven->setGame(null);
            }
        }

        return $this;
    }

}
