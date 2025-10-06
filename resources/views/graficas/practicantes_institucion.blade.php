<div id="chart_div_institucion"></div>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initInstitucionChart);

    function initInstitucionChart() {
        drawInstitucionChart();
        var selectInstitucion = document.getElementById('institucionSelect');
        if (selectInstitucion) {
            selectInstitucion.addEventListener('change', function () {
                drawInstitucionChart(this.value);
            });
        }
        window.addEventListener('resize', function () {
            drawInstitucionChart(selectInstitucion.value);
        });
    }
    function drawInstitucionChart(filtro = '') {
        var practicantes = @json($practicantes);
        var conteo = {};
        practicantes.forEach(function (item) {
            var institucion = item.institucion || 'Sin institución';
            if (!filtro || institucion === filtro) {
                conteo[institucion] = (conteo[institucion] || 0) + 1;
            }
        });
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Institución');
        data.addColumn('number', 'Cantidad');
        data.addColumn({ type: 'string', role: 'style' });

        var colores = ['#08306B', '#2171B5', '#4292C6', '#6BAED6', '#9ECAE1', '#C6DBEF', '#DEEBF7', '#F7FBFF', '#BDD7E7'];
        var colorIndex = 0;
        for (var institucion in conteo) {
            data.addRow([institucion, conteo[institucion], colores[colorIndex % colores.length]]);
            colorIndex++;
        }
        if (data.getNumberOfRows() === 0) {
            data.addRow(['Sin datos', 1, '#CCCCCC']);
        }
        var chartDiv = document.getElementById('chart_div_institucion');
        var options = {
            title: 'Distribución institucional de los practicantes',
            width: '100%',
            height: chartDiv.offsetHeight || 300,
            hAxis: { title: 'Institución', slantedText: true, slantedTextAngle: 45 },
            vAxis: { title: 'Cantidad de practicantes' },
            legend: { position: 'none' },
            bar: { groupWidth: '70%' }
        };
        var chart = new google.visualization.ColumnChart(chartDiv);
        chart.draw(data, options);
    }
    
</script>