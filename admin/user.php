<?php 

session_start();
  require_once('header.php'); 
?>
<!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Main content -->
        <?php
          if($_SESSION['droit'] == 2){
          ?>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Utilisateurs</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Fonction</th>
                        <th>Droits</th>
                        <th>Modifier</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once(__DIR__.'/../models/closmaire.class.php');
                        $Closmaire = new Closmaire();
                        $users = $Closmaire->get_user(2, false, false, false);
                        foreach($users as $user){
                            $user = (array) $user;

                            if($user['droit'] == 2){
                              $droit_user = "Administrateur";
                            }
                            elseif($user['droit'] == 1){
                              $droit_user = "Modérateur";
                            }
                            else{
                              $droit_user = "Aucun";
                            }
                            echo "
                            <tr data='".$user['id']."'>
                              <th data='".$user['nom']."' >".$user['nom']."</th>
                              <th data='".$user['fonction']."' >".$user['fonction']."</th>
                              <th data='".$user['nom']."' >".$droit_user."</th>
                              <th>
                                <a class='btn btn-app modif-user' data='".$user['id']."'>
                                  <i class='fa fa-edit'></i>Modifier
                                </a>
                              </th>
                            </tr>";
                        }
                    ?>
                    </tbody>
                  </table>
                  <a class='btn btn-app' id="btn_add_user">
                    <i class='fa fa-plus'></i>Ajouter
                  </a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </section><!-- /.content -->
        <section class="content" id="add_user" >
                <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Ajout d'un Utilisateur</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="controller.php" method="post">
                    <input type="hidden" name="action" value="3" />
                    <div class="form-group">
                      <label>Nom</label>
                      <input name="nom" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Fonction</label>
                      <input name="fonction" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Mot de passe</label>
                      <input name="password" type="password" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Droits</label>
                      <select class="form-control" name="droits">
                        <option value="3" >Bloqué</option>
                        <option selected value="1" >Modérateur</option>
                        <option value="2" >Administrateur</option>
                      </select>
                    </div>
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>

                  </form>
                </div><!-- /.box-body -->
              </div>
        </section>
        <?php
      }
      ?>

        <section class="content" id="update-user" >
                <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Modification d'un Utilisateur</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="controller.php" method="post">
                    <input type="hidden" name="action" value="4" />
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
                    <div class="form-group">
                      <label>Nom</label>
                      <input name="nom" type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['nom'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Fonction</label>
                      <input name="fonction" type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['fonction'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Mot de passe</label>
                      <input name="password" type="password" class="form-control" placeholder="">
                    </div>
                    <?php
                      if($_SESSION['droit'] == 2){
                    ?>
                    <div class="form-group">
                      <label>Droits</label>
                      <select class="form-control" name="droits">
                        <option value="3" >Bloqué</option>
                        <option value="1" >Modérateur</option>
                        <option value="2" >Administrateur</option>
                      </select>
                    </div>
                  <?php
                      }
                      ?>
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>

                  </form>
                </div><!-- /.box-body -->
              </div>
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
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

        $("#add_user").hide();
        $("#update-user").hide();

        $("#btn_add_user").click( function(){
           $("#add_user").toggle();
          $("#update-user").hide();
        });

        $(".modif-user").click(function(){
          $("#add_user").hide();
          var id = $(this).attr("data");
          $("tr[data='" + id + "']").css("background-color", "#eee");
          $(this).css("background-color", "#739ad7").removeClass("modif-user").addClass("valid-modif-user");
          var nom = $("tr[data='" + id + "'] > th:eq(0)").attr("data");
          $("#update-user input[name='nom']").val(nom);
          var nom = $("tr[data='" + id + "'] > th:eq(1)").attr("data");
          $("#update-user input[name='fonction']").val(nom);
          var nom = $("tr[data='" + id + "']").attr("data");
          $("#update-user input[name='id']").val(nom);
          $("#update-user").show();
        });

        <?php
          if($_SESSION['droit'] != 2){
        ?>
          $("#update-user").show();
        <?php
          }
        ?>

        /*$(".valid-modif-user").click(function(){
          $(this).css("background-color", "initial").removeClass("valid-modif-user").addClass("modif-user");
          var id = $(this).attr("data");
          $("tr[data='" + id + "']").css("background-color", "initial");
          $("#update-user").hide();
        })*/

      });
    </script>

  </body>
</html>
