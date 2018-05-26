 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        

                        <div class="panel-body">
                         <button type="button" class="btn btn-success btn-circle btn-sm" onclick="add_book()"><span  class="glyphicon glyphicon-plus "></span></button>
                                <p></p>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Kode Novel</th>
                                        <th>Penulis</th>
                                        <th>Judul Novel</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($tb_novel as $key) {?>
                                    
                                    <tr class="odd gradeX">
                                        <td><?php echo $key->kode_novel;?></td>
                                        <td><?php echo $key->penulis;?></td>
                                        <td><?php echo $key->judul;?></td>
                                        <td class="center"><?php echo $key->tanggal;?></td>
                                        <td c>
                                             <button type="button" class="btn btn-warning btn-circle btn-sm" onclick="edit(<?php echo $key->id;?>)"><span  class="glyphicon glyphicon-edit "></span></button>
                                            <button type="button" class="btn btn-danger btn-circle btn-sm" onclick="delete_novel(<?php echo $key->id;?>)"><span class="glyphicon glyphicon-remove "></span></button>
                                        </td>
                                    </tr>
                                   <?php }?>
                                </tbody>
                            </table>
                           
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable();
        });
        
        var save_method;
        var table;

        function add_book(){
            save_method = 'add';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
           

        }
        function save() {
            var url;

            if (save_method == 'add') {
                url = '<?php echo site_url('index.php/Tambah_novel/novel_tambah');?>';
            }else {
                url = '<?php echo site_url('index.php/Tambah_novel/novel_update');?>';
            }
            
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data){
                    $('#modal_form').modal('hide');
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / Update data');
                }
            });
        }
        function edit(id) {
            save_method = 'Update';
            $('#form')[0].reset();

            $.ajax({
              url: "<?php echo site_url('index.php/Tambah_novel/ajax_edit'); ?>/" +id,
              type: "GET",
              dataType: "JSON",
               success: function(data){

                $('[name="id"]').val(data.id);
                $('[name="kode_novel"]').val(data.kode_novel);
                $('[name="penulis"]').val(data.penulis);
                $('[name="judul"]').val(data.judul);
                $('[name="tanggal"]').val(data.tanggal);

                 $('#modal_form').modal('show');
                 $('#modal_title').text('Edit Data');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Get data from ajax');
                }

            }); 
        }
        function delete_novel(id){
        if(confirm("Are You sure Delete This data ?")) {

            $.ajax({
              url: "<?php echo site_url('index.php/Tambah_novel/novel_delete'); ?>/" +id,
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                location.reload();

              },
              error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Delete data');
                  }
            });
          }
      }
        
    </script>

        <div class="modal fade " id="modal_form"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h1  align="center" id="modal_title" >Tambah Data</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">
      <form action="#" id="form" class="form-horizontal">
      <input type="hidden" value="" name="id">

      <div class="form-body">
          <div class="form-group">
              <label class="control-label col-md-3">Kode Novel</label>
              <div class="col-md-9">
                  <input type="text" name="kode_novel" placeholder="Input Kode Novel" class="form-control">
              </div>
            </div>
        </div>
    <div class="form-body">
        <div class="form-group">
              <label class="control-label col-md-3">Penulis Novel</label>
              <div class="col-md-9">
                  <input type="text" name="penulis" placeholder="Input Penulis Novel" class="form-control">
              </div>
            </div>
        </div>
         <div class="form-body">
          <div class="form-group">
              <label class="control-label col-md-3">Judul</label>
              <div class="col-md-9">
                  <input type="text" name="judul" placeholder="Input Judul Novel" class="form-control">
              </div>
            </div>
        </div>
        <div class="form-body">
          <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                  <input type="text" name="tanggal" placeholder="Input Tanggal Novel" class="form-control">
              </div>
            </div>
        </div>
      </form>
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>
