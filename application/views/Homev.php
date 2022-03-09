<section class="body-content">
    <div class="row w-100">
        <div class="col-md-12 text-center mx-auto">
            <h3>"SELAMAT DATANG DI WEBSITE JOB MANAGEMENT"</h3>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-md-12">
            <div class=" ms-5 me-5">
                <div class="card-header bg-warning mb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6><?= $title_head ?></h6>
                        </div>
                        <div class="col-6 text-end">
                            <!-- <?= $access_crud['access_add'] ?> -->
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div style="width:600px; height:320px;">
                                <canvas id="myChart"></canvas>

                            </div>
                        </div>
                        <div class="col-md-1"></div>

                        <div class="col-md-3">
                            <div style="width:600px; height:320px;">
                                <canvas id="myChart2"></canvas>

                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
 var data = {
  labels: [
    "JOB"
  ],
  datasets: [
    {
      data: [300],
      backgroundColor: [
       "#36A2EB"
       
      ],
      hoverBackgroundColor: [
       "#36A2EB"
       
      ]
    }]
};

Chart.pluginService.register({
  beforeDraw: function(chart) {
    var width = chart.chart.width,
        height = chart.chart.height,
        ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = (height / 114).toFixed(2);
    ctx.font = fontSize + "em sans-serif";
    ctx.textBaseline = "top";

    var text = "75%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;

    ctx.fillText(text, textX, textY);
    ctx.save();
  }
});

var chart = new Chart(document.getElementById('myChart'), {
  type: 'doughnut',
  data: data,
  options: {
  	responsive: true,
    legend: {
      display: true
    }
  }
});
</script>

<script>
 var data2 = {
  labels: [
    "JOB"
  ],
  datasets: [
    {
      data: [300],
      backgroundColor: [
        "#fd7e14"
       
      ],
      hoverBackgroundColor: [
        "#fd7e14"
       
      ]
    }]
};

Chart.pluginService.register({
  beforeDraw: function(chart) {
    var width = chart.chart.width,
        height = chart.chart.height,
        ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = (height / 114).toFixed(2);
    ctx.font = fontSize + "em sans-serif";
    ctx.textBaseline = "top";

    var text = "75%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;

    ctx.fillText(text, textX, textY);
    ctx.save();
  }
});

var chart2 = new Chart(document.getElementById('myChart2'), {
  type: 'doughnut',
  data: data2,
  options: {
  	responsive: true,
    legend: {
      display: true
    }
  }
});
</script>


</section>