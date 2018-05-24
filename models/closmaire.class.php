<?php

class Closmaire
{

    public function get_user($action, $nom, $pass, $id){
        $open_user = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/user.json');
        $users = json_decode($open_user);

        if($action == 1){
            foreach($users as $user){
                $user = (array) $user;
                if($nom == $user['nom'] && password_verify($pass, $user['pass']) && ($user['droit'] == 1 || $user['droit'] == 2) ){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['fonction'] = $user['fonction'];
                    $_SESSION['droit'] = $user['droit'];
                    header('Location: article');
                    exit();
                }
                else{
                    $retour = "Identifiant ou mot de passe incorrect";
                }
            }
        }
        elseif($action == 2){
            $retour = $users;
        }
        elseif($action == 3){
            foreach($users as $user){
                $user = (array) $user;
                if($id == $user['id']){
                    $retour = $user;
                }
            }
        }
        return $this->readuser = $retour;
    }

    public function set_user($nom, $pass, $fonction, $droit){
        $open_user = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/user.json');
        $users = json_decode($open_user);
        $users = (array) $users;
        $id = count($users) + 1;
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $user = array("id" => $id, "nom" => $nom, "pass" => $pass, "droit" => $droit, "fonction" => $fonction);
        $users[$id] = $user;
        $close_users = json_encode($users);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/user.json', $close_users);
        header('Location: user');
        exit();
        
        return $this->readuser = $users;
    }

    public function update_user($id, $nom, $pass, $fonction, $droit){
        $open_user = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/user.json');
        $users = json_decode($open_user);
        $users = (array) $users;

        foreach($users as $user){
            $user = (array) $user;
            if($id == $user['id']){
                $user['nom'] = $nom;
                $user['fonction'] = $fonction;
                $user['droit'] = $droit;
                if(!empty($pass)){
                    $user['pass'] = password_hash($pass, PASSWORD_DEFAULT);
                }
            }
            else{

            }
            $new_users[$user['id']] = $user;
        }
        
        $close_users = json_encode($new_users);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/user.json', $close_users);
        header('Location: user');
        exit();
        
        return $this->readuser = $users;
    }

    public function get_article($action, $id) {
        $open_article = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/article.json');
        $articles = json_decode($open_article);

        if($action == 1){
            foreach($articles as $article){
                $article = (array) $article;
                if($article['id'] == $id){
                    $article['contenu'] = htmlspecialchars_decode($article['contenu']);
					$article['date'] = $this->get_date($article['date']);
                    $auteur = $this->get_user(3, false, false, $article['auteur']);
                    $article['auteur'] = $auteur['nom'];
                    $retour = $article;
                }
                else{
                    
                }
            }
        }
        elseif($action == 2){
            $articles = (array) $articles;
            foreach($articles as $article){
                $article = (array) $article;
                $articles2[$article['id']] = $article;
            }
            usort($articles2, function ($a, $b){
                return date_create($a['date']) <=> date_create($b['date']);
            });
            $retour = array_reverse($articles2);
        }
        return $this->get_article = $retour;
    }

    public function set_article(){
        //$titre, $soustitre, $categorie, $contenu
        $open_article = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/article.json');
        $articles = json_decode($open_article);
        $articles = (array) $articles;
        $id = count($articles) + 1;

        $titre = htmlspecialchars($_POST['titre']);
        $soustitre = htmlspecialchars($_POST['soustitre']);

        $image = $this->set_file($_FILES['image'], "article");
        
        $categorie = htmlspecialchars($_POST['categorie']);
        $contenu = rtrim(htmlspecialchars($_POST['editor']));
        if(isset($_POST['etat'])){
            $etat = true;
        }
        else{
            $etat = false;
        }

        $article = array("id" => $id, "titre" => $titre, "soustitre" => $soustitre, "img" => $image, "categorie" => $categorie, "contenu" => $contenu, "auteur" => $_SESSION['id'], "date" => $date, "etat" => $etat);
        $articles[$id] = $article;
        $close_articles = json_encode($articles);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/article.json', $close_articles);
        header('Location: article');
        exit();
        
        return $this->set_article = $articles;
    }

    public function update_article(){
        $open_article = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/article.json');
        $articles = json_decode($open_article);
        $articles = (array) $articles;

        foreach($articles as $article){
            $article = (array) $article;
            if($_POST['id'] == $article['id']){
                $article['titre'] = htmlspecialchars($_POST['titre']);
                $article['soustitre'] = htmlspecialchars($_POST['soustitre']);
                $date = date('y').date('m').date('d').date('H').date('i');
                $article['date'] = $date;
                $article['categorie'] = htmlspecialchars($_POST['categorie']);
                $article['contenu'] = rtrim(htmlspecialchars($_POST['editor2']));
                if(!empty($_FILES['image']['tmp_name'])){
                    $image = $this->set_file($_FILES['image'], "article");
                    $article['img'] =  $image;
                }
                if(isset($_POST['etat'])){
                    $article['etat'] = true;
                }
            }
            $new_articles[$article['id']] = $article;
        }
        
        $close_articles = json_encode($new_articles);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/article.json', $close_articles);
        header('Location: article');
        exit();
       
        return $this->update_article = $articles;
    }

    public function get_date($date){
        $jour = substr($date, 4, 2);
        $mois = substr($date, 2, 2);
        $mois2 = "ter";
        if($mois == 1){
            $mois2 = "Janvier";
        }
        elseif($mois == 2){
            $mois2 = "Février";
        }
        elseif($mois == 3){
            $mois2 = "Mars";
        }
        elseif($mois == 4){
            $mois2 = "Avril";
        }
        elseif($mois == 5){
            $mois2 = "Mai";
        }
        elseif($mois == 6){
            $mois2 = "Juin";
        }
        elseif($mois == 7){
            $mois2 = "Juillet";
        }
        elseif($mois == 8){
            $mois2 = "Août";
        }
        elseif($mois == 9){
            $mois2 = "Septembre";
        }
        elseif($mois == 10){
            $mois2 = "Octobre";
        }
        elseif($mois == 11){
            $mois2 = "Novembre";
        }
        elseif($mois == 12){
            $mois2 = "Décembre";
        }
        else{

        }
                
        $annee = substr($date, 0, 2);
        $heure = substr($date, 6, 2) + 2;
        $minute = substr($date, 8, 2);

        $retour = $jour." ".$mois2." 20".$annee." à ".$heure."h".$minute;
        return $this->get_date = $retour;
    }

    public function update_slider() {
        $slides = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/slider.json');
        $slides = json_decode($slides);
        foreach($slides as $slide){
            $slide = (array) $slide;

            if($_POST['id'] == $slide['id']){
                if($_POST['type'] == 1){
                    $slide['type'] = 1;
                    $slide['num'] = $_POST['id_article'];
                }
                elseif($_POST['type'] == 2){
                    $slide['type'] = 2;
                    $slide['titre'] = htmlspecialchars($_POST['titre']);
                    $slide['url'] = htmlspecialchars($_POST['url']);
                    $date = date('y').date('m').date('d').date('H').date('i');
                    if(!empty($_FILES['image']['tmp_name'])){
                        $image = $this->set_file($_FILES['image'], "slider");
                        $slide['img'] = $image;
                    }
                    else{

                    }
                }
                else{

                }
            }
            $new_slider[$slide['id']] = $slide;
        }
        
        $close_slider = json_encode($new_slider);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/slider.json', $close_slider);
        header('Location: slider');
        exit();
    }

    public function get_page($id) {
        $open_pages = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/pages.json');
        $pages = (array) json_decode($open_pages);
        $count = 1;
        foreach($pages as $page){
            if($count == $id){
                $retour = $page;
            }
            $count++;
        }
        return $this->get_page = $retour;
    }

    public function set_page($id, $contenu) {
        $open_pages = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/pages.json');
        $pages = json_decode($open_pages);
        $count = 1;
        foreach($pages as $page){
            if($id == $count){
                $page = $contenu;
            }
            $new_array[$count] = $page;
            $count++;
        }
        
        $close_pages = json_encode($new_array);
        file_put_contents(__DIR__.'/../23xv2304nv^F8tr/pages.json', $close_pages);
        header('Location: contenu');
        exit();
    }

    public function set_file($file, $nom) {
        $date = date('y').date('m').date('d').date('H').date('i').date('s');
        $info = new SplFileInfo($file['name']);
        $extension = strtolower($info->getExtension());
        $output = $date.'-'.$nom.'.'.$extension;
        $input = $file['tmp_name'];
        if($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif"){
            $fichier = move_uploaded_file($input, __DIR__.'/../img/import/'.$output);
        }
        elseif($extension == "pdf"){
            $fichier = move_uploaded_file($input, __DIR__.'/../pdf/import/'.$output);
        }
        else{
            
        }
        
        return $this->set_file = $output;
    }
}