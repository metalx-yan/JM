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
          <?php if ($_SESSION['jabatan'] == '100') { ?>
          <p><span class="badge rounded-pill " style="background-color: #f26a44;">&nbsp;</span> <b style="font-size: 14px;">On Progress Validation Job</b></p> 
          <p><span class="badge rounded-pill " style="background-color: rgb(88 183 165);">&nbsp;</span> <b style="font-size: 14px;">Waiting For Job Profile Submission</b></p> 
          <p><span class="badge rounded-pill " style="background-color: #f2d544;">&nbsp;</span> <b style="font-size: 14px;">On Progress Validation Job Profile</b></p>
          <p><span class="badge rounded-pill " style="background-color: #3fd467;">&nbsp;</span> <b style="font-size: 14px;">Validation Approved</b></p>
          <table id="manage_menu" class="table table-bordered text-center align-middle" width="100%">
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
          <?php } else if ($_SESSION['jabatan'] == '101') {?>
            <p><span class="badge rounded-pill " style="background-color: rgb(92 88 183);">&nbsp;</span> <b style="font-size: 14px;">Sent Srom Delegate</b></p> 
            <p><span class="badge rounded-pill " style="background-color: rgb(88 183 165);">&nbsp;</span> <b style="font-size: 14px;">Waiting Send Job Profile</b></p> 
            <p><span class="badge rounded-pill " style="background-color: #cad92e;">&nbsp;</span> <b style="font-size: 14px;">Waiting Approve Job Profile</b></p> 
            <p><span class="badge rounded-pill " style="background-color: #3fd467;">&nbsp;</span> <b style="font-size: 14px;">Validation Approved</b></p>
            <table id="manage_menu" class="table table-bordered text-center align-middle" width="100%">
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
          <?php } else {?>
            <table id="manage_menu" class="table table-bordered text-center align-middle" width="100%">
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
          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>
  <div class="modal_view"></div>
  <div class="modal_read"></div>
  <div class="modal_review"></div>
  <div class="modal_delegate"></div>
  </section>

  <script>
    $(document).ready(function() {

      var datatable = $('#manage_menu').DataTable({
        rowCallback: function(row, data, index){
          if (data.role == '100') {
            if(data.status == '0' && data.status_akhir == null){
              $(row).find('td:eq(0)').css('background-color', '#f26a44').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == null){
              $(row).find('td:eq(0)').css('background-color', 'rgb(88 183 165)').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == '3'){
              $(row).find('td:eq(0)').css('background-color', 'rgb(88 183 165)').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == '0'){
              $(row).find('td:eq(0)').css('background-color', '#f2d544').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == '1'){
              $(row).find('td:eq(0)').css('background-color', '#3fd467').css('color', 'white');
            }
          } else {
            if(data.status == '1' && data.status_akhir == null && data.role == '101'){
              $(row).find('td:eq(0)').css('background-color', 'rgb(88 183 165)').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == '3'){
              $(row).find('td:eq(0)').css('background-color', 'rgb(92 88 183)').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == 0){
              $(row).find('td:eq(0)').css('background-color', '#cad92e').css('color', 'white');
            }
            if(data.status == '1' && data.status_akhir == 1){
              $(row).find('td:eq(0)').css('background-color', '#3fd467').css('color', 'white');
            }
          }
         
        },
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
                      } else if (data.role == '101') {
                        if (data.delegate_to != null) {
                            views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="review_modal()">View</button>'
                        } else {
                            views = ''
                        }
                        return views 
                    //   } else if (data.role != '101' && data.role != '100'  && data.role != '102' && data.mapping_by != null) {
                      } else if (data.status_del_read == 'read' && data.status_read == '1') {
                        views = '<button id="btn-reads" value="'+data.id+'" class="btn btn-warning m-3" onclick="read_modal()">Read</button>'
                        print = '<button id="btn-reads" value="'+data.id+'" class="btn btn-secondary m-3" onclick="print_data()">Print</button>'
                        return views + print
                      } else if (data.status_del_read == 'read' && data.status_read != '1') {
                        views = '<button id="btn-reads" value="'+data.id+'" class="btn btn-warning m-3" onclick="read_modal()">Read</button>'
                        return views
                      } else if(data.status_del_read == 'delegate'){
                          if (data.status == '3' && data.send_back == null) {
                              views = '<button id="btn-views" value="'+data.id+'" class="btn btn-success m-3" onclick="delegate_modal()">Data Terkirim Ke PUK</button>'
                            } else if(data.status == null && data.send_back != null) {
                                views = '<button id="btn-views" value="'+data.id+'" class="btn btn-danger m-3" onclick="delegate_modal()">Data harus diperbaiki</button>'
                            } else {
                                views = '<button id="btn-views"  value="'+data.id+'" class="btn btn-warning m-3" onclick="delegate_modal()">Edit</button>'
                            }

                        return views
                      }
                    },

                }
                
              
            ],
    });
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

        $('#input-direktorat').change(function(){ 
            // alert('tes');
            var value = $(this).val();
            var val = {};
            val.direktorat = value;
            $.post('<?php echo base_url()?>Management/Job_m_c/change_direktorat',val,function(data){ 
            console.log(data);
                $('.organisasi').html(data);
            });
        });

        $('#input-organisasi').change(function(){ 
            // alert('tes');
            var value = $(this).val();
            var val = {};
            val.organisasi = value;
            $.post('<?php echo base_url()?>Management/Job_m_c/change_organisasi',val,function(data){ 
            console.log(data);
                $('.posisi').html(data);
            });
        });

        
  })


    function close_modal(data_) {
        action = $(data_).attr('data');
        $("#" + action).remove();
    }

    function read_modal() {
        var val = {};
        val.modal = 'MODAL READ JOB';
        val.id = 'modal_read';
        val.form_id = "form_" + val.id;
        val.job = event.target.value;
        console.log(val);
        val.tujuan = 'tujuan';
        val.tugas = 'tugas';
        val.kewenangan = 'kewenangan';
        val.kompetensi = 'kompetensi';
        val.kualifikasi = 'kualifikasi';
        $.ajax({
            url: '<?= base_url('Home_c/read_job/') ?>',
            type: "POST",
            data: val,
            success: function(res) {
                $(".modal_read").html(res);
                $('#modal_read').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modal_read').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    };

    function view_modal() {
        var val = {};
        val.modal = 'MODAL VIEW JOB';
        val.id = 'modal_view';
        val.approve = 'modal_approve';
        val.approve_job_profile = 'modal_approve_job_profile';
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

    function print_data(){
        data = event.target.value
        console.log(data);
        var val = {};
        val.job_list_id = data
        $.ajax({
            url: '<?= base_url('/Home_c/print/') ?>',
            type: "GET",
            data: val,
            success: function(res) {
                enc = btoa(val.job_list_id+ ' _')
                window.open('<?php echo base_url() ?>/Home_c/print/?string='+ enc);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('gagal');
            }
        });
    }

    function action_submit(data_) {
      action = $(data_).attr('data');
      action_send_back = $(data_).attr('data_delegate');
      $('#error').html(" ");
      form = $("#form_" + 'modal_view').serialize();
      $('#error').html(" ");
      formo = $("#form_" + action).serialize();
      console.log(action_send_back)
      if (action == 'kualifikasi'  || action == 'tugas' || action == 'modal_send_admin' || action == 'tujuan' || action == 'kewenangan' || action == 'kompetensi' || action == 'kpi' || action == 'kualifikasi' || action == 'delegate_individu' || action == 'read' || action == 'send_back') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Management/Job_m_c/validate_kual'); ?>",
                data: form,
                dataType: "json",
                success: function(data) {
                  console.log(form)
                    if (data.action == 'ok') {
                        if (action == 'modal_send_admin') {
                            send(action_send_back)
                        }  else if (action == 'kewenangan' || action == 'kompetensi' || action == 'kpi' || action == 'kualifikasi') {
                            save_multiple(formo);
                        } else if (action == 'tujuan') {
                            saving(formo);
                        }  else if (action == 'delegate_individu') {
                            delegate_individu_to_admin(formo);
                        } else if (action == 'read') {
                            read_job(formo);
                        } else if(action == 'send_back') {
                            send_back(action_send_back);
                        } else {
                            save_multiple(formo);
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
            
        } else {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Home_c/validate'); ?>",
            data: form,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data.action == 'ok') {
                    if (action == 'modal_view') {
                        save(form);
                    } else if(action == 'modal_approve_job_profile') {
                        approve_job_profile(form);
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
  }

  function delegate_modal() {
    var val = {};
    val.modal = 'MODAL EDIT JOB';
    val.id = 'modal_delegate';
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
        url: '<?= base_url('Home_c/modal_delegate/') ?>',
        type: "post",
        data: val,
        success: function(res) {

            $(".modal_delegate").html(res);
            $('#modal_delegate').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_delegate').modal('show');
            
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

function delegate_individu_to_admin(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/delegate_individu_to_admin/') ?>',
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

  function send(form){
      var data = {};
      data.delegate = form
      console.log(data)
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('/Home_c/send_admin/') ?>',
                    type: "post",
                    data: data,
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    complete: function() {
                        $("#loader").hide();
                    },
                    success: function(res) {
                        if (res == 'Berhasil di Simpan') {
                            $('#modal_send_admin').modal('hide');
                            Swal.fire({
                                title: 'Your has been saved.',
                                icon: 'success',
                            });

                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        } else {
                            alert(res)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('gagal');
                    }
                });
            }
        })
    }

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

  function read_job(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/read_save/') ?>',
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

  function send_back(form) {
      var data = {};
      data.delegate = form
      console.log(data);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/send_back_save/') ?>',
                  type: "post",
                  data: data,
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

  function saving(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/saving/') ?>',
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
                          // $('#modal_edit').modal('hide');
                          Swal.fire({
                              title: 'Your has been saved.',
                              icon: 'success',
                          });

                          // setTimeout(function() {
                          //     location.reload(true);
                          // }, 1000);
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
  function save_multiple(form) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('Management/Job_m_c/save_multiple_/') ?>',
                type: "post",
                data: form,
                beforeSend: function() {
                    $("#loader").show();
                },
                complete: function() {
                    $("#loader").hide();
                },
                success: function(res) {
                    console.log(res)
                    if (res == 'Berhasil di Simpan') {
                        // $('#modal_edit').modal('hide');
                        Swal.fire({
                            title: 'Your has been saved.',
                            icon: 'success',
                        });

                        // setTimeout(function() {
                        //     location.reload(true);
                        // }, 1000);
                    } else {
                        alert(res)
                        // console.log(res)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('gagal');
                }
            });
        }
    })
}

  function approve_job_profile(form) {
      console.log(form);
      Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Cancel`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: '<?= base_url('/Home_c/save_job_profile/') ?>',
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

  function check_dropdown(data_) {
      action = $(data_).attr('id');
      action_data = $(data_).attr('data');
      // console.log(action_data)
      var value = $('#'+action +' option:selected').text();
      var val = {};
      val.tingkat_pendidikan = value;
      $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
          $('.jurusan'+action_data).html(data);
          // console.log(data)
      });

  }

  
function tabs(data_) {
    action = $(data_).attr('data');
    console.log(action);
    var arr = []
    arr.push($('div#inputFormRow_'+action))
    var test = '';
    if (arr[0].length >= 0 ) {
        $('.btn_save_'+action).attr('disabled', false);
        test = arr[0].length+1;
    } else {
        test = arr[0].length;
    }
    // add row
    var html = '';
    if (action == 'kualifikasi') {
        html = '<div id="inputFormRow_'+ action +'"><div class="row"><div class="col-md-3"> <label for="">Tingkat Pendidikan</label><select name="tingkat_pendidikan[]" id="input-tingkat_pendidikan'+test+'" class="form-select form-select-sm" aria-label=".form-select-sm example"><?php foreach($tingkat_pendidikan as $tingkat):?><option value="<?= $tingkat['id']?>"><?= $tingkat['edu_name']; ?></option><?php endforeach; ?></select><span id="error"></span></div><div class="col-md-3"> <label for="">Jurusan</label><select name="jurusan[]" id="input-jurusan" class="form-select form-select-sm jurusan'+test+'" aria-label=".form-select-sm example"> </select> <span id="error"></span></div> <div class="col-md-3"><label for="">Persyaratan Khusus</label><input type="text" id="input-syarat"  value="<?php echo (('a') ? '' : '') ?>" name="syarat[]" class="form-control form-control-sm" required> <span id="error"></span></div><div class="col-md-3 d-flex align-content-end flex-wrap"><button id="removeRow_'+ action +'" data="'+ action +'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div></div>';
        
    } else {
        var html = '<div id="inputFormRow_'+ action+ '"><div class="input-group mb-3"><input type="text" name="field_'+action+'[]" class="form-control form-control-sm m-input enter_'+action +'" placeholder="" autocomplete="off"><div class="input-group-append"><button id="removeRow_' +action+ '"  data="'+action+'" onclick="dels(this)" type="button" class="btn btn-danger btn-sm">Remove</button></div></div>';
    }

    $('#newRow_'+action).append(html);

    $('#input-tingkat_pendidikan'+test).change(function(){ 
        var value = $(this).val();
        var value = $('#input-tingkat_pendidikan'+test+' option:selected').text();
        var val = {};
        val.tingkat_pendidikan = value;
        console.log(value)
        $.post('<?php echo base_url()?>Management/Job_m_c/change_jurusan',val,function(data){ 
        console.log(data);
            $('.jurusan'+test).html(data);
        });
    });
}

  function dels(data_){
      action = $(data_).attr('data');

      var arr = []
      arr.push($('div#inputFormRow_'+action))
      if (arr[0].length <= 1) {
          $('.btn_save_'+action).attr('disabled', true);
      } 
      console.log(arr[0].length);

      $(document).on('click', '#removeRow_' +action , function () {
          $(this).closest('#inputFormRow_'+action).remove();
      });
  }

  function navtab(data_){
      action = $(data_).attr('data');
      var data_navtab = $('div#inputFormRow_'+action).length;
      console.log(data_navtab)
      if (data_navtab > 0) {
          $('.btn_save_'+action).attr('disabled', false);
      } else {
          $('.btn_save_'+action).attr('disabled', true);
      }
      // console.log(data_navtab);
  }



function area(tes) {
    names = $(tes).attr('name');
    ters = $("textarea[name="+ names +"]").val();
    val = {};
    val[names] = ters;
    console.log(val);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Management/Job_m_c/validate_keyup/'); ?>",
        data: val,
        dataType: "json",
        success: function(data) {
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

