<?php include_once("header.php"); ?>
        <script>document.title = "Contact";</script>
        <main>
            <h2>Contactez nous via cette page</h2>
            <div id="contact">
                <form action="traitements/envoi_mail.php" method="POST">
                    <div id="en-tete">
                        <div class="form-control">
                            <input type="text" name="prenom" id="prenomInput" required autocomplete="off">
                            <label>
                                <span style="transition-delay:0ms">p</span><span style="transition-delay:50ms">r</span><span style="transition-delay:100ms">é</span><span style="transition-delay:150ms">n</span><span style="transition-delay:200ms">o</span><span style="transition-delay:250ms">m</span><span style="transition-delay:300ms" class="asterisque">*</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <input type="text" name="nom" id="nomInput" required autocomplete="off">
                            <label>
                                <span style="transition-delay:0ms">n</span><span style="transition-delay:50ms">o</span><span style="transition-delay:100ms">m</span><span style="transition-delay:150ms" class="asterisque">*</span>
                            </label>
                        </div>
                    </div>
                    <div id="radioContainer">
                        <label for="radio">Précisez votre demande<span class="asterisque">*</span> :</label>
                        <div id="radio">
                            <div class="radioElement">
                                <input type="radio" id="infoRadio" name="typeDemande" value="info" required autocomplete="off">
                                <label for="infoRadio">Information</label>
                            </div>
                            <div class="radioElement">
                                <input type="radio" id="devisRadio" name="typeDemande" value="devis" required autocomplete="off">
                                <label for="devisRadio">Demande de devis</label>
                            </div>
                            <div class="radioElement">
                                <input type="radio" id="reclamationRadio" name="typeDemande" value="reclamation" required autocomplete="off">
                                <label for="reclamationRadio">Réclamation</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-control">
                        <input type="email" name="email" id="emailInput" required autocomplete="off">
                        <label>
                            <span style="transition-delay:0ms">a</span><span style="transition-delay:50ms">d</span><span style="transition-delay:100ms">r</span><span style="transition-delay:150ms">e</span><span style="transition-delay:200ms">s</span><span style="transition-delay:250ms">s</span><span style="transition-delay:300ms">e</span><span style="transition-delay:350ms"> </span><span style="transition-delay:400ms">e</span><span style="transition-delay:450ms">m</span><span style="transition-delay:500ms">a</span><span style="transition-delay:550ms">i</span><span style="transition-delay:600ms">l</span><span style="transition-delay:650ms" class="asterisque">*</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <textarea name="messageContent" id="messageContent" required autocomplete="off"></textarea>
                        <label>
                            <span style="transition-delay:0ms">m</span><span style="transition-delay:50ms">e</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span style="transition-delay:200ms">a</span><span style="transition-delay:250ms">g</span><span style="transition-delay:300ms">e</span><span style="transition-delay:350ms" class="asterisque">*</span>
                        </label>
                    </div>
                    <input type="submit" value="Envoyer">
                    <p class="requiredTip"><span>*</span>Obligatoire</p>
                </form>

                <style>
                    
                </style>
            </div>
            
        </main>
<?php include_once("footer.php"); ?>