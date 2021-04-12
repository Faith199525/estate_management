<?php
namespace App\Essentials;

abstract class Zone extends Enum
{
    const one = "Zone 1";
    const two = "Zone 2";
    const three = "Zone 3";
    const four = "Zone 4";
    const five = "Zone 5";
    const six = "Zone 6";
}

abstract class PaymentChannel extends Enum
{
    const pos = "POS";
    const cash = "Cash";
    const cheque = "Cheque";
    const deposit = "Bank Deposit";
}

abstract class DueType extends Enum
{
    const oneTime = "One Time";
    const yearly = "Yearly";
    const monthy = "Monthly";
}

abstract class DuePayer extends Enum
{
    const resident = "Tenant Residents";
    const residentLandlord = "Resident Landords";
    const nonResidentLandlord = "Non-Resident Landlords";
    const allLandlord = "All Landlords";
}

abstract class BuildingType extends Enum
{
    const bungalow = "Bungalow";
    const duplex = "Duplex";
    const blockOfFlats = "Block of Flats";
}

abstract class MessageChannel extends Enum
{
    const email = "email";
    const sms = "SMS";
}

abstract class MessageRecipient extends Enum
{
    const all = "Everyone";
    const resident = "All Residents";
    const landlord = "All Landlords";
}

abstract class Enum
{
    static function getArray()
    {
        $class = new \ReflectionClass(get_called_class());
        return $class->getConstants();
    }

    static function getKeys()
    {
        $class = new \ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }
}
