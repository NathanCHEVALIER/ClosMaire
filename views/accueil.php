        <!-- Slider-->
        <section id="slider" >
            <div>
              <?php
                require_once(__DIR__.'/../models/closmaire.class.php');
                $Closmaire = new Closmaire();
                    $slides = file_get_contents(__DIR__.'/../23xv2304nv^F8tr/slider.json');
                    $slides = json_decode($slides);
                    foreach($slides as $slide){
                      $slide = (array) $slide;
                      if($slide['type'] == 1){
                        $data = $Closmaire->get_article(1, $slide['num']);
                        echo '
                        <div style="background-image: url(\'img/import/'.$data['img'].'\');">
            		          <h2><a href="/articles/'.$data['categorie'].'/'.$data['id'].'-'.$data['titre'].'" target="_blank" >'.$data['titre'].'</a></h2>
            	          </div>';
                      }
                      elseif($slide['type'] == 2){
                        echo '
                        <div style="background-image: url(\'img/import/'.$slide['img'].'\');">
            		          <h2><a href="'.$slide['url'].'" target="_blank" >'.$slide['titre'].'</a></h2>
            	          </div>';
                      }
                    }
                  ?>
            </div>
            <div>
            	<div></div>
            	<div></div>
            	<div>
            		<div class="actuel" ></div>
            		<div></div>
            		<div></div>
            		<div></div>
            	</div>
            </div>
						<a href="https://lclosmaire21200.ent-liberscol.fr/Login.jsp" target="_blank" ></a>
        </section>

        <section id="timeline" >
          <?php
            $articles = $Closmaire->get_article(2, false);
            $tour = 0;
            foreach($articles as $article){
              if($tour < 7){
                $article = (array) $article;
                if($article['etat'] == true){
                  $date = $Closmaire->get_date($article['date']);
                  echo "
                  <article data='".$article['id']."' >
                    <div></div>
                    <div>
                      <div class='miniature' style='background-image: url(\"img/import/".$article['img']."\");' ></div>
                      <div class='contenu' >
                        <h3>".$article['titre']."</h3>
                        <span>".$date."</span>
                        <p>".$article['soustitre']."</p>
                      </div>
                    </div>
                  </article>";
                }
              }
              else{
                break;
              }
              $tour = $tour + 1;
            }
          ?>
          <a href="/articles" class="bouton" >Plus d'articles</a>
        </section>

        <section id="formation" >
        	<article>
        		<a href="/formations/gt" >
        			<div></div>
        			<p>Filières <br />générales</p>
        		</a>
        	</article>
        	<article>
        		<a href="/formations/gt" >
        			<div></div>
        			<p>filières <br />technologiques</p>
        		</a>
        	</article>
        	<article>
        		<a href="/formations/pro">
        			<div></div>
        			<p>filières <br />professionnelles</p>
        		</a>
        	</article>
        	<article>
        		<a href="/formations/bts">
        			<div></div>
        			<p>bts <br />tourisme</p>
        		</a>
        	</article>
        </section>
		
		<section id="contact" >
      <div id="map"></div>
      <aside>
				<h3>Contact</h3>
				<div>
					<div>4 rue des rôles, 21200 Beaune</div>
					<div>03 80 24 40 00</div>
					<div><a href="mailto:0210006t@ac-dijon.fr"> 0210006t@ac-dijon.fr</a></div>
				</div>
			</aside>
      <a href="http://www.ac-dijon.fr/" target="_blank"></a>
			<form method="post" action="/controller.php" id="form-contact" >
				<input type="mail" class="champ" placeholder="Adresse mail" name="email"/>
				<input type="hidden" name="action" value="4" />
				<input type="text" class="champ" placeholder="Sujet" name="sujet"/>
				<textarea class="champ" placeholder="Message" name="texte" style="height: 150px;" ></textarea>
				<input type="submit" class="bouton" value="Envoyer" />
			</form>
    </section>

        <script>
          function initMap() {
            var uluru = {lat: 47.0297984, lng: 4.8382545};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: uluru,
              zoomControl: true,
              mapTypeControl: false,
              scaleControl: true,
              streetViewControl: true,
              rotateControl: true,
              fullscreenControl: true,
              styles: [
                {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }
              ]
            });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map
            });
          }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh2WuDMtROwfkN5QTBKqIHLA4cRjenpU0&callback=initMap"></script>