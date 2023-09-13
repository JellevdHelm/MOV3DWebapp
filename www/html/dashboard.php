<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styledashboard.css">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>
        window.onload = function() {

            var data_pointsL = [];
            var data_pointsR = [];
            var dataGraph = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Z movement",
                    fontColor: "#ffffff",
                },
                axisY: {
                    title: "Z",
                    labelFontColor: "#ffffff",
                    tickColor: "#ffffff",
                },
                axisX: {
                    labelFontColor: "#ffffff",
                    tickColor: "#ffffff",
                },
                // zoomEnabled: true,
                willReadFrequently: true,
                backgroundColor: "#0F0E16",
                data: [{
                        type: "line",
                        showInLegend: true,
                        name: "Left",
                        dataPoints: data_pointsL,
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Right",
                        dataPoints: data_pointsR,
                    }
                ]
            });
            //2023-04-06T22:25:15.040904Z

            $.getJSON("graphData.php", function(data) {
                $.each(data.ResultsL, function(key, value) {
                    data_pointsL.push({
                        x: value['idL'],
                        y: value['low_pass_zL']
                    });

                });
                $.each(data.ResultsR, function(key, value) {
                    data_pointsR.push({
                        x: value['idR'],
                        y: value['low_pass_z']
                    });

                });

                dataGraph.render();
                updateChart();
            });

            function updateChart() {
                data_pointsL = [];
                data_pointsR = [];
                $.getJSON("graphData.php", function(data) {
                    $.each(data.ResultsL, function(key, value) {
                        data_pointsL.push({
                            x: value['idL'],
                            y: value['low_pass_zL']
                        });

                    });
                    $.each(data.ResultsR, function(key, value) {
                        data_pointsR.push({
                            x: value['idR'],
                            y: value['low_pass_z']
                        });

                    });

                    dataGraph = 0;
                    dataGraph = new CanvasJS.Chart("chartContainer", {
                        title: {
                            text: "Z movement",
                            fontColor: "#ffffff",
                        },
                        axisY: {
                            title: "Z",
                            titleFontColor: "#ffffff",
                            labelFontColor: "#ffffff",
                            tickColor: "#ffffff",
                        },
                        axisX: {
                            labelFontColor: "#ffffff",
                            tickColor: "#ffffff",
                        },
                        willReadFrequently: true,
                        backgroundColor: "#0F0E16",
                        data: [{
                                type: "line",
                                dataPoints: data_pointsL,
                            },
                            {
                                type: "line",
                                dataPoints: data_pointsR,
                            }
                        ]
                    });
                    dataGraph.render();
                    //{"_time":"2023-04-06T22:25:15.040904Z", "low_pass_z":1.1, "steps":2, "threshold":2.2, "x":0.1, "y":0.1, "z":0.1}

                    document.getElementById("prev-z-l").innerHTML = "Filtered z: " + data.ResultsL[data.ResultsL.length - 1].low_pass_zL;
                    document.getElementById("diff-l").innerHTML = "Step threshold: " + data.ResultsL[data.ResultsL.length - 1].thresholdL;
                    document.getElementById("zero-l").innerHTML = "Time: " + data.ResultsL[data.ResultsL.length - 1]._timeL;
                    document.getElementById("steps-l").innerHTML = "Steps: " + data.ResultsL[data.ResultsL.length - 1].stepsL;

                    document.getElementById("prev-z-r").innerHTML = "Filtered z: " + data.ResultsR[data.ResultsR.length - 1].low_pass_z;
                    document.getElementById("diff-r").innerHTML = "Step threshold: " + data.ResultsR[data.ResultsR.length - 1].threshold;
                    document.getElementById("zero-r").innerHTML = "Time: " + data.ResultsR[data.ResultsR.length - 1]._time;
                    document.getElementById("steps-r").innerHTML = "Steps: " + data.ResultsR[data.ResultsR.length - 1].steps;

                    setTimeout(function() {
                        updateChart()
                    }, 1000);
                });
            }
        }
    </script>

</head>

<header>
    <div style="display: none;">
        <?php require_once('graphData.php') ?>
    </div>
    <div class="header-wrap">
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
    </div>
</header>

<body>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    <div class="main">
        <div class="val-wrapper">
            <div id="vals">
                <p id="prev-z-l">Previous Z: 0</p>
                <p id="diff-l">Diff: 0</p>
                <p id="zero-l">Zero: 0</p>
                <p id="steps-l">Steps: 0</p>
            </div>
            <div id="vals">
                <p id="prev-z-r">Previous Z: 0</p>
                <p id="diff-r">Diff: 0</p>
                <p id="zero-r">Zero: 0</p>
                <p id="steps-r">Steps: 0</p>
            </div>
        </div>
    </div>
    <!-- <?php echo json_encode($dataArray, JSON_NUMERIC_CHECK) ?> -->
</body>

</html>