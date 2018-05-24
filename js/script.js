$(function () {
	
	/******Animation caroussel*****/
	
	var slide_actuel = 1;

	function slide(slide_cible){
		if(slide_cible == 1){
			$("#slider > div:eq(0)").css("margin-left", "0vw");
			$("#slider > div:eq(1) > div:eq(2) > div").removeClass("actuel");
			$("#slider > div:eq(1) > div:eq(2) > div:eq(0)").addClass("actuel");
			slide_actuel = 1;
		}
		if(slide_cible == 2){
			$("#slider > div:eq(0)").css("margin-left", "-100vw");
			$("#slider > div:eq(1) > div:eq(2) > div").removeClass("actuel");
			$("#slider > div:eq(1) > div:eq(2) > div:eq(1)").addClass("actuel");
			slide_actuel = 2;
		}
		if(slide_cible == 3){
			$("#slider > div:eq(0)").css("margin-left", "-200vw");
			$("#slider > div:eq(1) > div:eq(2) > div").removeClass("actuel");
			$("#slider > div:eq(1) > div:eq(2) > div:eq(2)").addClass("actuel");
			slide_actuel = 3;
		}
		if(slide_cible == 4){
			$("#slider > div:eq(0)").css("margin-left", "-300vw");
			$("#slider > div:eq(1) > div:eq(2) > div").removeClass("actuel");
			$("#slider > div:eq(1) > div:eq(2) > div:eq(3)").addClass("actuel");
			slide_actuel = 4;
		}
	}
	
	function cibler_slide(actuelle, signe){
		var cible = 0;
		if(signe == 1){//negatif
			if(actuelle <= 1){
				cible = 4;
			}
			else{
				cible = actuelle - 1;
			}
		}
		else if(signe == 2){//positif
			if(actuelle >= 4){
				cible = 1;
			}
			else{
				cible = actuelle + 1;
			}
		}
		return cible;
	}
	
	function slider(){
		setTimeout( function(){
			var juyt = cibler_slide(slide_actuel, 2)
			slide(juyt);
			slide_actuel = juyt;
			slider();
		}, 5000);
	}
	
	slider();
	
	$("#slider > div:eq(1) > div:eq(0)").click( function(){
		var juyt = cibler_slide(slide_actuel, 1)
			slide(juyt);
			slide_actuel = juyt;
	});
	
	$("#slider > div:eq(1) > div:eq(1)").click( function(){
		var juyt = cibler_slide(slide_actuel, 2)
			slide(juyt);
			slide_actuel = juyt;
	});
	
	$("#slider > div:eq(1) > div:eq(2) > div:eq(0)").click( function(){
		slide(1);
		slide_actuel = 1;
	});
	
	$("#slider > div:eq(1) > div:eq(2) > div:eq(1)").click( function(){
		slide(2);
		slide_actuel = 2;
	});
	
	$("#slider > div:eq(1) > div:eq(2) > div:eq(2)").click( function(){
		slide(3);
		slide_actuel = 3;
	});
	
	$("#slider > div:eq(1) > div:eq(2) > div:eq(3)").click( function(){
		slide(4);
		slide_actuel = 4;
	});
	
	/******Article******/

	$("#timeline > article h3").click(function(){
		$("#viewer").fadeIn(500);
		var id_article = $(this).parents("article").attr("data");
		load_article(id_article);
		$("body").css("overflow-y", "hidden");
	});

	$("#viewer > div:eq(1)").click(function(){
		$("#viewer").fadeOut(500);
		$("#viewer article").html("").addClass("loader");
		$("body").css("overflow-y", "auto");
	});
	
	function load_article(id){
		$.post("/controller.php", {
				action: 1,
				valeur: id,
			},
			function (data_article){
				var $contenu = $("<div></div>\
					<div class='miniature' style='background-image: url(\"/img/import/" + data_article['img'] + "\");' ></div>\
					<div class='contenu' >\
						<h3>" + data_article['titre'] + "</h3>\
						<span>" + data_article['date'] + "</span>\
						<div class='contenu-article' ></div>\
					</div>\
					<a href='articles/" + data_article['categorie'] + "' >Autres articles de la catégorie</a>\
					");
				$("#viewer article").html($contenu);
				$("#viewer article .contenu-article").html(data_article['contenu']);
			},
			"json"
		);
		$("#viewer article").html("").removeClass("loader");
	}

	function load_article2(categorie){
		$.post("/controller.php", {
				action: 2,
				valeur: categorie,
			},
            function(data_article){
                $("#timeline").html("").addClass("loader");
                for (var i = 0; i < data_article.length; i++) {
                    var $contenu = $("<article data='" + data_article[i]['id'] + "' >\
                    <div></div>\
                    <div>\
                      <div class='miniature' style='background-image: url(\"/img/import/" + data_article[i]['img'] + "\");' ></div>\
                      <div class='contenu' >\
                        <h3>" + data_article[i]['titre'] + "</h3>\
                        <span>" + data_article[i]['date'] + "</span>\
                        <p>" + data_article[i]['soustitre'] + "</p>\
                      </div>\
                    </div>\
                  </article>");
                    $("#timeline").prepend($contenu);
                    $contenu.find('h3').click(function(){
                        $("#viewer").fadeIn(500);
                        var id_article = $(this).parents("article").attr("data");
                        load_article(id_article);
                        $("body").css("overflow-y", "hidden");
                    });
                }
                $("#timeline").removeClass("loader").append("<a href='' class='bouton' >Plus d'articles</a>");
			},
			"json"
		);
	}

    function load_article3(){
		$.post("/controller.php", {
				action: 3,
			},
            function(data_article){
                $("#timeline").html("").addClass("loader");
                for (var i = 0; i < data_article.length; i++) {
                    var $contenu = $("<article data='" + data_article[i]['id'] + "' >\
                    <div></div>\
                    <div>\
                      <div class='miniature' style='background-image: url(\"/img/import/" + data_article[i]['img'] + "\");' ></div>\
                      <div class='contenu' >\
                        <h3>" + data_article[i]['titre'] + "</h3>\
                        <span>" + data_article[i]['date'] + "</span>\
                        <p>" + data_article[i]['soustitre'] + "</p>\
                      </div>\
                    </div>\
                  </article>");
                    $("#timeline").prepend($contenu);
                    $contenu.find('h3').click(function(){
                        $("#viewer").fadeIn(500);
                        var id_article = $(this).parents("article").attr("data");
                        load_article(id_article);
                        $("body").css("overflow-y", "hidden");
                    });
                }
                $("#timeline").removeClass("loader").append("<a href='' class='bouton' >Plus d'articles (0)</a>");
			},
			"json"
		);
	}

    $("#viewer > div:eq(1)").click(function(){
		$("#viewer").fadeOut(500);
		$("#viewer article").html("").addClass("loader");
		$("body").css("overflow-y", "auto");
	});

    var location = window.location.toString().split("/");
    if(location[3] == "articles"){
	    var page = location[location.length - 1]
	    if(page == "sciences-et-techniques" || page == "arts-cultures-et-langues" || page == "sciences-humaines" || page == "vie-scolaire" || page == "sante-et-citoyennete" || page == "intendance" || page == "etablissement" || page == "orientation"){
	        load_article2(page);
	        $("#article_selector > select > option[value=\"" + page + "\"]").attr("selected", "selected");
	    }
	    else{
	        var id = page.split("-");
	        var id = parseInt(id['0']);
	        if( Number.isInteger(id) ){
	            load_article3();
	            $("#viewer").fadeIn(500);
	            load_article(id);
	            $("body").css("overflow-y", "hidden");
	            $("#article_selector > div > div").removeClass("selected");
	            $("#article_selector > div > div:eq(0)").addClass("selected");
	        }
	        else{
	            load_article3();
	            $("#article_selector > div > div").removeClass("selected");
	            $("#article_selector > div > div:eq(0)").addClass("selected");
	        }
	    }
	}

    $("#article_selector > select").change( function (){
    	var categorie = $(this).children(":selected").attr("value");
    	if(categorie == "sciences-et-techniques" || categorie == "arts-cultures-et-langues" || categorie == "sciences-humaines" || categorie == "vie-scolaire" || categorie == "sante-et-citoyennete" || categorie == "intendance" || categorie == "etablissement" || categorie == "orientation"){
    		history.pushState({ path: this.path }, '', '/articles/' + categorie);
        	load_article2(categorie);
    	}
    	else{
        	history.pushState({ path: this.path }, '', '/articles/');
        	load_article3();    		
    	}
    });

	$("#form-contact > input[type='submit']").click(function(){
		var $form = $("#form-contact");
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
            
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, 
            processData: false, 
            dataType: 'json', 
            data: data,
            success: function (reponse) {
                $("#form-contact").append("<label class='true' style='width: 45%; margin: 30px 25% 0px 25%;' >Message envoyé</label>");
            }
		});
		return false;
	});

	/******
	 * Formations
	 */
	$("#formations > div > div:eq(1) > select").hide();
    var categorie = $("#formations select[name='categorie'] > option:selected").attr('value');
    $("#formations > div > div:eq(1) > select[name='" + categorie + "']").show();

    $("#formations select[name='categorie']").on("change", function(){
        var categorie = $("#formations select[name='categorie'] > option:selected").attr('value');
        $("#formations > div > div:eq(1) > select").hide();
        $("#formations > div > div:eq(1) > select[name='" + categorie + "']").show();
    });

    $("#formations > div select").on("change", function(){
       	load_formation();
	});
	
	load_formation();

	function load_formation(){
		var categorie = $("#formations > div > div:eq(0) > select > option:selected").attr('value');
		var filiere = $("#formations > div > div:eq(1) > select[name='" + categorie + "'] > option:selected").attr('value');
		$.post("/controller.php", {
			action: 5,
			id: filiere,
		}, function(data){
			$("#formations #contenu").html(data);
		}, "json");
	}

    if($(window).width() < 860){
		$("header > div > nav > ul > li.ouvert").click( function(){
			alert();
			$(this).removeClass("ouvert");
			$(this).addClass("ferme");
			$("header > div > nav > ul > li > ul").slideUp(350);
		});

		$("header > div > nav > ul > li").click( function(){
			if($(this).hasClass('ouvert')){
				$(this).removeClass("ouvert");
				$(this).addClass("ferme");
				$("header > div > nav > ul > li > ul").slideUp(350);
			}
			else if($(this).hasClass('ferme')){
				$("header > div > nav > ul > li").removeClass('ouvert').addClass('ferme');
				$("header > div > nav > ul > li > ul").slideUp(350);
				$(this).addClass("ouvert");
				$(this).removeClass("ferme");
				$(this).children("ul").slideDown(350);
			}
			else{

			}
		});

		$("header > div > div").click( function(){
			$("header nav").toggle();
		});
	
		$("header nav").hide();
	}
	
});