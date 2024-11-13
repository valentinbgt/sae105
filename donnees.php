<?php include_once("header.php"); ?>
        <script>document.title = "Données";</script>

        <link rel="stylesheet" href="css/jquery.dataTables.css">
        <link rel="stylesheet" href="css/buttons.dataTables.css">

        <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->

        <script src="js/jquery-3.7.0.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.buttons.min.js"></script>
        <script src="js/buttons.print.min.js"></script>
        <script src="js/buttons.html5.min.js"></script> <!-- nécéssaire ? -->

        <script src="js/pdfmake.min.js"></script>
        <script src="js/vfs_fonts.js"></script>

        <script src="js/jszip.min.js"></script>

        <script src="js/donnees.php.js"></script>
        <main>
            <h2>Les titres les plus connus</h2>
            <table id="hedexTopTitles" class="hover" hidden>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cover</th>
                        <th>Titre - Artiste</th>
                        <th>Album</th>
                        <th>Contributeurs</th>
                        <th>Durée</th>
                        <th>Écouter</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tracklist = json_decode(file_get_contents("datas/tracklist.json"), true);
                    foreach($tracklist as $cle => $track){
                        $trackId = $track["id"];
                        //$cover = $track["album"]["cover"];
                        //$coverXL = $track["album"]["cover_xl"];
                        $cover = "images/cover/small/$trackId.jpg";
                        $coverXL = "images/cover/xl/$trackId.jpg";
                        $artist = $track["artist"]["name"];
                        $title = $track["title"];
                        $link = $track["link"];
                        $duration = $track["duration"];
                        //$audioPreview = $track["preview"];
                        $audioPreview = "audio/fullSongs/$trackId.mp3";
                        $albumTitle = $track["album"]["title"];
                        $contibutors = $track["contributors"];

                        echo "<tr>";

                        echo "<td>" . $cle+1 . "</td>";
                        echo "<td><a href='$coverXL' target='_blank'><img alt='cover d album' src='$cover'></a></td>";
                        echo "<td><a href='$link'>$title</a></td>";
                        echo "<td>$albumTitle</td>";
                        echo "<td>";
                        foreach($contibutors as $i => $contibutor){
                            $contibutorName = $contibutor["name"];
                            $contibutorLink = $contibutor["link"];

                            echo "<a href='$contibutorLink'>$contibutorName</a>";
                            if($i+1 < count($contibutors)) echo ", ";
                        }; echo "</td>";
                        echo "<td>$duration"."s</td>";
                        echo "<td><button class='audioPlayer' value='$audioPreview'></button></td>";
                        
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </main>
<?php include_once("footer.php"); ?>