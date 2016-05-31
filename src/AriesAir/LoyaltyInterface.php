<?php

namespace AriesAir;

interface LoyaltyInterface
{
    public function getBronzeLevelCustomers();

    public function getSilverLevelCustomers();

    public function getGoldLevelCustomers();

    public function getFrequentTravellers();

}