<?php

namespace AriesAir;

class Finance extends Db implements FinanceInterface
{

    public function getYearlyFinancialHistory()
    {
        try {
            $stmt = $this->db->prepare("SELECT DISTINCT(dimdate.year) AS 'year', SUM(factflightincome.total) AS total
                                        FROM dimdate INNER JOIN factflightincome
                                        ON dimdate.DateId = factflightincome.FKDateId
                                        WHERE dimdate.year != '1999'
                                        GROUP BY dimdate.year;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'year', 'type' => 'string'),
                array('label' => 'total', 'type' => 'number'));


            foreach ($results as $r) {
                $temp = array();
                $temp[] = array('v' => (string)$r['year']);
                $temp[] = array('v' => (int)$r['total']);
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);
            return $jsonTable;

        } catch (\PDOException $ex) {
            return false;
        }
    }

    public function getPopularDestinations()
    {
        try {
            $stmt = $this->db->prepare("SELECT DISTINCT(Destination), COUNT(*) AS ItemCount
                                        FROM  dimflight
                                        GROUP BY Destination;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Destination', 'type' => 'string'),
                array('label' => 'ItemCount', 'type' => 'number')
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)$r['Destination']);
                $temp[] = array('v' => (int)$r['ItemCount']);
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public function getReport($year)
    {
        try {
            $stmt = $this->db->prepare("SELECT DISTINCT(dimdate.month) as 'Month', SUM(factflightincome.total) AS 'Monthly Total'
                                        FROM dimdate
                                        INNER JOIN factflightincome
                                        ON dimdate.DateId=factflightincome.FKDateId
                                        WHERE dimdate.year LIKE :year
                                        GROUP BY MONTH");
            $stmt->bindValue(':year', $year);
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Month', 'type' => 'string'),
                array('label' => 'Monthly Total', 'type' => 'number')
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)\DateTime::createFromFormat('!m', $r['Month'])->format('F'));
                $temp[] = array('v' => (int)$r['Monthly Total']);
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }

    }

    public function getDestinationProfits()
    {
        try {
            $stmt = $this->db->prepare("SELECT dimflight.Destination, sum(dimtransaction.Amount) AS Income
                                        FROM dimtransaction
                                        JOIN dimflight ON dimflight.FlightId = dimtransaction.TransactionId
                                        GROUP BY dimflight.Destination 
                                        ORDER BY Income DESC;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Destination', 'type' => 'string'),
                array('label' => 'Income', 'type' => 'number')
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)$r['Destination']);
                $temp[] = array('v' => (int)$r['Income']);
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }
    }
    
    public function getAverageTicketPrice()
    {
        try {
            $stmt = $this->db->prepare("SELECT ROUND(SUM(factflightincome.Total)/COUNT(factflightincome.total), 2) AS 'Average Ticket Price', dimdate.Year
                                        FROM dimdate
                                        INNER JOIN factflightincome
                                        ON dimdate.DateId=factflightincome.FKDateId
                                        WHERE dimdate.Month >= 01 && dimdate.Month <=12 && dimdate.Year > 1999
                                        GROUP BY dimdate.Year;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Year', 'type' => 'string'),
                array('label' => 'Average Ticket Price', 'type' => 'number'),
                
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)$r['Year']);
                $temp[] = array('v' => (int)$r['Average Ticket Price']);               
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }
    }
    
    public function getAverageMonthlyTicketPrice()
    {
        try {
            $stmt = $this->db->prepare("SELECT ROUND(SUM(factflightincome.total)/COUNT(factflightincome.total), 2) AS 'Average Ticket Price',dimdate.Month AS Month
                                        FROM factflightincome
                                        JOIN dimdate
                                        ON dimdate.DateId=factflightincome.FKDateId
                                        WHERE dimdate.Year > 1999
                                        GROUP BY dimdate.Month;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Month', 'type' => 'string'),
                array('label' => 'Average Ticket Price', 'type' => 'number'),
                
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)\DateTime::createFromFormat('!m', $r['Month'])->format('F'));
                $temp[] = array('v' => (int)$r['Average Ticket Price']);             
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }
    }

    public function getAverageYearlyTicketCompare()
    {
        try {
            $stmt = $this->db->prepare("SELECT ROUND(SUM(factflightincome.Total)/COUNT(factflightincome.total), 2) AS 'Average Ticket Price', dimdate.Year AS Year
                                        FROM dimdate
                                        INNER JOIN factflightincome
                                        ON dimdate.DateId=factflightincome.FKDateId
                                        WHERE dimdate.Year > 1999
                                        GROUP BY dimdate.Year DESC LIMIT 0,2;");
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $rows = array();
            $table = array();
            $table['cols'] = array(
                array('label' => 'Year', 'type' => 'string'),
                array('label' => 'Average Ticket Price', 'type' => 'number'),
                
            );

            foreach ($results as $r) {

                $temp = array();
                $temp[] = array('v' => (string)$r['Year']);
                $temp[] = array('v' => (int)$r['Average Ticket Price']);      
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);

            return $jsonTable;
        } catch (\PDOException $ex) {
            return false;
        }
    }

}