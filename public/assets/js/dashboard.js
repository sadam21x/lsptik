$('#dashboard-menu').addClass('active')
init_chart_presentase()

/**
 * Procedure untuk menginisiasi apexcharts presentase perhitungan
 */
function init_chart_presentase() {
    var options = {
        chart: {
            type: 'pie'
        },
        series: [TOTAL_PERHITUNGAN_FAKTORIAL, TOTAL_PERHITUNGAN_PERPANGKATAN],
        labels: ['Faktorial', 'Perpangkatan']
    }

    var chart = new ApexCharts(document.querySelector("#chart_presentase"), options);
    chart.render();
}
