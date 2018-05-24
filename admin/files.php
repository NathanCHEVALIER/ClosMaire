<?php require_once('header.php'); ?>
            


<!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Gestion des Fichiers</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Visuel</th>
                        <th>Nom</th>
                        <th>URL</th>
                        <th>Type</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $fichiers1 = [];
                        $fichiers = scandir(__DIR__."/../img/import");
                        $t = 0;
                
                        foreach($fichiers as $fichier){
                          if($fichier != "." && $fichier != ".."){
                            $fichiers1[$t] = array("nom" => $fichier, "visuel" => "<div style=\"background-image: url('/img/import/".$fichier."'); margin: 5px; width: 270px; height: 150px; background-size: cover;\" ></div>", "url" => "/img/import/".$fichier, "type" => "Image");
                            $t = $t + 1;
                          }
                        }
                        
                        $fichiers = scandir(__DIR__."/../pdf/import");
                
                        foreach($fichiers as $fichier){
                          if($fichier != "." && $fichier != ".."){
                            $fichiers1[$t] = array("nom" => $fichier, "visuel" => "Pas de visuel PDF", "url" => "/pdf/import/".$fichier, "type" => "Pdf");
                            $t = $t + 1;
                          }
                        }

                        asort($fichiers1);
                        
                        foreach($fichiers1 as $file){
                          echo "
                            <tr>
                              <th >".$file['visuel']."</th>
                              <th >".$file['nom']."</th>
                              <th >".$file['url']."</th>
                              <th >".$file['type']."</th>
                            </tr>";
                        }
                        
                    ?>
                      </tbody>
                  </table>
                  <br /><br />
                  
                   <a class='btn btn-app' id="btn-ajouter">
                    <i class='fa fa-plus'></i>Ajouter
                  </a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

        <section class="content" id="ajouter">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-warning'>
                <div class='box-header'>
                  <h3 class='box-title'>Ajouter un fichier</h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  <form method="post" action="controller.php" enctype="multipart/form-data">
                    <label>Nom du fichier (caratères alphanumériques et traits d'union exclusivement)</label><br />
                    <input type="text" name="nom" /><br />
                    <label>Fichier (.png, .jpg, .jpeg, .gif, .pdf)</label>
                    <div class="fileUpload">
                        <div ></div>
                        <input class="champ" type="file" name="image" accept="image/*">
                    </div>
                    <input type="hidden" name="action" value="9" />
                    <input type="submit" value="Enregistrer"/>
                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section>
    
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Admin Clos - by <a href="http://nathanchevalier.esy.es">Nathan CHEVALIER</a></strong>
    </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- page script -->
  <script type="text/javascript">
  $(function () {
      
        $("#ajouter").hide();

        $('#ajouter .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#ajouter .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $("#btn-ajouter").click(function(){
            $("#ajouter").show();
        });

      });
    </script>
  </body>
</html>
