<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cout Cafe</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f7f3ef;
      color: #4a3f35;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #6d4c41;
      color: #fff;
      padding: 10px 40px;
    }

    header h1 {
      margin: 0;
      font-size: 2em;
      font-family: 'Dancing Script', cursive;
    }

    /* For navigation bar */
    nav {
      display: flex;
      gap: 30px;
      font-size: 1.3em;
      font-family: "timesnewroman";
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-size: 1em;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #d7ccc8;
    }

    .container {
      display: flex;
      flex: 1;
      width: 100%;
      height: calc(100vh - 60px); /* Adjust for header height*/ 
    }

    .left-section {
      flex: 3;
      padding: 40px;
      background-color: #8d6e63;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .left-section h2 {
      font-size: 5.5em;
      text-align: center;
      font-family: 'Dancing Script', cursive;
      margin-bottom: 20px;
      margin-top: 20px;
    }

    .left-section p {
      font-size: 1.2em;
      margin: 10px 0;
      text-align: center;
      font-family: 'timesnewroman';
    }

    .carousel {
      width: 80%;
      height: 80%;
      max-width: 500px;
      max-height: 500px;
      overflow: hidden;
      border-radius: 10px;
      margin-top: 30px; /* Adds space between the tagline and carousel */
    }

    .carousel-images {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .carousel-images img {
      width: 100%;
      border-radius: 10px;
    }

    .carousel-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      border: none;
      padding: 10px;
      cursor: pointer;
      z-index: 10;
    }

    .right-section {
      flex: 1;
      padding: 20px;
      background-color: #f7f3ef;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* Updated styling for "Join Us Today!" */
    .right-section h3 {
      font-size: 2.5em;
      font-family: 'Dancing Script', cursive;
      margin-bottom: 15px;
      color: #6d4c41;  /* A contrasting color for better visibility */
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow to make it stand out */
      letter-spacing: 3px; /* Adds spacing between letters for an elegant touch */
      text-align: center;
    }

    form {
      width: 90%;
      max-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    form input {
      padding: 8px;
      font-size: 0.9em;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form button {
      background-color: #6d4c41;
      color: #fff;
      border: none;
      padding: 8px;
      font-size: 0.9em;
      cursor: pointer;
      border-radius: 5px;
    }

    form button:hover {
      background-color: #5d4037;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #6d4c41;
      color: #fff;
    }

    .cat-gif {
      width: 80px; /* Adjust size as needed */
      height: auto;
      margin-bottom: -1px; /* Space between gif and button */
    }
  </style>
</head>
<body>

<header>
  <h1>C-out Cafe</h1>
  <nav>
    <a href="lp.php"><b>Home</b></a>
    <a href="menuone.php"><b>Products & Services</b></a>
    <a href="About_us.php"> <b>About Us</b></a>
  </nav>
</header>

<div class="container">
  <!-- Landing Page Section -->
  <div class="left-section">
    <h2>C-out Cafe</h2>
    <p>Experience the perfect blend of coffee and comfort. Your journey to a cup of happiness starts here.</p>

    <!-- Carousel -->
    <div class="carousel">
      <!--<button class="carousel-btn prev">&#10094;</button>-->
      <div class="carousel-images">
        <img src="http://wallup.net/wp-content/uploads/2017/11/17/239445-coffee-coffee_beans-cup.jpg" alt="Coffee 1">
        <img src="https://th.bing.com/th/id/OIP.8ZNVWKEFIjpuKC9KvZzg4wHaE8?rs=1&pid=ImgDetMain" alt="Coffee 2">
        <img src="https://assets.bonappetit.com/photos/5ca53449cab3b6de9ee488f4/16:9/w_2560%2Cc_limit/chocolate-chip-cookie-1.jpg" alt="Coffee 3">
        <img src="https://th.bing.com/th/id/OIP.x3O6a1hNRFg9CzC1xM5-dgHaD4?rs=1&pid=ImgDetMain" alt="Coffee 4">
      </div>
     <!--<button class="carousel-btn next">&#10095;</button>-->
    </div>
  </div>

  <div class="right-section">
    <!-- Right Section content like forms or information -->
    <h3>Join Us Today!</h3>

    <!-- Cat GIF above the sign-up button -->
    <img src="images/giphy.gif" alt="Cat Gif" class="cat-gif">

    <form action="loginform.php" method="post">
      <button type="submit">Sign Up</button>
    </form>
  </div>
</div>

<script>
  const carousel = document.querySelector('.carousel-images');
  const images = document.querySelectorAll('.carousel-images img');
  let index = 0;

  function updateCarousel() {
    const width = images[0].clientWidth;
    carousel.style.transform = `translateX(${-index * width}px)`;
  }

  setInterval(() => {
    index = (index + 1) % images.length;
    updateCarousel();
  }, 3000);
</script>

</body>
</html>
