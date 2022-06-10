<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"tips:read"},
 *          "enable_max_depth"=true
 *     },
 *     denormalizationContext={
 *     "groups"={"tips:write"}
 *     })
 * @ORM\Entity(repositoryClass=TipRepository::class)
 */
class Tip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"rooms:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tips:read", "tips:write", "rooms:read", "tipgiven:read", "games:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="tips")
     * @Groups({"tips:read"})
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity=TipGiven::class, mappedBy="tip")
     */
    private $tipsGiven;

    public function __construct()
    {
        $this->tipsGiven = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

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
            $tipsGiven->setTip($this);
        }

        return $this;
    }

    public function removeTipsGiven(TipGiven $tipsGiven): self
    {
        if ($this->tipsGiven->removeElement($tipsGiven)) {
            // set the owning side to null (unless already changed)
            if ($tipsGiven->getTip() === $this) {
                $tipsGiven->setTip(null);
            }
        }

        return $this;
    }
}
