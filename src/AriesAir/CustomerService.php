<?php

namespace AriesAir;

class CustomerService extends Db implements CustomerServiceInterface
{

    public function customerRatings()
    {
        $stmt = $this->db->prepare("SELECT DISTINCT(Rating) as 'Rating', COUNT(*) AS 'Number of Ratings'
                                    FROM dimfeedback 
                                    GROUP BY Rating; ");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Rating', 'type' => 'number'),
            array('label' => 'Number of Ratings', 'type' => 'number')

        );

        foreach ($results as $r) {
            $temp = array();
            $temp[] = array('v' => $r['Rating']);
            $temp[] = array('v' => $r['Number of Ratings']);
            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }

    public function customerSuggestions()
    {
        $stmt = $this->db->prepare("SELECT DISTINCT(AOI), COUNT(*) AS ItemCount
                                    FROM dimfeedback 
                                    GROUP BY AOI;");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $rows = array();
        $table = array();

        $table['cols'] = array(
            array('label' => 'Area of Improvement', 'type' => 'string'),
            array('label' => 'Count', 'type' => 'number')
        );

        foreach ($results as $r) {
            $temp = array();
            $temp[] = array('v' => (string)$r['AOI']);
            $temp[] = array('v' => (int)$r['ItemCount']);
            $rows[] = array('c' => $temp);
        }

        $table['rows'] = $rows;
        $jsonTable = json_encode($table);

        return $jsonTable;
    }

}
