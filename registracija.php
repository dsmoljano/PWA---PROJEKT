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
                    <li><a href="unos.php"> UNOS </a></li>
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
                    <label for="ime">Unesite Ime:</label><br>
                    <input type="text" id="ime" name="ime" class="naslov"><br>
                    <span id="porukaIme" style="color: #ff0000"></span>

                    <label for="prezime">Unesite Prezime:</label><br>
                    <input type="text" id="prezime" name="prezime" class="naslov"><br>
                    <span id="porukaPrezime" style="color: #ff0000"></span>

                    <label for="username">Unesite Korisničko Ime:</label><br>
                    <input type="text" id="username" name="username" class="naslov"><br>
                    <span id="porukaKorisnickoIme" style="color: #ff0000"></span>

                    <label for="password">Unesite Lozinku:</label><br>
                    <input type="password" id="password" name="password" class="naslov"><br>
                    <span id="porukaLozinka" style="color: #ff0000"></span>

                    <label for="password2">Ponovite Lozinku:</label><br>
                    <input type="password" id="password2" name="password2" class="naslov"><br>
                    <span id="porukaLozinka2" style="color: #ff0000"></span>

                    <br><br><div class="submit_reset">
                        <input type="submit" value="Prijava" class="submit" name="submit" id="submit">
                        <input type="reset" value="Resetiraj" class="reset">    
                    </div><br>
                  </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("submit").onclick = function(event) {
        var provjera = true;

        // Ime 
        var poljeIme = document.getElementById("ime");
        var ime = document.getElementById("ime").value;
        if (ime.length < 1) {
            provjera = false;
            poljeIme.style.border = "1px dashed red";
            document.getElementById("porukaIme").innerHTML = "<br>Ime mora biti uneseno!<br>";
        }else{
            poljeIme.style.border = "1px solid black";
            document.getElementById("porukaIme").innerHTML = "";
        }
        // Prezime 
        var poljePrezime = document.getElementById("prezime");
        var prezime = document.getElementById("prezime").value;
        if (prezime.length < 1) {
            provjera = false;
            poljePrezime.style.border = "1px dashed red";
            document.getElementById("porukaPrezime").innerHTML = "<br>Prezime mora biti uneseno<br>";
        }else{
            poljeSazetak.style.border = "1px solid black";
            document.getElementById("porukaPrezime").innerHTML = "";
        }
        // Korisnicko ime
        var poljeUsername = document.getElementById("username");
        var username = document.getElementById("username").value;
        if (username.length < 1) {
            provjera = false;
            poljeUsername.style.border = "1px dashed red";
            document.getElementById("porukaKorisnickoIme").innerHTML = "<br>Korisničko ime mora biti uneseno!<br>";
        }else{
            poljeSadrzaj.style.border = "1px solid black";
            document.getElementById("porukaKorisnickoIme").innerHTML = "";
        }
        // Provjera lozinki
        var poljePassword = document.getElementById("password");
        var password = document.getElementById("password").value;
        var poljePassword1 = document.getElementById("password2");
        var password1 = document.getElementById("password2").value;

        if (password != password2 || password.length < 1 || password1.length < 1) {
            provjera = false;
            poljePassword.style.border = "1px dashed red";
            poljePassword1.style.border = "1px dashed red";
            document.getElementById("porukaLozinka").innerHTML = "<br>Lozinke moraju biti iste";
            document.getElementById("porukaLozinka1").innerHTML = "<br>Lozinke moraju biti iste";
        }else{
            poljePassword.style.border = "1px solid black";
            poljePassword1.style.border = "1px solid black";
            document.getElementById("porukaLozinka").innerHTML = "<br>Lozinke moraju biti iste";
            document.getElementById("porukaLozinka1").innerHTML = "<br>Lozinke moraju biti iste";
        }
        if (provjera != true) {
            event.preventDefault();
        }
        }
    </script>
    <footer>
        <div class="footer">
            <p>Les sites du réseau Groupe L'Express : Food avec Mycuisine.fr</p>
            <p>© L'Express -</p>
            <p>Duje Smoljanović, dsmoljano@tvz.hr, 2022</p>
        </div>
    </footer>
</body>
<?php
    if(isset($_POST['ime'])) { $ime = $_POST['ime'];}
    if(isset($_POST['prezime'])) { $prezime = $_POST['prezime'];}
    if(isset($_POST['username'])) { $username = $_POST['username'];}
    if(isset($_POST['password'])) { 
        $lozinka = $_POST['password'];
        $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    }
    $razina = 0;
    $registriranKorisnik = '';
    $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if(mysqli_stmt_num_rows($stmt) > 0){
        echo "<script>alert('Korisničko ime već postoji!')</script>";
    }else{
        $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
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