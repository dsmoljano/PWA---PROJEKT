<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Unos</title>
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
                    <li><a href="administracija.php"> ADMINISTRACIJA </a></li>
                    <li><a href="#"> UNOS </a></li>
                    <li><a href="registracija.php"> REGISTRACIJA </a></li>
                </ul>
            </div>
        </nav>
        <div class="pravokutnik"></div>
    </header> 
    <div class="centriranje">
        <div class="kategorija">
            <div class="vijesti">
                <form action="" method="post" name="unos">
                    <label for="naslov">Unesite naslov vijesti:</label><br>
                    <input type="text" id="naslov" name="naslov" class="naslov"><br>
                    <span id="porukaNaslov" style="color: #ff0000"></span>
                    <label for="sazetak">Unesite kratki sažetak vijesti:</label><br>
                    <textarea name="sazetak" id="sazetak" class="sazetak"></textarea><br>
                    <span id="porukaSazetak" style="color: #ff0000"></span>
                    <label for="sadrzaj">Unesite sadržaj vijesti:</label><br>
                    <textarea name="sadrzaj" id="sadrzaj" class="sadrzaj"></textarea><br>
                    <span id="porukaSadrzaj" style="color: #ff0000"></span>
                    <label for="kategorije">Odaberite kategoriju vijesti:</label>
                    <select id="kategorije" name="kategorije">
                        <option disabled selected value=""> -- Kategorija -- </option>
                        <option value="Sport">Sport</option>
                        <option value="Zabava">Zabava</option>
                        <option value="Politika">Politika</option>
                      </select><br>
                    <span id="porukaKategorije" style="color: #ff0000"></span>
                    <label for="naslovnaSlika">Odaberite naslovnu sliku:</label>
                    <input type="file" accept="image/png, image/jpeg, image/gif" class="naslovnaSlika" name="naslovnaSlika" id="naslovnaSlika"/>
                    <span id="porukaNaslovnaSlika" style="color: #ff0000"></span>
                    <label for="prikazDA">Želite li da se sadržaj prikaže na stranici:</label>
                    <input type="checkbox" id="prikazDA" name="prikazDA" value="DA" class="checkbox" checked>
                    <label for="prikazDA" class="prikazCBox"> Prikaži</label><br><br>
                    <div class="submit_reset">
                        <input type="submit" value="POŠALJI" class="submit" name="submit" id="submit">
                        <input type="reset" value="PONIŠTI" class="reset">    
                    </div>
                  </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <p>Les sites du réseau Groupe L'Express : Food avec Mycuisine.fr</p>
            <p>© L'Express -</p>
            <p>Duje Smoljanović, dsmoljano@tvz.hr, 2022</p>
        </div>
    </footer>
</body>
<?php
    if(isset($_POST['naslov'])) { $naslov = $_POST['naslov'];}
    if(isset($_POST['sazetak'])) { $sazetak = $_POST['sazetak'];}
    if(isset($_POST['sadrzaj'])) { $sadrzaj = $_POST['sadrzaj'];}
    if(isset($_POST['kategorije'])) { $kategorije = $_POST['kategorije'];}
    if(isset($_POST['naslovnaSlika'])) { $naslovnaSlika = $_POST['naslovnaSlika'];}
    if(isset($_POST['prikazDA'])){
        $prikazDA = true;
    }else $prikazDA = false;
    $publishDate = date("Y-m-d H:i:s");
    if(isset($_POST['submit'])){
        $query = "INSERT INTO vijesti (naslov,sazetak,sadrzaj,kategorija,slika,prikaz,datum) VALUES('$naslov', '$sazetak', '$sadrzaj', '$kategorije', '$naslovnaSlika', '$prikazDA', '$publishDate')";
        $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
        $result = mysqli_query($dbc, $query);
        if($dbc === TRUE){
            if($result === TRUE){
                echo '<script>alert("Uspješno dodavanje podataka")</script>';
            }
            else echo '<script>alert("Neuspješno dodavanje podataka")</script>';;
        }
        mysqli_close($dbc);
        header("Location:index.php");
    }
    
?>
<script>
        document.getElementById("submit").onclick = function(event) {
        var provjera = true;

        // Naslov 
        var poljeNaslov = document.getElementById("naslov");
        var naslov = document.getElementById("naslov").value;
        if (naslov.length < 5 || naslov.length > 30) {
            provjera = false;
            poljeNaslov.style.border = "1px dashed red";
            document.getElementById("porukaNaslov").innerHTML = "<br>Naslov vijesti mora imati 5 do 30 znakova<br>";
        }else{
            poljeNaslov.style.border = "1px solid black";
            document.getElementById("porukaNaslov").innerHTML = "";
        }
        // Sazetak 
        var poljeSazetak = document.getElementById("sazetak");
        var sazetak = document.getElementById("sazetak").value;
        if (sazetak.length < 10 || sazetak.length > 100) {
            provjera = false;
            poljeSazetak.style.border = "1px dashed red";
            document.getElementById("porukaSazetak").innerHTML = "<br>Kratki sadržaj vijesti mora imati 10 do 100 znakova<br>";
        }else{
            poljeSazetak.style.border = "1px solid black";
            document.getElementById("porukaSazetak").innerHTML = "";
        }
        // Sadrzaj
        var poljeSadrzaj = document.getElementById("sadrzaj");
        var sadrzaj = document.getElementById("sadrzaj").value;
        if (sadrzaj.length == "") {
            provjera = false;
            poljeSadrzaj.style.border = "1px dashed red";
            document.getElementById("porukaSadrzaj").innerHTML = "<br>Tekst vijesti nesmije biti prazan<br>";
        }else{
            poljeSadrzaj.style.border = "1px solid black";
            document.getElementById("porukaSadrzaj").innerHTML = "";
        }
        // Kategorija 
        var poljeKategorije = document.getElementById("kategorije");
        var kategorije = document.getElementById("kategorije").value;
        if (kategorije.length == "") {
            provjera = false;
            poljeKategorije.style.border = "1px dashed red";
            document.getElementById("porukaKategorije").innerHTML = "<br>Kategorija mora biti odabrana<br>";
        }else{
            poljeKategorije.style.border = "1px solid black";
            document.getElementById("porukaKategorije").innerHTML = "";
        }
        // Slika 
        var poljeNaslovnaSlika = document.getElementById("naslovnaSlika");
        var naslovnaSlika = document.getElementById("naslovnaSlika").value;
        if (naslovnaSlika.length == "") {
            provjera = false;
            poljeNaslovnaSlika.style.border = "1px dashed red";
            document.getElementById("porukaNaslovnaSlika").innerHTML = "<br>slika mora biti odabrana<br>";
        }else{
            poljeNaslovnaSlika.style.border = "1px solid black";
            document.getElementById("porukaNaslovnaSlika").innerHTML = "";
        }
        if (provjera != true) {
            event.preventDefault();
        }
        }
    </script>
</html>