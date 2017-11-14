<article id="teamStatics" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="text-danger">Enemies</span> <small>VS</small> <span class="text-primary">Allies</span></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-offset-1 col-lg-9 col-md-4 col-sm-12">
            <h5>Defence</h5>
            <div id="piechart1" style="min-height:300px;">
                Defence Chart
            </div>
        </div>
        <div class="col-lg-offset-1 col-lg-9 col-md-4 col-sm-12">
            <h5>AD</h5>
            <div id="piechart2" style="min-height:300px;">
                AD Chart
            </div>
        </div>
        <div class="col-lg-offset-1 col-lg-9 col-md-4 col-sm-12">
            <h5>AP</h5>
            <div id="piechart3" style="min-height:300px;">
                AP Chart
            </div>
        </div>
    </div>
</article>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        google.charts.load('current', {
            'packages': ['corechart']
        });
        var c1 = document.getElementById('piechart1');
        var c2 = document.getElementById('piechart2');
        var c3 = document.getElementById('piechart3');
        google.charts.setOnLoadCallback(function() {
            var alliesData = getData('{"{{$allies[0]->getChampion()->getName()}}":[{{$allies[0]->getChampion()->getDefense()}},{{$allies[0]->getChampion()->getAttack()}},{{$allies[0]->getChampion()->getMagic()}}],"{{$allies[1]->getChampion()->getName()}}":[{{$allies[1]->getChampion()->getDefense()}},{{$allies[1]->getChampion()->getAttack()}},{{$allies[1]->getChampion()->getMagic()}}],"{{$allies[2]->getChampion()->getName()}}":[{{$allies[2]->getChampion()->getDefense()}},{{$allies[2]->getChampion()->getAttack()}},{{$allies[2]->getChampion()->getMagic()}}],"{{$allies[3]->getChampion()->getName()}}":[{{$allies[3]->getChampion()->getDefense()}},{{$allies[3]->getChampion()->getAttack()}},{{$allies[3]->getChampion()->getMagic()}}],"{{$allies[4]->getChampion()->getName()}}":[{{$allies[4]->getChampion()->getDefense()}},{{$allies[4]->getChampion()->getAttack()}},{{$allies[4]->getChampion()->getMagic()}}]}', 'desc');
            var enemiesData1 = getData('{"{{$enemies[0]->getChampion()->getName()}}":[{{$enemies[0]->getChampion()->getDefense()}},{{$enemies[0]->getChampion()->getAttack()}},{{$enemies[0]->getChampion()->getMagic()}}],"{{$enemies[1]->getChampion()->getName()}}":[{{$enemies[1]->getChampion()->getDefense()}},{{$enemies[1]->getChampion()->getAttack()}},{{$enemies[1]->getChampion()->getMagic()}}],"{{$enemies[2]->getChampion()->getName()}}":[{{$enemies[2]->getChampion()->getDefense()}},{{$enemies[2]->getChampion()->getAttack()}},{{$enemies[2]->getChampion()->getMagic()}}],"{{$enemies[3]->getChampion()->getName()}}":[{{$enemies[3]->getChampion()->getDefense()}},{{$enemies[3]->getChampion()->getAttack()}},{{$enemies[3]->getChampion()->getMagic()}}],"{{$enemies[4]->getChampion()->getName()}}":[{{$enemies[4]->getChampion()->getDefense()}},{{$enemies[4]->getChampion()->getAttack()}},{{$enemies[4]->getChampion()->getMagic()}}]}', 'asc');
            var defence = [
                ['Champion', 'Defence']
            ].concat(alliesData.de).concat(enemiesData1.de);
            drawChart(c1, defence);
            var ad = [
                ['Champion', 'AD']
            ].concat(alliesData.ad).concat(enemiesData1.ad);
            drawChart(c2, ad);
            var ap = [
                ['Champion', 'AP']
            ].concat(alliesData.ap).concat(enemiesData1.ap);
            drawChart(c3, ap);
        });

        function drawChart(selector, data) {
            var data = google.visualization.arrayToDataTable(data);
            var options = {
                pieHole: 0.4,
                colors: setColor("#337ab7", "#a94442"),
                pieSliceText: "label",
                legend: {
                    position: 'none'
                },
                chartArea: {
                    top: 0,
                    width: '100%',
                    height: '100%'
                }
            };
            var chart = new google.visualization.PieChart(selector);
            chart.draw(data, options);
        }
        function setColor(ally, enemy) {
            var colors = [];
            var i = 0;
            while (i < 5) {
                colors.push(ally);
                i++;
            }
            while (i < 10) {
                colors.push(enemy);
                i++;
            }
            return colors;
        }

        function getData(str, order = 'asc') {
            var de = [];
            var ad = [];
            var ap = [];
            var parsedData = JSON.parse(str);
            for (var championName in parsedData) {
                de.push([championName, parsedData[championName][0]]);
                ad.push([championName, parsedData[championName][1]]);
                ap.push([championName, parsedData[championName][2]]);
            }
            if (order.toLowerCase() === "asc") {
                de.sort(function(a, b) {
                    return a[1] - b[1];
                });
                ad.sort(function(a, b) {
                    return a[1] - b[1];
                });
                ap.sort(function(a, b) {
                    return a[1] - b[1];
                });
            } else {
                de.sort(function(a, b) {
                    return -a[1] + b[1];
                });
                ad.sort(function(a, b) {
                    return -a[1] + b[1];
                });
                ap.sort(function(a, b) {
                    return -a[1] + b[1];
                });
            }
            return {
                de: de,
                ad: ad,
                ap: ap
            };
        }

    })
</script>