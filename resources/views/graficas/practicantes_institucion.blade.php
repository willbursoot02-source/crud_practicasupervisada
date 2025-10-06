<div id="chart_div_institucion" style="height: 400px;"></div>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initInstitucionChart);

    function initInstitucionChart() {
        drawInstitucionChart();

        const selectInstitucion = document.getElementById('institucionSelect');
        if (selectInstitucion) {
            selectInstitucion.addEventListener('change', function () {
                drawInstitucionChart(this.value);
            });
        }

        window.addEventListener('resize', function () {
            drawInstitucionChart(selectInstitucion ? selectInstitucion.value : '');
        });
    }

    function drawInstitucionChart(filtro = '') {
        const practicantes = @json($practicantes);
        const conteo = {};

        practicantes.forEach(item => {
            const institucion = item.institucion || 'Sin institución';
            if (!filtro || institucion === filtro) conteo[institucion] = (conteo[institucion] || 0) + 1;
        });

        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Institución');
        data.addColumn('number', 'Cantidad');
        data.addColumn({ type: 'string', role: 'style' });

        const colores = ['#08306B', '#2171B5', '#4292C6', '#6BAED6', '#9ECAE1', '#C6DBEF', '#DEEBF7', '#F7FBFF', '#BDD7E7'];
        let colorIndex = 0;
        for (const institucion in conteo) {
            data.addRow([institucion, conteo[institucion], colores[colorIndex % colores.length]]);
            colorIndex++;
        }
        if (data.getNumberOfRows() === 0) data.addRow(['Sin datos', 1, '#CCCCCC']);

        const chartDiv = document.getElementById('chart_div_institucion');
        const options = {
            title: 'Distribución institucional de los practicantes',
            width: '100%',
            height: 400,
            hAxis: { title: 'Institución', slantedText: true, slantedTextAngle: 45 },
            vAxis: { title: 'Cantidad de practicantes' },
            legend: { position: 'none' },
            bar: { groupWidth: '70%' }
        };

        const chart = new google.visualization.ColumnChart(chartDiv);
        chart.draw(data, options);
    }
</script>