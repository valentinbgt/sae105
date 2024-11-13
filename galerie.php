<?php include_once("header.php"); ?>
        <script>document.title = "Galerie";</script>
        <main>
            <h2>My Home Is The Rave</h2>
            <form id="uploadImageForm" action="traitements/upload_image.php" method="post" enctype="multipart/form-data">
                <p id="fileUploadButton" onclick="document.getElementById('imageInput').click();">Envoyer une image</p>
                <input type="file" name="image" id="imageInput" hidden onchange="fileInputChanged();"/>
                <input type="submit" value="Go !" style="display: none;"/>
                <script>
                    function fileInputChanged(){
                        document.getElementById("fileUploadButton").innerText = document.getElementById('imageInput').files[0].name;
                        document.querySelector("#uploadImageForm input[type=submit]").style.display = "inline-block";
                    }
                </script>
            </form>
            <div id="galery">
                <?php
                    $galeryPath = "images/galerie/";
                    $galery = scandir($galeryPath);
                    unset($galery[1]);
                    unset($galery[0]);
                    natsort($galery);
                    
                    foreach($galery as $image){
                        $imagePath = $galeryPath.$image;
                        echo "<a href='$imagePath' target='_blank'><div class='img' style='background-image:url($imagePath);'></div></a>";
                    }
                ?>
            </div>
        </main>
<?php include_once("footer.php"); ?>