<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Cout Cafe</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #8d6e63;
            color: #fff;
            line-height: 1.6;
        }

        h1, h2 {
            font-family: 'Georgia', serif;
            color: #2c3e50;
        }

        /* Header and Navigation */
        header {
            background-color: #8d6e63;
            color: #fff;
            padding: 5px 5;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: right;
        }

        nav ul li {
            margin: 0 65px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 25px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #f39c12;
        }

        /* About Us Container */
        .about-us {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f1e0c6;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .about-us h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: #8d6e63;
        }

        .about-us section {
            margin-bottom: 40px;
        }

        .about-us section h2 {
            font-size: 28px;
            color:#8d6e63;
            border-bottom: 2px #e67e22;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        /* Text Sections */
        .about-us section p {
            font-size: 18px;
            color: #8d6e63;
            line-height: 1.8;
            text-align: justify;
        }

        /* Call to Action Button */
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #8d6e63;
            color: white;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #e67e22;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        footer p {
            font-size: 16px;
        }

        /* Testimonials Section */
        .testimonials blockquote {
            font-style: italic;
            color: #2c3e50;
            border-left: 4px solid #e67e22;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        /* Team Section */
        .team {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .team .team-member {
            flex: 1;
            max-width: 250px;
            margin: 15px;
            text-align: center;
        }

        .team .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .team .team-member h3 {
            font-size: 22px;
            color: #e67e22;
        }

        .team .team-member p {
            font-size: 16px;
            color: #555;
        }

    </style>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="lp.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <div class="about-us">
        <h1>About Cout Cafe</h1>

        <section class="intro">
            <p>At C-out Cafe, we believe in bringing people together over the perfect cup of coffee, whether it's to start your day, take a break, or spend time with loved ones. Our café blends the finest coffee beans with a warm, inviting atmosphere that makes you feel right at home.</p>
        </section>

        <section class="mission">
            <h2>Our Mission</h2>
            <p>Our mission is to create a welcoming space for coffee lovers to experience the finest flavors, enjoy great company, and be part of a community. We aim to serve high-quality coffee, promote sustainability, and provide an atmosphere where everyone can feel relaxed and inspired.</p>
        </section>

        <section class="sustainability">
            <h2>Our Commitment to Sustainability</h2>
            <p>At Cout Cafe, we are committed to sustainability. From sourcing our coffee beans from ethical suppliers to using eco-friendly packaging, we prioritize the environment in everything we do. Every cup of coffee you enjoy helps support sustainable practices and fair trade initiatives.</p>
        </section>

      <!--  <section class="team">
            <h2>Meet the Team</h2>
            <div class="team-member">
                <img src="images/team-member1.jpg" alt="Barista 1">
                <h3>John Doe</h3>
                <p>Lead Barista</p>
            </div>
            <div class="team-member">
                <img src="images/team-member2.jpg" alt="Barista 2">
                <h3>Jane Smith</h3>
                <p>Manager</p>
            </div>
            <div class="team-member">
                <img src="images/team-member3.jpg" alt="Barista 3">
                <h3>Emily White</h3>
                <p>Barista</p>
            </div>
        </section>-->

        <section class="call-to-action">
            <a href="menuone.php" class="cta-button">Explore Our Menu</a>
        </section>

        <section class="contact">
            <h2>Contact Us</h2>
            <p> Call  (+63)967-654-3212 or visit us on our physical store located @ Centro Occidental, Polangui, Albay .</p>
        </section>
    </div>
   

</body>
</html>