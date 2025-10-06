<div id="chart_div_edad" style="height: 400px;"></div>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initEdadChart);

    function initEdadChart() {
        drawEdadChart();

        const selectEdad = document.getElementById('edadSelect');
        if (selectEdad) {
            selectEdad.addEventListener('change', function () {
                drawEdadChart(this.value);
            });
        }

        window.addEventListener('resize', function () {
            drawEdadChart(selectEdad ? selectEdad.value : '');
        });
    }

    function drawEdadChart(filtroEdad = '') {
        const practicantes = @json($practicantes);
        const conteo = {};

        practicantes.forEach(item => {
            const edad = item.edad;
            if (!filtroEdad || edad == filtroEdad) conteo[edad] = (conteo[edad] || 0) + 1;
        });

        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Edad');
        data.addColumn('number', 'Cantidad');
        data.addColumn({ type: 'string', role: 'style' });

        const colores = ['#c75144', '#8c2d1f', '#d9846b', '#00a696', '#007a63', '#a85c45', '#e09c89', '#00c4b4', '#70422f'];
        let colorIndex = 0;
        for (const edad in conteo) {
            data.addRow([edad, conteo[edad], colores[colorIndex % colores.length]]);
            colorIndex++;
        }
        if (data.getNumberOfRows() === 0) data.addRow(['Sin datos', 1, '#CCCCCC']);

        const chartDiv = document.getElementById('chart_div_edad');
        const options = {
            title: 'Distribución de edades de los practicantes',
            width: '100%',
            height: 400,
            hAxis: { title: 'Edad', slantedText: true, slantedTextAngle: 45 },
            vAxis: { title: 'Cantidad' },
            legend: { position: 'none' },
            bar: { groupWidth: '70%' }
        };

        const chart = new google.visualization.ColumnChart(chartDiv);
        chart.draw(data, options);
    }
</script>