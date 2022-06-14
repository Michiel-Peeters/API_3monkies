<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipGivenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"tipgiven:read"},
 *          "enable_max_depth"=true
 *     },
 *     denormalizationContext={
 *     "groups"={"tipgiven:write"}
 *     })
 * @ORM\Entity(repositoryClass=TipGivenRepository::class)
 */
class TipGiven
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tipgiven:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="tipsGiven")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"tipgiven:read"})
     */
    private $game;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"tipgiven:read"})
     */
    private $sendTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getSendTime(): ?string
    {
        return $this->sendTime->format('d-m-Y h:m:s');
    }

    public function setSendTime(\DateTimeInterface $sendTime): self
    {
        $this->sendTime = $sendTime;

        return $this;
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
}
