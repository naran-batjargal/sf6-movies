<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdRepository::class)]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, options: ["default" =>  "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $created_timestamp = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_timestamp = null;

    #[ORM\Column]
    private ?int $user_id = null;

    public function __construct()
    {
        $this->created_timestamp = new \DateTime();
        $this->user_id = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getContentShort(): ?string
    {
        return mb_strimwidth($this->content, 0, 400, '...', 'utf-8');
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedTimestamp(): ?\DateTimeInterface
    {
        return $this->created_timestamp;
    }

    public function setCreatedTimestamp(\DateTimeInterface $created_timestamp): static
    {
        $this->created_timestamp = $created_timestamp;

        return $this;
    }

    public function getUpdatedTimestamp(): ?\DateTimeInterface
    {
        return $this->updated_timestamp;
    }

    public function setUpdatedTimestamp(?\DateTimeInterface $updated_timestamp): static
    {
        $this->updated_timestamp = $updated_timestamp;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    function getTimeago()
    {
        $timestamp = strtotime($this->getCreatedTimestamp()->format('Y-m-d H:i:s'));

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff     = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }
    }
}
