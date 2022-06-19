<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Clanak</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="PWA Projekt"/>
    <meta name="description" content="PWA Projekt">
    <meta name="author" content="Duje Smoljanović">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/43d37ac167.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Slike/LExpressLogo.png" class="logoSlika" alt="Logo">
        </div>
        <nav>
            <div class="navigacija">
                <ul>
                    <li><a href="index.php"> HOME </a></li>
                    <li><a href="kategorija.php?idk=Sport">SPORT</a></li>
                    <li><a href="kategorija.php?idk=Zabava">ZABAVA</a></li>
                    <li><a href="kategorija.php?idk=Politika">POLITIKA</a></li>
                    <li><a href="#"> ADMINISTRACIJA </a></li>
                    <li><a href="unos.php"> UNOS </a></li>
                    <li><a href="registracija.php"> REGISTRACIJA </a></li>
                </ul>
            </div>
        </nav>
        <div class="pravokutnik"></div>
    </header> 
    <body>
    <?php
        $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
        if($dbc){
            $query = "SELECT * FROM vijesti WHERE prikaz > 0 ORDER BY id DESC";
            $result = mysqli_query($dbc,$query);
        }
        if($result){
            while ($row = mysqli_fetch_array($result)){
    ?>
        <div class="centriranje">
        <div class="kategorija">
            <div class="vijesti">
                <form action="" method="post" name="unos">
                    <label for="naslov">Naslov vijesti:</label><br>
                    <input type="text" id="naslov" name="naslov" class="naslov" value="<?=$row['naslov'];?>"><br>
                    <span id="porukaNaslov" style="color: #ff0000"></span>
                    <label for="sazetak">Kratki sažetak vijesti:</label><br>
                    <textarea name="sazetak" id="sazetak" class="sazetak"><?=$row['sazetak'];?></textarea><br>
                    <span id="porukaSazetak" style="color: #ff0000"></span>
                    <label for="sadrzaj">Sadržaj vijesti:</label><br>
                    <textarea name="sadrzaj" id="sadrzaj" class="sadrzaj" ><?=$row['sadrzaj'];?></textarea><br>
                    <span id="porukaSadrzaj" style="color: #ff0000"></span>
                    <label for="kategorije">Kategorija vijesti:</label>
                    <select id="kategorije" name="kategorije">
                        <option disabled selected value=""> -- Kategorija -- </option>
                        <option value="Sport" <?php if($row['kategorija'] == 'Sport'){echo 'selected';}?>>Sport</option>
                        <option value="Zabava" <?php if($row['kategorija'] == 'Zabava'){echo 'selected';}?>>Zabava</option>
                        <option value="Politika" <?php if($row['kategorija'] == 'Politika'){echo 'selected';}?>>Politika</option>
                      </select><br>
                    <span id="porukaKategorije" style="color: #ff0000"></span>
                    <label for="naslovnaSlika">Naslovna slika:</label>
                    <input type="file" accept="image/png, image/jpeg, image/gif" class="naslovnaSlika" name="naslovnaSlika" id="naslovnaSlika" value="<?=$row['slika'];?>"/>
                    <img src="Slike/<?=$row['slika'];?>" class="slikaAdmin" alt="<?=$row['slika'];?>">
                    <span id="porukaNaslovnaSlika" style="color: #ff0000"></span>
                    <label for="prikazDA">Prikaz sadržaja na stranici:</label>
                    <input type="checkbox" id="prikazDA" name="prikazDA" value="DA" class="checkbox" <?php if($row['prikaz'] == '1'){echo 'checked';}?>>
                    <label for="prikazDA" class="prikazCBox"> Prikaži</label><br><br>
                    <input type="hidden" name="id" value="<?=$row['id'];?>">
                    <div class="submit_reset">
                        <input type="submit" value="UPDATE" class="submit" name="update" id="update">
                        <input type="submit" value="DELETE" class="submit" id="delete" name="delete">    
                    </div>
                  </form>
            </div>
        </div>
    </div>
    <?php
            }
        }
        if(isset($_POST['delete'])){
            $id=$_POST['id'];
            $query = "DELETE FROM vijesti WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
           }
        if(isset($_POST['update'])){
            if(isset($_POST['naslov'])) { $naslov = $_POST['naslov'];}
            if(isset($_POST['sazetak'])) { $sazetak = $_POST['sazetak'];}
            if(isset($_POST['sadrzaj'])) { $sadrzaj = $_POST['sadrzaj'];}
            if(isset($_POST['kategorije'])) { $kategorije = $_POST['kategorije'];}
            if(isset($_POST['naslovnaSlika'])) { $naslovnaSlika = $_POST['naslovnaSlika'];}
            if(isset($_POST['prikazDA'])){
                $prikazDA = true;
            }else $prikazDA = false;
            $publishDate = date("Y-m-d H:i:s");
            $id=$_POST['id'];
            $query = "UPDATE vijesti SET naslov='$naslov', sazetak='$sazetak', sadrzaj='$sadrzaj', 
            slika='$naslovnaSlika', kategorija='$kategorije', prikaz='$prikazDA', datum='$publishDate' WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
            }
        mysqli_close($dbc);
        
    ?>
    </body>
    <footer>
        <div class="footer">
            <p>Les sites du réseau Groupe L'Express : Food avec Mycuisine.fr</p>
            <p>© L'Express -</p>
            <p>Duje Smoljanović, dsmoljano@tvz.hr, 2022</p>
        </div>
    </footer>
</body>
</html>
