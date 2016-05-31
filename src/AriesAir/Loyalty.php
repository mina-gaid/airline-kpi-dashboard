<?php

namespace AriesAir;

class Loyalty extends Db implements LoyaltyInterface
{

    public function getBronzeLevelCustomers()
    {
        $stmt = $this->db->prepare("SELECT SUM(duration) AS 'TotalHours', concat(dimpassenger.Firstname, ' ', dimpassenger.Surname) AS Name
                                    FROM dimflight
                                    JOIN dimpassenger
                                    ON dimflight.flightid = dimpassenger.passengerid
                                    GROUP BY Name
                                    HAVING TotalHours >= 40 && TotalHours < 80
                                    ORDER BY totalhours
                                    DESC LIMIT 0, 15;");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Name', 'type' => 'string'),
            array('label' => 'Total Hours', 'type' => 'number')
        );

        foreach ($results as $r) {
            $temp = array();

            $temp[] = array('v' => (string)$r['Name']);
            $temp[] = array('v' => (int)$r['TotalHours']);

            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }

    public function getSilverLevelCustomers()
    {
        $stmt = $this->db->prepare("SELECT SUM(duration) AS 'TotalHours', concat(dimpassenger.Firstname, ' ', dimpassenger.Surname) AS Name
                                    FROM dimflight
                                    JOIN dimpassenger
                                    ON dimflight.flightid = dimpassenger.passengerid
                                    GROUP BY Name
                                    HAVING TotalHours >= 80 && TotalHours < 120
                                    ORDER BY totalhours
                                    DESC LIMIT 0, 15;");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Name', 'type' => 'string'),
            array('label' => 'Total Hours', 'type' => 'number')
        );

        foreach ($results as $r) {
            $temp = array();

            $temp[] = array('v' => (string)$r['Name']);
            $temp[] = array('v' => (int)$r['TotalHours']);

            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }

    public function getGoldLevelCustomers()
    {
        $stmt = $this->db->prepare("SELECT SUM(duration) AS 'TotalHours', concat(dimpassenger.Firstname, ' ', dimpassenger.Surname) AS Name
                                    FROM dimflight
                                    JOIN dimpassenger
                                    ON dimflight.flightid = dimpassenger.passengerid
                                    GROUP BY Name
                                    HAVING TotalHours > 120
                                    ORDER BY totalhours
                                    DESC LIMIT 0, 15;");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Name', 'type' => 'string'),
            array('label' => 'Total Hours', 'type' => 'number')
        );

        foreach ($results as $r) {
            $temp = array();

            $temp[] = array('v' => (string)$r['Name']);
            $temp[] = array('v' => (int)$r['TotalHours']);

            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }

    //Identify and provide information about customers and their most frequent flights.

    public function getFrequentTravellers()
    {
        $stmt = $this->db->prepare("SELECT concat(Firstname, ' ', Surname) as Name, COUNT(concat(Firstname, ' ', Surname)) as 'Flights'
                                    FROM dimpassenger
                                    GROUP BY Name
                                    ORDER BY Flights
                                    DESC LIMIT 0, 20;");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Name', 'type' => 'string'),
            array('label' => 'Flights', 'type' => 'number')

        );

        foreach ($results as $r) {
            $temp = array();
            $temp[] = array('v' => (string)$r['Name']);
            $temp[] = array('v' => (int)$r['Flights']);
            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }
}