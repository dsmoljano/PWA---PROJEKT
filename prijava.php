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
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['password'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriranKorisnik = '';
    //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
     mysqli_stmt_bind_param($stmt, 's', $username);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_store_result($stmt);
     }
    if(mysqli_stmt_num_rows($stmt) > 0){
     $msg='Korisničko ime već postoji!';
    }else{
     // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika 
     $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, 
    razina)VALUES (?, ?, ?, ?, ?)";
     $stmt = mysqli_stmt_init($dbc);
     if (mysqli_stmt_prepare($stmt, $sql)) {
     mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, 
    $hashed_password, $razina);
     mysqli_stmt_execute($stmt);
     $registriranKorisnik = true;
     }
    }
    mysqli_close($dbc);
    
?>
</html>