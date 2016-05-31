<?php

require_once 'vendor/autoload.php';

$klein = new Klein\Klein;

date_default_timezone_set('Europe/Dublin');

$klein->respond(function ($request, $response, $service) {
    $service->layout('layouts/base.php');
});

$klein->respond('/api/popular/destinationProfits', function () {
    $f = new \AriesAir\Finance();
    return $f->getDestinationProfits();
});

$klein->respond('/api/popular/averageTicketPrice', function () {
    $f = new \AriesAir\Finance();
    return $f->getAverageTicketPrice();
});

$klein->respond('/api/popular/averageMonthlyTicketPrice', function () {
    $f = new \AriesAir\Finance();
    return $f->getAverageMonthlyTicketPrice();
});

$klein->respond('/api/popular/averageYearlyTicketCompare', function () {
    $f = new \AriesAir\Finance();
    return $f->getAverageYearlyTicketCompare();
});

$klein->respond('/api/ratings', function () {
    $cs = new \AriesAir\CustomerService();
    return $cs->customerRatings();
});

$klein->respond('/api/aoi', function () {
    $cs = new \AriesAir\CustomerService();
    return $cs->customerSuggestions();
});

$klein->respond('/api/reports', function () {
    $f = new \AriesAir\Finance();
    return $f->getYearlyFinancialHistory();
});

$klein->respond('/api/customer/bronze', function () {
    $l = new \AriesAir\Loyalty();
    return $l->getBronzeLevelCustomers();
});

$klein->respond('/api/customer/silver', function () {
    $l = new \AriesAir\Loyalty();
    return $l->getSilverLevelCustomers();
});

$klein->respond('/api/customer/gold', function () {
    $l = new \AriesAir\Loyalty();
    return $l->getGoldLevelCustomers();
});

$klein->respond('/api/customer/frequent', function () {
    $l = new \AriesAir\Loyalty();
    return $l->getFrequentTravellers();
});

$klein->respond('/api/popular/destinations', function () {
    $f = new \AriesAir\Finance();
    return $f->getPopularDestinations();
});

$klein->respond('/api/report/[:year]', function ($request) {
    $f = new \AriesAir\Finance();
    return $f->getReport($request->year);
});
$klein->respond('/', function ($request, $response, $service) {
    $service->render('views/home.php');
});

$klein->respond('/finance', function ($request, $response, $service) {
    $service->render('views/finance.php');
});

$klein->respond('/customer-service', function ($request, $response, $service) {
    $service->render('views/customer-service.php');
});

$klein->respond('/loyalty', function ($request, $response, $service) {
    $service->render('views/loyalty.php');
});

$klein->dispatch();