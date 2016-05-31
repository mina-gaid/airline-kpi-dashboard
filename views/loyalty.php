<h1>Aries Air Loyalty</h1>

<br>

<ul class="nav nav-tabs" id="menu">
    <li class="active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Loyal Customers<span class="caret"></span></a></a>
        <ul class="dropdown-menu">
            <li><a onclick="getBronzeLevel()" href="#">Bronze</a></li>
            <li><a onclick="getSilverLevel()" href="#">Silver</a></li>
            <li><a onclick="getGoldLevel()" href="#">Gold</a></li>
        </ul></li>
    <li onclick="getFrequentTravellers()"><a href="#">Frequent Travellers</a></li>
</ul>

<div id="chart"></div>

<script type="text/javascript">
    $(document).ready(function () {
        getBronzeLevel();
    });
</script>