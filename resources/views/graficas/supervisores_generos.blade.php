<div id="chart_div_supervisores" style="height: 400px;"></div>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(initSupervisoresChart);

    function initSupervisoresChart() {
        drawSupervisoresChart();

        var selectSexo = document.getElementById('sexo');
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
        var supervisores = @json($supervisores);

        function normalizarSexo(valor) {
            if (!valor) return 'Desconocido';
            let s = valor.toString().trim().toLowerCase();
            if (s === 'm' || s === 'masculino') return 'Masculino';
            if (s === 'f' || s === 'femenino') return 'Femenino';
            return valor;
        }

        var conteo = {};
        supervisores.forEach(function (item) {
            var sexo = normalizarSexo(item.sexo);
            var filtroNormalizado = normalizarSexo(filtro);
            if (!filtro || sexo === filtroNormalizado) {
                conteo[sexo] = (conteo[sexo] || 0) + 1;
            }
        });

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sexo');
        data.addColumn('number', 'Cantidad');

        for (var sexo in conteo) {
            data.addRow([sexo, conteo[sexo]]);
        }

        if (data.getNumberOfRows() === 0) {
            data.addRow(['Sin datos', 1]);
        }

        var chartDiv = document.getElementById('chart_div_supervisores');
        var options = {
            title: 'Supervisores por género',
            width: '100%', 
            height: chartDiv.offsetHeight || 400,
            is3D: true,
            colors: ['#6BAED6', '#DE2D26', '#969696'],
            legend: { position: 'right' }
        };

        var chart = new google.visualization.PieChart(chartDiv);
        chart.draw(data, options);
    }
</script>
