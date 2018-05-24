<?php require_once('header.php'); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

        <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Slide 1</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Slide 2</a></li>
                  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">Slide 3</a></li>
                  <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true">Slide 4</a></li>
                </ul>
                <div class="tab-content">
                  <?php
                    $slides = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/slider.json');
                    $slides = json_decode($slides);
                    foreach($slides as $slide){
                      $slide = (array) $slide;
                      echo '
                      <div class="tab-pane" id="tab_'.$slide['id'].'">
                        <form id="slide'.$slide['id'].'" method="post" action="controller.php" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="'.$slide['id'].'" />
                          <input type="hidden" name="action" value="6" />
                          <p>';
                          if($slide['type'] == 1){
                            echo '<input type="radio" name="type" value="1" checked />
                            <label>Utiliser un article existant:</label><br />
                            Utiliser l\'article n°<input type="number" name="id_article" value="'.$slide['num'].'" min="1" step="1"/>';
                          }
                          else{
                            echo '<input type="radio" name="type" value="1"/>
                            <label>Utiliser un article existant:</label><br />
                            Utiliser l\'article n°<input type="number" name="id_article" value="1" min="1" step="1"/>';
                          }
                          echo'                            
                          </p><br />
                          <p>';
                          if($slide['type'] == 2){
                            echo '<input type="radio" name="type" value="2" checked />
                            <label>Créer une slide:</label><br />
                            <input type="text" name="titre" placeholder="Titre" class="concerne" value="'.$slide['titre'].'"/><br />
                            <input type="url" name="url" placeholder="Destination du lien" class="concerne" value="'.$slide['url'].'"/><br />
                            <div class="fileUpload">
                              <div style="background-image: url(\'../img/import/'.$slide['img'].'\');" ></div>
                              <input class="champ" type="file" name="image" accept="image/*">
                            </div>';
                          }
                          else{
                            echo '<input type="radio" name="type" value="2"/>
                            <label>Créer une slide:</label><br />
                            <input type="text" name="titre" placeholder="Titre" class="concerne" /><br />
                            <input type="url" name="url" placeholder="Destination du lien" class="concerne" /><br />
                            <div class="fileUpload">
                              <div ></div>
                              <input class="champ" type="file" name="image" accept="image/*">
                            </div>';
                          }
                          echo'
                          </p>
                          <input type="submit" value="Valider" />
                        </form>
                      </div>';
                    }
                  ?>
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

            
          </div>


        </section><!-- /.content -->
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
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {

        $(".tab-pane:eq(0)").addClass("active");
          
        $('#slide1 .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#slide1 .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $('#slide2 .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#slide2 .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        /*$('#slide3 .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#slide3 .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $('#slide4 .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#slide4 .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $('#slide5 .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#slide5 .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });*/

      });
    </script>
  </body>
</html>
