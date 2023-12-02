<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" href="img/favicon.png" type="image/png" >
    <title>Jogja Bay Waterpark</title>
</head>
<body>

<!-- NAVBAR -->
    <header>
        <div class="container">
            <input type="checkbox" name="" id="check">
            
            <div class="logo-container">
                <a href="index.php"><img src="img/logo.png" alt="" class="logo"></a>
            </div>

            <div class="nav-btn">
                <div class="nav-links">
                    <ul>
                        <li class="nav-link" style="--i: .6s">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="nav-link" style="--i: .85s">
                            <a href="#">Info<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown">
                                <ul>
                                    <li class="dropdown-link">
                                        <a href="content/tiket.html">Tiket</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="content/promo.html">Promo</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="content/news.html">News & Events</a>
                                    </li>
                                    <li class="dropdown-link">
                                        <a href="content/attraction.html">Attraction</a>
                                    </li>
                                    <div class="arrow"></div>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="content/gallery.html">Gallery</a>
                        </li>
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="content/about.html">About</a>
                        </li>
                    </ul>
                </div>

                <div class="log-sign" style="--i: 1.8s">
                    <a href="php/login.php" class="btn transparent">LOGIN ADMIN</a>
                </div>
            </div>

            <div class="hamburger-menu-container">
                <div class="hamburger-menu">
                    <div></div>
                </div>
            </div>
        </div>
    </header>
<!-- -->

<!-- ISI -->
    <main>

<!-- slide -->
    <div id="slider" class="slide">
        <figure>
            <img src="img/1.jpg">
            <img src="img/jogja-bay.png">
            <img src="img/1.jpg">
            <img src="img/jogja-bay.png">
            <img src="img/1.jpg">
        </figure>
    </div>

<!-- ticket -->
    <div class="ticket">
    <h1>Klik Untuk Pesan</h1>
    <h1 class="eticket">TICKET</h1> 
    <div class="log-sign" style="--i: 1.8s">
        <a href="content/promo.html" class="btn transparent">Ticket</a>
    </div>     
    </div>

<!-- Promo -->
    <div class="textpromo">
            <h1>Promo</h1>
            <p>Ikuti event-event seru kami dan ajak keluarga anda bermain di Jogja Bay dan </p>
            <p>dapatkan juga berita menarik seputar Jogja Bay.</p>
    </div>
    <div class="promo">
        <a href="content/promo/promo1.html">
        <div class="card">
            <div class="image">
                <img src="img/promo1.jpg">
            </div>
            <div class="title">
                <h3>Seputar Promo Jogjabay</h3>
            </div>
        </div>
        </a>
        <a href="content/promo/promo2.html">
        <div class="card">
            <div class="image">
                <img src="img/promo2.jpg">
            </div>
            <div class="title">
                <h3>Jogjabay 12.12</h3>
            </div>
        </div>
        </a>
        <a href="content/promo/promo3.html">
        <div class="card">

            <div class="image">
                <img src="img/promo3.png">
            </div>
            <div class="title">
                <h3>Flash Sale Buy 1 Get 5 Kuota Terbatas</h3>
            </div>
        </div>
        </a>
    </div>
    <div class="tombolpromo" style="--i: 1.8s">
                    <a href="content/promo.html" class="btn solid">Lihat Promo Lain</a>
        </div>

        <!-- Attraction -->
    <div class="textpromo">
            <h1>Attraction</h1>
            <p>Jogja Bay Waterpark memberikan keamanan dan kenyamanan bagi keluarga,</p>
            <p>juga menyajikan berbagai wahana yang memberikan pengalaman baru dan</p>
            <p>seru yang tak terlupakan.</p>
    </div>
    <div class="wahana">
    <a href="content/attraction/at1.html">
     <div class="attraction">
        <h4>Memo Racer</h4>
        <img src="img/at1.png" alt="">
        <p>
            Terdiri dari 8 lintasan seluncur, Anda bersama teman dapat saling menguji kecepatan ketika meluncur di wahana Memo Racer yang dijamin seru!
        </p>
    </div>
    </a>
    <a href="content/attraction/at2.html">
    <div class="attraction">
        <h4>Bekti Adventures</h4>
        <img src="img/at2.png" alt="">
        <p>
            Bekti, tokoh pemimpin pasukan keraton ini akan membawa Anda berkeliling Jogja Bay melewati slider meliuk dan berputar, wahana ini bisa di naiki oleh 4 orang
        </p>
    </div>
    </a>
    <a href="content/attraction/at2.html">
    <div class="attraction">
        <h4>Volcano Coaster</h4>
        <img src="img/at3.png" alt="">
        <p>
            Anda yang mencari kebebasan dan ingin melepas penat dapat mengekspresikannya pada wahana Volcano Coaster yang bermuara di sungai wahana Jogja  Bay 
        </p>
    </div>
    </a>
    </div>
    <div class="tombolpromo" style="--i: 1.8s">
                    <a href="content/attraction.html" class="btn solid">Lihat Lebih Banyak</a>
        </div>
    </main>
<!-- -->

<!-- Footer -->
<footer class="footer">
     <div class="container">
        <div class="row">
            <div class="footericon">
                <img src="img/footer.png" alt="">
               <img src="img/favicon.png" alt="">
            </div>
            
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    <li><a href="#">Phone: 02748722020</a></li>
                    <li><a href="#">Whatsapp: 082116160023</a></li>
                    <li><a href="#">Location</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4>Social Media</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Berilah pendapat dan penilaian tentang wahana di Jogjabay ke e-mail admin@jogjabay.com</h4>
                
            </div>
        </div>
     </div>
        <div class="copy">
            <p class="copyright">© Copyright 2020 Kelompok 3, Jogjabay. All rights reserved.</p>
        </div>
  </footer>

<!-- -->
</body>

</html>