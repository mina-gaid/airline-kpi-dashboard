<?php

namespace AriesAir;

interface FinanceInterface
{

    public function getYearlyFinancialHistory();

    public function getPopularDestinations();
    
    public function getDestinationProfits();
    
    public function getAverageTicketPrice();
    
    public function getAverageMonthlyTicketPrice();
    
    public function getAverageYearlyTicketCompare();

    public function getReport($year);

}