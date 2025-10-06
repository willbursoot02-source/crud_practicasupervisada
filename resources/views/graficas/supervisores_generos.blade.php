<div id="chart_div_supervisores" style="height: 400px;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initSupervisoresChart);

    function initSupervisoresChart() {
        drawSupervisoresChart();

        const selectSexo = document.getElementById('sexo');
        if (selectSexo) {
            selectSexo.addEventListener('change', function () {
                drawSupervisoresChart(this.value);
            });
        }

        window.addEventListener('resize', function () {
            drawSupervisoresChart(selectSexo ? selectSexo.value : '');
        });
    }

    function drawSupervisoresChart(filtro = '') {
        const supervisores = @json($supervisores);

        function normalizarSexo(valor) {
            if (!valor) return 'Desconocido';
            const s = valor.toString().trim().toLowerCase();
            if (s === 'm' || s === 'masculino') return 'Masculino';
            if (s === 'f' || s === 'femenino') return 'Femenino';
            return valor;
        }

        const conteo = {};
        supervisores.forEach(item => {
            const sexo = normalizarSexo(item.sexo);
            const filtroNormalizado = normalizarSexo(filtro);
            if (!filtro || sexo === filtroNormalizado) conteo[sexo] = (conteo[sexo] || 0) + 1;
        });

        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Sexo');
        data.addColumn('number', 'Cantidad');

        for (const sexo in conteo) data.addRow([sexo, conteo[sexo]]);
        if (data.getNumberOfRows() === 0) data.addRow(['Sin datos', 1]);

        const chartDiv = document.getElementById('chart_div_supervisores');
        const options = {
            title: 'Supervisores por género',
            width: '100%',
            height: 400,
            is3D: true,
            colors: ['#6BAED6', '#DE2D26', '#969696'],
            legend: { position: 'right' }
        };

        const chart = new google.visualization.PieChart(chartDiv);
        chart.draw(data, options);
    }
</script>