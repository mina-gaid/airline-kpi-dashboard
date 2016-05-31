google.load('visualization', '1', {'packages': ['corechart', 'columnchart']});

function getFinancialHistory() {
    
    $("#selector, #chart2, #chart3, #chart4").css({"display": "none"});
    $("#chart").css({"display": "block"});
    
    var json = $.ajax({
        url: "/api/reports",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);
    var chart = new google.visualization.ScatterChart(document.getElementById('chart'));
    

    var options = {
        title: 'Yearly Financial History',
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        },
        vAxis: {title: 'Income',maxValue: 2500000},
        bubble: {textStyle: {fontSize: 11}}
    };

    chart.draw(data, options);
}

function getPopularDestinations() {

    $("#selector, #chart2, #chart3, #chart4").css({"display": "none"});
    $("#chart").css({"display": "block"});

    var ajax = $.ajax({
        url: "/api/popular/destinations",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(ajax);

    var options = {
        title: 'Popular Destinations',
        animation: {
            duration: 1000,
            easing: 'in',
            startup: true
        },
        is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getYearlyData(year) {

    $("#selector").css({"display": "block"});
    $("#chart").css({"display": "block"});
    $("#chart2, #chart3, #chart4").css({"display": "none"});

    var json = $.ajax({
        url: "/api/report/" + year,
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: year + ' Report',
        vAxis: {title: 'Income'},
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getAOI() {

    var json = $.ajax({
        url: "/api/aoi",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Areas of Improvements',
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getRatings() {

    var json = $.ajax({
        url: "/api/ratings",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Customer Ratings',
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getBronzeLevel() {

    var json = $.ajax({
        url: "/api/customer/bronze",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Bronze Customers',
        pointSize: 30,
        colors: ['#CD7F32'],
        pointShape: {type: 'star', sides: 5, dent: 0.2},
        animation: {
            duration: 1000,
            easing: 'inAndOut',
            startup: true
        }

    };

    var chart = new google.visualization.ScatterChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getSilverLevel() {

    var json = $.ajax({
        url: "/api/customer/silver",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Silver Customers',
        pointSize: 30,
        is3D: true,
        colors: ['#C0C0C0'],
        pointShape: {type: 'star', sides: 5, dent: 0.2},
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }

    };

    var chart = new google.visualization.ScatterChart(document.getElementById('chart'));
    chart.draw(data, options);

}

function getGoldLevel() {

    var json = $.ajax({
        url: "/api/customer/gold",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Gold Customers',
        pointSize: 30,
        is3D: true,
        colors: ['#ffd700'],
        pointShape: {type: 'star', sides: 5, dent: 0.2},
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }

    };

    var chart = new google.visualization.ScatterChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getFrequentTravellers() {

    var json = $.ajax({
        url: "/api/customer/frequent",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);

    var options = {
        title: 'Frequent Travellers',
        height: '500',
        animation: {
            duration: 1000,
            easing: 'out',
            startup: true
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getDestinationProfits() {

    $("#selector, #chart2, #chart3, #chart4").css({"display": "none"});
    $("#chart").css({"display": "block"});

    var ajax = $.ajax({
        url: "/api/popular/destinationProfits",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(ajax);

    var options = {
        vAxis: {title: 'Total Income'},
        title: 'Destination Profits',
        animation: {
            duration: 1000,
            easing: 'inAndOut',
            startup: true
        },
        is3D: true
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
    chart.draw(data, options);
}

function getAverageTicketPrice() {

    $("#selector").css({"display": "none"});
    $("#chart").css({"display": "none"});
    $("#chart2, #chart3, #chart4").css({"display": "block"});

    var ajax = $.ajax({
        url: "/api/popular/averageTicketPrice",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(ajax);

    var options = {
        vAxis: {title: 'Ticket Price'},
        title: 'Average Yearly Ticket Price',
        animation: {
            duration: 1000,
            easing: 'inAndOut',
            startup: true
        },
        is3D: true
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart2'));
    chart.draw(data, options);
}

function getAverageMonthlyTicketPrice() {

    $("#selector").css({"display": "none"});
    $("#chart").css({"display": "none"});

    var ajax = $.ajax({
        url: "/api/popular/averageMonthlyTicketPrice",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(ajax);

    var options = {
        vAxis: {title: 'Ticket Price'},
        title: 'Average Monthly Ticket Price',
        animation: {
            duration: 1000,
            easing: 'inAndOut',
            startup: true
        },
        is3D: true
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart4'));
    chart.draw(data, options);
}

function getAverageYearlyTicketCompare() {

    $("#selector").css({"display": "none"});
    $("#chart").css({"display": "none"});

    var ajax = $.ajax({
        url: "/api/popular/averageYearlyTicketCompare",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(ajax);

    var options = {
        title: 'Last Years Ticket Average Comparison',
        vAxis: {title: 'Ticket Price'},
        animation: {
            duration: 1000,
            easing: 'inAndOut',
            startup: true
        },
        is3D: true
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart3'));
    chart.draw(data, options);
}

$('.radio-inline').click(function () {
    $("input:radio").removeAttr("checked");
    var id = $(this).attr('id');
    getYearlyData(id);
});

$('.nav li a').click(function (e) {
    $('.nav li').removeClass('active');
    var $parent = $(this).parent();
    if (!$parent.hasClass('active')) {
        $parent.addClass('active');
    }
});