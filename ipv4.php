<?php
interface IAddressIPv4
{
    public function __construct(string $address);
    public function isValid(): bool;
    public function set(string $address): IAddressIPv4;
    public function getAsString(): string;
    public function getAsInt(): int;
    public function getAsBinaryString(): string;
    public function getOctet(int $number): int;
    public function getClass(): string;
    public function isPrivate(): bool;

}

class AddressIPv4 implements IAddressIPv4
{
    private $address;
    private $octets;

    public function __construct(string $address)
    {
        $this->address = $address;
        $this->set($address);
    }

    public function isValid(): bool
    {
        $parts = explode('.', $this->address);
        if (count($parts) != 4) {
            return false;
        }
        foreach ($parts as $part) {
            if (!is_numeric($part) || $part < 0 || $part > 255) {
                return false;
            }
        }
        return true;
    }

    public function set(string $address): IAddressIPv4
    {
        $this->address = $address;
        $this->octets = explode('.', $address);
        return $this;
    }

    public function getAsString(): string
    {
        return $this->address;
    }

    public function getAsInt(): int
    {
        $parts = explode('.', $this->address);
        $int = 0;
        $int += $parts[0] * 16777216;
        $int += $parts[1] * 65536;
        $int += $parts[2] * 256;
        $int += $parts[3];
        return $int;
    }

    public function getAsBinaryString(): string
    {
        $parts = explode('.', $this->address);
        $binary = '';
        foreach ($parts as $part) {
            $binary .= sprintf('%08b', (int)$part);
        }
        return $binary;
    }

    public function getOctet(int $number): int
    {
        if ($number < 1 || $number > 4) {
            throw new Exception('Octet number musi byt mezi 1 a 4');
        }
        return (int)$this->octets[$number - 1];
    }

    public function getClass(): string
    {
        $firstOctet = (int)$this->octets[0];
        if ($firstOctet < 128) {
            return 'A';
        } elseif ($firstOctet < 192) {
            return 'B';
        } elseif ($firstOctet < 224) {
            return 'C';
        } else {
            return 'D';
        }
    }

    public function isPrivate(): bool
    {
        $firstOctet = (int)$this->octets[0];
        if ($firstOctet === 10) {
            return true;
        } elseif ($firstOctet === 172 && (int)$this->octets[1] >= 16 && (int)$this->octets[1] <= 31) {
            return true;
        } elseif ($firstOctet === 192 && (int)$this->octets[1] === 168) {
            return true;
        }
        return false;
    }
}