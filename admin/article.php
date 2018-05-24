<?php require_once('header.php'); ?>
            


<!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Tout les articles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Sous-titre</th>
                        <th>Catégorie</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Etat</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once(__DIR__.'/../models/closmaire.class.php');
                        $Closmaire = new Closmaire();
                        $articles = $Closmaire->get_article(2, false);
                        foreach($articles as $article){
                            $article = (array) $article;
                            if($article['etat'] == true){
                              $etat = "Publié";
                            }
                            else{
                              $etat = "Non publié";
                            }
                            $auteur = $Closmaire->get_user(3, false, false, $article['auteur']);
                            echo "
                            <tr data='".$article['id']."'>
                              <th >".$article['id']."</th>
                              <th >".$article['titre']."</th>
                              <th >".$article['soustitre']."</th>
                              <th >".$article['categorie']."</th>
                              <th >".$auteur['nom']."</th>
                              <th >".$Closmaire->get_date($article['date'])."</th>
                              <th >".$etat."</th>
                              <th>
                                <a class='btn btn-app modif-article' data='".$article['id']."'>
                                  <i class='fa fa-edit'></i>Modifier
                                </a>
                                <!--<a class='btn btn-app view-article' data='".$article['id']."'>
                                  <i class='fa fa-eye'></i>Voir
                                </a>-->
                              </th>
                            </tr>";
                        }
                    ?>
                      </tbody>
                  </table>
                   <a class='btn btn-app' id="btn_editeur">
                    <i class='fa fa-plus'></i>Ajouter
                  </a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        <section class="content" id="editeur">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-warning'>
                <div class='box-header'>
                  <h3 class='box-title'>Editeur d'articles</h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  <form method="post" action="controller.php" enctype="multipart/form-data">
                    <label>Titre </label>
                    <input name="titre" class="form-control" placeholder="Renseignez un titre" type="text"><br />
                    <label>Sous-Titre</label>
                    <input name="soustitre" class="form-control" placeholder="Renseignez un sous-titre" type="text"><br />
                    <label>Catégorie</label>
                    <select name="categorie" class="form-control">
                      <option value="sciences-et-techniques" >Sciences & Techniques</option>
                      <option value="arts-cultures-et-langues" >Arts, cultures & langues</option>
                      <option value="sciences-humaines" >Sciences Humaines</option>
                      <option value="etablissement" >Etablissement</option>
                      <option value="vie-scolaire" >Vie Scolaire</option>
                      <option value="sante-et-citoyennete" >Santé et Citoyenneté</option>
                      <option value="intendance" >Intendance</option>
                      <option value="orientation" >Orientation</option>
                    </select><br />
                    <label>Image</label>
                    <div class="fileUpload">
                        <div ></div>
                        <input class="champ" type="file" name="image" accept="image/*">
                    </div>
                    <label>Contenu</label>
                    <input type="hidden" name="action" value="2" />
                    <textarea id="editor1" name="editor" rows="30" cols="80">
                          
                    </textarea><br />
                    <label>Publication</label>
                    <p><input type="checkbox" name="etat"/> Cochez cette case pour sauvegarder et publier l'article</p><br />
                    <input type="submit" value="Enregistrer"/>
                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section>


        <section class="content" id="modifier">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-warning'>
                <div class='box-header'>
                  <h3 class='box-title'>Modifier un article</h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  <form method="post" action="controller.php" enctype="multipart/form-data">
                    <label>Titre </label>
                    <input name="titre" class="form-control" placeholder="Renseignez un titre" type="text"><br />
                    <label>Sous-Titre</label>
                    <input name="soustitre" class="form-control" placeholder="Renseignez un sous-titre" type="text"><br />
                    <label>Catégorie</label>
                    <select name="categorie" class="form-control">
                      <option value="sciences-et-techniques" >Sciences & Techniques</option>
                      <option value="arts-cultures-et-langues" >Arts, cultures & langues</option>
                      <option value="sciences-humaines" >Sciences Humaines</option>
                      <option value="etablissement" >Etablissement</option>
                      <option value="vie-scolaire" >Vie Scolaire</option>
                      <option value="sante-et-citoyennete" >Santé et Citoyenneté</option>
                      <option value="intendance" >Intendance</option>
                      <option value="orientation" >Orientation</option>
                    </select><br />
                    <label>Image</label>
                    <div class="fileUpload">
                        <div ></div>
                        <input class="champ" type="file" name="image" accept="image/*">
                    </div>
                    <label>Contenu</label>
                    <input type="hidden" name="action" value="5" />
                    <input type="hidden" name="id" value="" />
                    <textarea id="editor2" name="editor2" class="modif-article-unique" rows="30" cols="80">
                    
                    </textarea><br />
                    <label>Publication</label>
                    <p><input type="checkbox" name="etat"/> Cochez cette case pour sauvegarder et publier l'article</p><br />
                    <input type="submit" value="Enregistrer"/>
                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section>



        <section class="content" id="viewer">
          <div class='row'>
            <div class='col-md-12'>
              <div class='box box-warning'>
                <div class='box-header'>
                  <h3 class='box-title'>Voir un article</h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                  

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
            { name: 'document',   items: [ 'NewPage', '-', 'ShowBlocks', 'Preview', '-', 'Templates' ] },
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

        CKEDITOR.replace( 'editor2', {
            language: 'fr',
            uiColor: '#ffffff',
            toolbar : [
            { name: 'document',   items: [ 'NewPage', '-', 'ShowBlocks', 'Preview', '-', 'Templates' ] },
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
      
        $("#editeur").hide();
        $("#viewer").hide();
        $("#modifier").hide();

        $("#btn_editeur").click( function(){
          $("#editeur").toggle();
          $("#viewer").hide();
          $("#modifier").hide();
        });

        $(".view-article").click(function(){
          var id_article = $(this).parents("tr").attr("data");
          load_article(id_article, 1);
          $("#viewer").show();
          $("#editeur").hide();
          $("#modifier").hide();
        });

        function load_article(id, type){
          $.post("controller.php", {
              action: 1,
              valeur: id,
            },
            function(data_article){
              if(type == 1){
                view_article(data_article)
              }
              else if(type == 2){
                modif_article(data_article);
              }
            },
            "json"
          );
        }

        function view_article(data_article){
          var $contenu = $("<article>\
            <div></div>\
            <div class='miniature' style='background-image: url(\"img/import/" + data_article['image'] + "\");' ></div>\
            <div class='contenu' >\
               <h3>" + data_article['titre'] + "</h3>\
              <h4>" + data_article['soustitre'] + "</h4>\
              <span>" + data_article['date'] + "</span>\
              <div class='contenu-article' ></div>\
            </div>\
          </article>");
          $("#viewer .box-body").html($contenu);
          $("#viewer .box-body .contenu-article").html(data_article['contenu']);
        }

        function modif_article(data){
          $("#modifier input[name='titre']").val(data['titre']);
          $("#modifier input[name='soustitre']").val(data['soustitre']);
          $("#modifier select option[value='" + data['categorie'] + "']").prop("selected", true);
          if(data['etat'] == true){
            $("#modifier input[type='checkbox']").prop("checked", true);
          }
          CKEDITOR.instances.editor2.setData(data['contenu']);
          $("#modifier .fileUpload > div").css('background-image', 'url("../img/import/' + data['img'] + '")');
          $("#modifier input[name='id']").val(data['id']);
        }

        $('#modifier .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#modifier .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $('#editeur .fileUpload input[type="file"]').change( function (e) {
            var files = $(this)[0].files;
            if (files.length > 0) {
                var file = files[0];
                $("#editeur .fileUpload > div").css('background-image', 'url("' + window.URL.createObjectURL(file) + '")');
            }
        });

        $(".modif-article").click(function(){
          var id_article = $(this).parents("tr").attr("data");
          load_article(id_article, 2);
          $("#modifier").show();
          $("#viewer").hide();
          $("#editeur").hide();
        });

        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>
