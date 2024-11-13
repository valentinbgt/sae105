        <footer>
            <div id="info" <?php if(!isset($_SESSION["information"])) echo('class="inactive"'); ?>>
                <p><?php if(isset($_SESSION["information"])) echo($_SESSION["information"]); ?><span onclick="this.parentNode.parentNode.style.display = 'none';"><img src="./images/croix-petit.png" alt="Fermer l'info-bulle."></span></p>
                <?php if(isset($_SESSION["information"])) unset($_SESSION["information"]); ?>
            </div>
            <div>
                <p>&copy; MMI Troyes</p>
                <p>Un site par Valentin BEAUGET</p>
                <p><a href="references.php">Références</a></p>
            </div>
        </footer>
    </body>
</html>