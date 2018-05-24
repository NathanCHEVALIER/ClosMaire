<?php

    require_once(__DIR__.'/models/closmaire.class.php');
    $Closmaire = new Closmaire();

    if(!empty($_GET['page'])){
        $page = htmlspecialchars($_GET['page']);
        require_once("views/entete.php");
        if($page == "accueil"){
            $contenu_page = include_once("views/accueil.php");
        }
        elseif($page == "formations"){
            $contenu_page = include_once("views/formations.php");
        }
        elseif($page == "etablissement"){
            $contenu_page = include_once("views/etablissement.php");
        }
		elseif($page == "articles"){
			$contenu_page = include_once("views/articles.php");
        }
        elseif($page == "mentions"){
			$contenu_page = include_once("views/mentions.php");
        }
        else{

        }
        require_once("views/footer.php");
    }
	elseif(!empty($_POST['action'])){
		$action = htmlspecialchars($_POST['action']);
		if($action == 1){
			$id = htmlspecialchars($_POST['valeur']);
			$value = $Closmaire->get_article(1, $id);
            echo json_encode($value);
		}
        elseif($action == 2){
			$categorie = htmlspecialchars($_POST['valeur']);
			$values = $Closmaire->get_article(2, false);
            $accepted = array();
            foreach($values as $value){
                if($value['categorie'] == $categorie && $value['etat'] == true){
                    $value['date'] = $Closmaire->get_date($value['date']);
                    $accepted[] = $value;
                }
            }
            echo json_encode($accepted);
		}
        elseif($action == 3){
			$values = $Closmaire->get_article(2, false);
            $accepted = array();
            foreach($values as $value){
                $value['date'] = $Closmaire->get_date($value['date']);
                $accepted[] = $value;
            }
            echo json_encode($accepted);
		}
        elseif($action == 4){
            $boundary = "-----=".md5(rand());
			$emailofthebest = "0210006t@ac-dijon.fr";
            $header = "From: \"Lycée Clos Maire\"<site@lycee-closmaire.net>"."\n";
	        $header.= "Reply-to: <".$_POST['email']."\n";
	        $header.= "MIME-Version: 1.0"."\n";
	        $header .= "X-Priority: 3"."\n";
	        $header.= "Content-Type: multipart/alternative;"."\n"." boundary=\"$boundary\""."\n";
            $sujetdeouf = $_POST['sujet'];
            $messagebanal = $_POST['texte'];

            mail($emailofthebest, $sujetdeouf, $messagebanal, $header);
            echo json_encode("message send");
        }
        elseif($action == 5 && !empty($_POST['id'])){//formations
            $retour = $Closmaire->get_page(htmlspecialchars($_POST['id']));
            echo json_encode($retour);
		}
        else{

        }
	}
    else{

    }

?>