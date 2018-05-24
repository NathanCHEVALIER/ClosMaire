<?php require_once('header.php'); ?>
            
<!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Contenu des pages</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="text-align: center;">
                    Choisissez la page à modifier:
                    <select name="page" >
                        <option value="" selected >Aucune</option>           
                        <optgroup label="Formations">
                            <option value="1">S</option>
                            <option value="2">ES</option>
                            <option value="3">L</option>
                            <option value="4">STI2D</option>
                            <option value="5">MEI</option>
                            <option value="6">MELEC</option>
                            <option value="7">TU</option>
                            <option value="8">CAP PROE</option>
                            <option value="9">BTS Tourisme</option>
                            <option value="11">EPS & UNSS</option>
                        </optgroup>
                        <optgroup label="Autres">
                            <option value="10">Etablissement</option>
                        </optgroup>
                    </select>
                    <button id="modif-contenu">Modifier</button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

        <section class="content" id="modifier">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-warning'>
                <div class='box-header'>
                  <h3 class='box-title'>Modifier une page</h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  <form method="post" action="controller.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="8" />
                    <input type="hidden" name="id" value="" />
                    <textarea id="editor" name="editor" class="modif-article-unique" rows="100" cols="80">
                    
                    </textarea><br />
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
    <script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        CKEDITOR.replace( 'editor', {
            language: 'fr',
            toolbar : [
            { name: 'document',   items: [ 'NewPage', '-', 'ShowBlocks', 'Preview', '-', 'Templates', 'Source' ] },
            { name: 'clipboard',   items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'paragraph',   items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            { name: 'links',   items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'editing',   items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker',  'Scayt' ] },
            '/',
            { name: 'basicstyles',   items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'styles',   items: [ 'Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors',   items: [ 'Color', 'Background Color', 'Smiley', 'Image', 'SpecialChar'] },
            { name: 'insert',  items: ['Table','HorizontalRule' ] }
            ],
            contentsCss : '../css/style.css'
        });
      
        $("#modifier").hide();

        function load_contenu(id){
            $.post("controller.php", {
                action: 7,
                id: id,
            },
            function(data){
              CKEDITOR.instances.editor.setData(data);
            },
            "json"
            );
        }

        function modif_article(data){
          $("#modifier input[name='titre']").val(data['titre']);
          $("#modifier input[name='soustitre']").val(data['soustitre']);
          $("#modifier select option[value='" + data['categorie'] + "']").prop("selected", true);
          if(data['etat'] == true){
            $("#modifier input[type='checkbox']").prop("checked", true);
          }
          CKEDITOR.instances.editor2.setData(data['contenu']);
          $("#modifier .fileUpload > div").css('background-image', 'url("../img/articles/' + data['img'] + '")');
          $("#modifier input[name='id']").val(data['id']);
        }

        $('#modifier .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#modifier .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $("#modif-contenu").click(function(){
            var id_page = $("select[name='page']").val();
            $("#modifier input[name='id']").val(id_page);
            load_contenu(id_page);
            $("#modifier").show();
        });

      });
    </script>

  </body>
</html>
