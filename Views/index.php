<?php include('plantilla.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8"> 
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://www.diariopanorama.com/fotos/notas/2020/07/13/futbol-5-355708-175940.jpg" class="d-block w-100" alt="..." style="height: 400px;"> <!-- Ajusté a w-100 para que la imagen ocupe todo el contenedor -->
          </div>
          <div class="carousel-item">
            <img src="https://thumbs.dreamstime.com/b/football-field-soccer-green-grass-white-line-stripe-119499920.jpg" class="d-block w-100" alt="..." style="height: 400px;">
          </div>
          <div class="carousel-item">
            <img src="https://th.bing.com/th/id/R.850d48536e9af81cf3afb56b98240b22?rik=JqM41SX%2bnyQytw&riu=http%3a%2f%2fsportarena.ro%2fwp%2fwp-content%2fuploads%2f2020%2f11%2ffotbal1mic.jpg&ehk=VnHRt7I33bWFpwDvWLZFDgGdDHBwxgsKu91Cgp5DS1I%3d&risl=&pid=ImgRaw&r=0" class="d-block w-100" alt="..." style="height: 400px;">
          </div>
          <div class="carousel-item">
            <img src="https://i1.wp.com/www.construcanchas.com/wp-content/uploads/2021/03/fondo-3.jpg?w=1280&ssl=1" class="d-block w-100" alt="..." style="height: 400px;">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="inf mt-10" style= "background-color: rgba(0, 0, 0, 0.8);">
            <div class="col-mb-2" style="margin-left:50px">
                <h1 class="titulo">Quienes</h1>
                <h1 class="titulo">Somos?</h1>
            </div>
            <div class="text col-mb-2">
                <p  style="width:800px">Bienvenidos a Fut 5, el lugar donde la pasión por el fútbol se encuentra con la diversión. Somos un centro deportivo dedicado al fútbol 5, creado para todos aquellos que aman el deporte.</p>
                <p  style="width:800px">Nuestro objetivo es ofrecer un espacio amigable y accesible para jugadores de todas las edades y experiencias. Contamos con canchas de alta calidad y equipamiento moderno</p>
            </div>
        </div>

        <div class="vm col-md-10 mx-auto mt-6" style= "color: white">
            <div class="vision">
                <h1 class="mis"></h1>
                <p class="mis">Organizamos torneos, ligas y eventos especiales que permiten a los jugadores competir y disfrutar al máximo del juego. Creemos en la importancia de la comunidad, por lo que también ofrecemos actividades sociales para que nuestros jugadores se conozcan y compartan momentos inolvidables.</p>
            </div>
        </div>
<br><br>
        <div class="historia mt-10" style= "background-color: rgba(0, 0, 0, 0.8);">
    <div>
        <h1 class="title">¿Cómo nace Fut 5?</h1>
    </div>
    <div class="texto">
        <p>Fut 5 nació de la pasión por el fútbol y el deseo de crear un espacio donde todos pudieran disfrutar del deporte. Su fundación se inspiró en la idea de ofrecer un lugar accesible, seguro y divertido para personas de todas las edades que compartieran el amor por el fútbol.</p>
        <p>Desde sus inicios, Fut 5 se ha enfocado en proporcionar canchas de alta calidad y un ambiente amigable para jugadores novatos y experimentados. A medida que la comunidad creció, también lo hicieron las oportunidades para organizar torneos y eventos que fomentaran la competitividad y la camaradería entre los participantes.</p>
    </div>
</div>
<br><br>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./assets/js/index.js"></script>
</html>