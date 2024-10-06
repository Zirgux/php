<?php

require_once 'AddressIPv4.php';

$address1 = new AddressIPv4('192.168.1.1');
$address2 = new AddressIPv4('255.255.255.255');
$address3 = new AddressIPv4('10.0.0.1');
$address4 = new AddressIPv4('172.16.1.1');
$address5 = new AddressIPv4('192.168.0.1');

echo "Adresa 1: " . $address1->getAsString() . "\n";
echo "Je validní: " . ($address1->isValid() ? 'ano' : 'ne') . "\n";
echo "As int: " . $address1->getAsInt() . "\n";
echo "As binary string: " . $address1->getAsBinaryString() . "\n";
echo "Octet 1: " . $address1->getOctet(1) . "\n";
echo "Třída: " . $address1->getClass() . "\n";
echo "Je privátní: " . ($address1->isPrivate() ? 'ano' : 'ne') . "\n";

echo "\n";

echo "Adresa 2: " . $address2->getAsString() . "\n";
echo "Je validní: " . ($address2->isValid() ? 'ano' : 'ne') . "\n";
echo "As int: " . $address2->getAsInt() . "\n";
echo "As binary string: " . $address2->getAsBinaryString() . "\n";
echo "Octet 1: " . $address2->getOctet(1) . "\n";
echo "Třída: " . $address2->getClass() . "\n";
echo "Je privátní: " . ($address2->isPrivate() ? 'ano' : 'ne') . "\n";
