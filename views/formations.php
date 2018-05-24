        <section id="formations" class="derog-body" >
            <div class="derog-body" > 
                <div class="derog-body" >
                    <select name="categorie" class="derog-body" >
                        <option value="gt" 
                        <?php 
                            if($_GET['categorie'] == "gt"){
                                echo "selected";
                            }                        
                        ?>
                        class="derog-body" >Filières générales et technologiques</option>
                        <option value="pro" 
                        <?php 
                            if($_GET['categorie'] == "pro"){
                                echo "selected";
                            }                        
                        ?>
                        class="derog-body" >Filières professionelles</option>
                        <option value="bts" 
                        <?php 
                            if($_GET['categorie'] == "bts"){
                                echo "selected";
                            }                        
                        ?>
                        class="derog-body" >Filières post-bac</option>
                        <option value="eps" 
                        <?php 
                            if($_GET['categorie'] == "eps"){
                                echo "selected";
                            }                        
                        ?>
                        class="derog-body" >Pratique Sportive</option>
                    </select>
                </div>
                <div>
                    <select name="gt" >
                        <option value="1" >Bac S</option>
                        <option value="3" >Bac L</option>
                        <option value="2" >Bac ES</option>
                        <option value="4" >Bac STI2D</option>
                    </select>
                    <select name=pro >
                        <option value="5" >Bac Pro MEI</option>
                        <option value="7" >Bac Pro TU</option>
                        <option value="6" >Bac Pro MELEC</option>
                        <option value="8" >CAP PROE</option>
                    </select>
                    <select name="bts" >
                        <option value="9" >BTS Tourisme</option>
                    </select>
                    <select name="eps" >
                        <option value="11" >EPS & UNSS</option>
                    </select>
                </div>
            </div>

            <aside id="contenu" >
                
            </aside>

        </section>