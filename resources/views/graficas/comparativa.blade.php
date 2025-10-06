<div id="chart_div_comparativa" style="height: 400px;"></div>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initComparativaChart);

    function initComparativaChart() {
        drawComparativaChart();

        const selectTipo = document.getElementById('tipoSelect');
        if (selectTipo) {
            selectTipo.addEventListener('change', function () {
                drawComparativaChart(this.value);
            });
        }

        window.addEventListener('resize', function () {
            drawComparativaChart(selectTipo ? selectTipo.value : '');
        });
    }

    function drawComparativaChart(filtro = '') {
        const totalSupervisores = @json($totalSupervisores);
        const totalPracticantes = @json($totalPracticantes);

        const dataComparativa = new google.visualization.DataTable();
        dataComparativa.addColumn('string', 'Tipo');
        dataComparativa.addColumn('number', 'Cantidad');

        if (!filtro || filtro === 'Supervisores') dataComparativa.addRow(['Supervisores', totalSupervisores]);
        if (!filtro || filtro === 'Practicantes') dataComparativa.addRow(['Practicantes', totalPracticantes]);
        if (dataComparativa.getNumberOfRows() === 0) dataComparativa.addRow(['Sin datos', 1]);

        const chartDiv = document.getElementById('chart_div_comparativa');
        const optionsComparativa = {
            title: 'Cantidad de Supervisores y Practicantes',
            width: '100%',
            height: 400,
            is3D: true,
            colors: ['#2171B5', '#c75144'],
            legend: { position: 'right' }
        };

        const chart = new google.visualization.PieChart(chartDiv);
        chart.draw(dataComparativa, optionsComparativa);
    }
</script>