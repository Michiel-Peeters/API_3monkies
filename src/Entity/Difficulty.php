<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"difficulties:read"},
 *          "enable_max_depth"=true
 *     },
 *      denormalizationContext={
 *     "groups"={"difficulties:write"}
 *     })
 * @ORM\Entity(repositoryClass=DifficultyRepository::class)
 */
class Difficulty {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"difficulties:read", "rooms:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"difficulties:read","difficulties:write", "rooms:read", "games:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"difficulties:read", "difficulties:write","rooms:read", "games:read"})
     */
    private $maxTime;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="difficulty")
     */
    private $rooms;

    public function __construct() {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getMaxTime(): ?int {
        return $this->maxTime;
    }

    public function setMaxTime(int $maxTime): self {
        $this->maxTime = $maxTime;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection {
        return $this->rooms;
    }

    public function addRoom(Room $room): self {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setDifficulty($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getDifficulty() === $this) {
                $room->setDifficulty(NULL);
            }
        }

        return $this;
    }

    public function __toString(): string {
        return $this->getName();
    }

}
