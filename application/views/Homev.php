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
          <p><span class="badge rounded-pill " style="background-color: #f26a44;">&nbsp;</span> <b style="font-size: 14px;">On Progress</b></p> 
          <p><span class="badge rounded-pill " style="background-color: #f2d544;">&nbsp;</span> <b style="font-size: 14px;">Validasi Job (Admin)</b></p>
          <p><span class="badge rounded-pill " style="background-color: #3fd467;">&nbsp;</span> <b style="font-size: 14px;">Validasi Job Profile (Admin)</b></p>
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
  <div class="modal_review"></div>
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
        // rowCallback: function(row, data, index){
        //   if(data.status == '1'){
        //     $(row).find('td:eq(0)').css('background-color', '#f2d544').css('color', 'white');
        //   }
        //   if(data.status == '0'){
        //     $(row).find('td:eq(0)').css('background-color', '#f26a44').css('color', 'white');
        //   }
        //   if(data.status_akhir == '1'){
        //     $(row).find('td:eq(0)').css('background-color', '#f26a44').css('color', 'white');
        //   }
        // },
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
                    "data": "job_name"
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
                      if (data.role == '100') {
                        // if (data.status_akhir == 0) {
                          views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="view_modal()">View</button>'
                          return views
                        // }
                      } else {
                        views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="review_modal()">View</button>'
                        return views
                      }
                    },

                }
                
              
            ],
    });
  })
    function close_modal(data_) {
        action = $(data_).attr('data');
        $("#" + action).remove();
    }

    function view_modal() {
        var val = {};
        val.modal = 'MODAL VIEW JOB';
        val.id = 'modal_view';
        val.approve = 'modal_approve';
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
      form = $("#form_" + 'modal_view').serialize();
      console.log(action)
    
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('/Home_c/validate'); ?>",
            data: form,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data.action == 'ok') {
                    if (action == 'modal_view') {
                        save(form);
                    } else {
                      approve(form);

                        // approve(form);
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

  function review_modal() {
    var val = {};
    val.modal = 'MODAL REVIEW JOB';
    val.id = 'modal_review';
    val.form_id = "form_" + val.id;
    val.position = event.target.value;
    // console.log(val.position)
    val.tujuan = 'tujuan';
    val.tugas = 'tugas';
    val.kewenangan = 'kewenangan';
    val.kompetensi = 'kompetensi';
    val.kualifikasi = 'kualifikasi';
    val.kpi = 'kpi';
    $.ajax({
        url: '<?= base_url('Home_c/modal_review/') ?>',
        type: "post",
        data: val,
        success: function(res) {

            $(".modal_review").html(res);
            $('#modal_review').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_review').modal('show');
            
            $('#input-tingkat_pendidikan').change(function(){ 
                // alert('tes');
                // var value = $(this).val();
                var value = $('#input-tingkat_pendidikan option:selected').text();
                var val = {};
                val.tingkat_pendidikan = value;
                console.log(value)
                $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
                console.log(data);
                    $('.jurusan').html(data);
                });
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('gagal');
        }
    });
};

  function save(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/save/') ?>',
                  type: "post",
                  data: form,
                  beforeSend: function() {
                      $("#loader").show();
                  },
                  complete: function() {
                      $("#loader").hide();
                  },
                  success: function(res) {
                      if (res == 'Berhasil di Simpan') {
                          $('#modal_edit').modal('hide');
                          Swal.fire({
                              title: 'Your has been saved.',
                              icon: 'success',
                          });

                          setTimeout(function() {
                              location.reload(true);
                          }, 1000);
                      } else {
                          $('#modal_edit').modal('hide');
                          Swal.fire({
                              title: res,
                              icon: 'error',
                          });

                        
                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      alert('gagal');
                  }
              });
          }
      })
  }

  function approve(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/approve/') ?>',
                  type: "post",
                  data: form,
                  beforeSend: function() {
                      $("#loader").show();
                  },
                  complete: function() {
                      $("#loader").hide();
                  },
                  success: function(res) {
                      if (res == 'Berhasil di Simpan') {
                          $('#modal_edit').modal('hide');
                          Swal.fire({
                              title: 'Your has been saved.',
                              icon: 'success',
                          });

                          setTimeout(function() {
                              location.reload(true);
                          }, 1000);
                      } else {
                          $('#modal_edit').modal('hide');
                          Swal.fire({
                              title: res,
                              icon: 'error',
                          });

                        
                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      alert('gagal');
                  }
              });
          }
      })
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

