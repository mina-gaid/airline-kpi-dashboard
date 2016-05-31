<h1>Aries Air Finance</h1>

<br>

<ul class="nav nav-tabs" id="menu">
    <li onclick="getFinancialHistory()" class="active"><a>Financial History</a></li>
    <li onclick="getPopularDestinations()"><a href="#">Popular Destinations</a></li>
    <li onclick="getDestinationProfits()"><a href="#">Destination Profits</a></li>
    <li onclick="getAverageTicketPrice(), getAverageMonthlyTicketPrice(), getAverageYearlyTicketCompare()"><a href="#">Average Ticket Price</a></li>
    <li onclick="getYearlyData(<?php echo date('Y') ?>)"><a href="#">Yearly Reports </a></li>
</ul>

<div id="chart2"></div>
<div id="chart3"></div>
<div id="chart4"></div>
<div id="chart"></div>

<br>
<br>
<div id="selector">
    <label id="2015" class="radio-inline"><input type="radio" name="2015">2015</label>
    <label id="2014" class="radio-inline"><input type="radio" name="2014">2014</label>
    <label id="2013" class="radio-inline"><input type="radio" name="2013">2013</label>
    <label id="2012" class="radio-inline"><input type="radio" name="2012">2012</label>
    <label id="2011" class="radio-inline"><input type="radio" name="2011">2011</label>
    <label id="2010" class="radio-inline"><input type="radio" name="2010">2010</label>
    <label id="2009" class="radio-inline"><input type="radio" name="2009">2009</label>
    <label id="2008" class="radio-inline"><input type="radio" name="2008">2008</label>
    <label id="2007" class="radio-inline"><input type="radio" name="2007">2007</label>
    <label id="2006" class="radio-inline"><input type="radio" name="2006">2006</label>
    <label id="2005" class="radio-inline"><input type="radio" name="2005">2005</label>
    <label id="2004" class="radio-inline"><input type="radio" name="2004">2004</label>
    <label id="2003" class="radio-inline"><input type="radio" name="2003">2003</label>
    <label id="2002" class="radio-inline"><input type="radio" name="2002">2002</label>
    <label id="2001" class="radio-inline"><input type="radio" name="2001">2001</label>
    <label id="2000" class="radio-inline"><input type="radio" name="2000">2000</label>
</div>

<script>
    $(document).ready(function() {
        getFinancialHistory();
    });
</script>