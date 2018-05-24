<?php

    require_once(__DIR__.'/../models/closmaire.class.php');
    $Closmaire = new Closmaire();

    session_start();
    if(!empty($_SESSION['fonction'])){
        if(!empty($_GET['inf'])){
            $page = htmlspecialchars($_GET['inf']);
            if($page == 'article'){
                require_once('article.php');
            }
            elseif($page == 'slider'){
                require_once('slider.php');
            }
            elseif($page == 'user'){
                require_once('user.php');
            }
            elseif($page == 'contenu'){
                require_once('page.php');
            }
            elseif($page == 'files'){
                require_once('files.php');
            }
            else{
                require_once('article.php');
            }
        }
        elseif(!empty($_POST['action'])){
            $action = htmlspecialchars($_POST['action']);
            if($action == 1){
                $id = htmlspecialchars($_POST['valeur']);
			    $retour = $Closmaire->get_article(1, $id);
                echo json_encode($retour);
            }
            elseif($action == 2){//Ajout publication
                $retour = $Closmaire->set_article(); 
            }
            elseif($action == 3){//Ajout d'utilisateurs
                $retour = $Closmaire->set_user($_POST['nom'], $_POST['password'], $_POST['fonction'], $_POST['droits']);
            }
            elseif($action == 4){//Modification utilisateur
                $retour = $Closmaire->update_user($_POST['id'], $_POST['nom'], $_POST['password'], $_POST['fonction'], $_POST['droits']);
            }
            elseif($action == 5){//Modif publication
                $retour = $Closmaire->update_article(); 
            }
            elseif($action == 6){//Modif Slider
                $retour = $Closmaire->update_slider();
            }
            elseif($action == 7){//get contenu page
                $retour = $Closmaire->get_page($_POST['id']);
                echo json_encode($retour);
            }
            elseif($action == 8){//set contenu page
                $retour = $Closmaire->set_page($_POST['id'], $_POST['editor']);
                exit;
            }
            elseif($action == 9 && !empty($_FILES['image']['tmp_name']) && !empty($_POST['nom']) ){//set fichiers
                $retour = $Closmaire->set_file($_FILES['image'], htmlspecialchars($_POST['nom']));
                header('Location: files');
                exit();
            }
            else {
                
            }
        }
        else{

        }
    }
    else{
        if(!empty($_POST['action'])){
            $action = htmlspecialchars($_POST['action']);
            if($action == 1){//Connexion
                $nom = htmlspecialchars($_POST['nom']);
                $password = htmlspecialchars($_POST['pass']);
                echo $Closmaire->get_user(1, $nom, $password, false);
            }
            else{
            }
        }
        else{
            session_destroy();
            require_once('enter.php');
            exit();
        }
    }
?>