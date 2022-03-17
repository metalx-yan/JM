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
         
          <table id="manage_menu" class="table table-bordered table-striped text-center align-middle" width="100%">
            <thead>
                <tr class="text-center">
                  <th scope="col">ID Job</th>
                  <th scope="col">Job Title</th>
                  <th scope="col">Position</th>
                  <th scope="col">Sender</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal_view"></div>
  </section>

  <script>
    $(document).ready(function() {
      chrt1()
      chrt2()

      function chrt1() {
        var data = {
          labels: [
            "JOB"
          ],
          datasets: [{
            data: [300],
            backgroundColor: [
              "#36A2EB"

            ],
            hoverBackgroundColor: [
              "#36A2EB"

            ]
          }]
        };
        // glob_1()

        var chart1 = new Chart(document.getElementById('myChart'), {
          type: 'doughnut',
          data: data,
          options: {
            responsive: true,
            legend: {
              display: true
            }
          }
        });
      }

      function chrt2() {
        var data2 = {
          labels: [
            "fg"
          ],
          datasets: [{
            data: [300],
            backgroundColor: [
              "#fd7e14"

            ],
            hoverBackgroundColor: [
              "#fd7e14"

            ]
          }]
        };


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
        // glob_2()
        Chart.pluginService.register({
          beforeDraw: function(chart) {
            var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;

            ctx.restore();
            var fontSize = (height / 114).toFixed(2);
            ctx.font = fontSize + "em sans-serif";
            ctx.textBaseline = "top";

            const text = "5%",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;

            ctx.fillText(text, textX, textY);
            ctx.save();
          }
        });
      }

      // function glob_1() {
      //   const tutu = Chart.pluginService.register({
      //     beforeDraw: function(chart) {
      //       var width = chart.chart.width,
      //         height = chart.chart.height,
      //         ctx = chart.chart.ctx;

      //       ctx.restore();
      //       var fontSize = (height / 114).toFixed(2);
      //       ctx.font = fontSize + "em sans-serif";
      //       ctx.textBaseline = "top";

      //       const text = "7%",
      //         textX = Math.round((width - ctx.measureText(text).width) / 2),
      //         textY = height / 2;

      //       ctx.fillText(text, textX, textY);
      //       ctx.save();
      //     }
      //   });
      // }

      // function glob_2() {
      //   const tutu1 = chart2.pluginService.register({
      //     beforeDraw: function(chart) {
      //       var width = chart.chart.width,
      //         height = chart.chart.height,
      //         ctx = chart.chart.ctx;

      //       ctx.restore();
      //       var fontSize = (height / 114).toFixed(2);
      //       ctx.font = fontSize + "em sans-serif";
      //       ctx.textBaseline = "top";

      //       const text = "5%",
      //         textX = Math.round((width - ctx.measureText(text).width) / 2),
      //         textY = height / 2;

      //       ctx.fillText(text, textX, textY);
      //       ctx.save();
      //     }
      //   });
      // }

      var datatable = $('#manage_menu').DataTable({
        "destroy": true,
        "processing": false,
        "responsive": true,
        "serverSide": true,
        "ordering": true,
        "searching": false,  
        "ajax": {
            "url": "<?= base_url('/Home_c/get/'); ?>", 
            "type": "POST",
            "data": '',
            beforeSend: function() {
                $("#loader").show();
            },
            complete: function() {
                $("#loader").hide();
            },
        },
        "deferRender": true,
        "aLengthMenu": [
            [5, 10, 50],
            [5, 10, 50]
        ],  
        "columns": [
           
                {
                    "data": "position_id"
                },
                {
                    "data": "job_title"
                },
                {
                    "data": "position_name"
                },
                {
                    "data": "nama"
                },
                {
                    data: null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="view_modal()">View</button>'
                        return views
                    },

                }
                
              
            ],
    });
  })

    function view_modal() {
        var val = {};
        val.modal = 'MODAL VIEW JOB';
        val.id = 'modal_view';
        val.form_id = "form_" + val.id;
        val.job = event.target.value;
        console.log(val);
        $.ajax({
            url: '<?= base_url('/Home_c/modal_view/') ?>',
            type: "post",
            data: val,
            success: function(res) {
                $(".modal_view").html(res);
                $('#modal_view').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modal_view').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    };

    function action_submit(data_) {
      action = $(data_).attr('data');
      $('#error').html(" ");
      form = $(action).serialize();
      console.log(form)
    
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Management/Position_c/validate'); ?>",
            data: form,
            dataType: "json",
            success: function(data) {
                
                if (data.action == 'ok') {
                    if (action == 'save') {
                        save(form);
                    } else {
                        approve(form);
                    }
                } else {
                    $.each(data, function(key, value) {
                        if (value == '') {
                            $('#input-' + key).removeClass('is-invalid');
                            $('#input-' + key).addClass('is-valid');
                            $('#input-' + key).parents('.form-group').find('#error').html(value);
                        } else {
                            $('#input-' + key).addClass('is-invalid');
                            $('#input-' + key).parents('.form-group').find('#error').html(value);
                        }
                    });
                }

            }
        });
  }

    // var data2 = {
    //   labels: [
    //     "fg"
    //   ],
    //   datasets: [{
    //     data: [300],
    //     backgroundColor: [
    //       "#fd7e14"

    //     ],
    //     hoverBackgroundColor: [
    //       "#fd7e14"

    //     ]
    //   }]
    // };

    // Chart.pluginService.register({
    //   beforeDraw: function(chart) {
    //     var width = chart.chart.width,
    //       height = chart.chart.height,
    //       ctx = chart.chart.ctx;

    //     ctx.restore();
    //     var fontSize = (height / 114).toFixed(2);
    //     ctx.font = fontSize + "em sans-serif";
    //     ctx.textBaseline = "top";

    //     var text = "5%",
    //       textX = Math.round((width - ctx.measureText(text).width) / 2),
    //       textY = height / 2;

    //     ctx.fillText(text, textX, textY);
    //     ctx.save();
    //   }
    // });

    // var chart2 = new Chart(document.getElementById('myChart2'), {
    //   type: 'doughnut',
    //   data: data2,
    //   options: {
    //     responsive: true,
    //     legend: {
    //       display: true
    //     }
    //   }
    // });
  </script>

