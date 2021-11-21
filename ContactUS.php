<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contactUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
button {
 font-size: 10px;
 padding: 1em 3.3em;
 transform: perspective(200px) rotateX(15deg);
 color: white;
 font-weight: 900;
 border: none;
 border-radius: 5px;
 background: linear-gradient(0deg, rgba(63,94,251,1) 0%, rgba(70,135,252,1) 100%);
 box-shadow: rgba(63,94,251,0.2) 0px 40px 29px 0px;
 will-change: transform;
 transition: all 0.3s;
 border-bottom: 2px solid rgba(70,135,252,1);
}

button:hover {
 transform: perspective(180px) rotateX(30deg) translateY(2px);
}

button:active {
 transform: perspective(170px) rotateX(36deg) translateY(5px);
}
</style>
</head>
<body>
<aside class="profile-card">
  <header>
    <!-- here’s the avatar -->
    <a href="#">
    
      <img src="logo2.png" class="hoverZoomLink" style= "height: 80px;">
      
    </a>

    <!-- the username -->
    <h1>
            RAHWY UNIVERSITY
          </h1>

    <!-- and role or location -->
    <h2>
            We inspire to scam
          </h2>

  </header>

  <!-- bit of a bio; who are you? -->
  <div class="profile-bio">

    <p>
     We want to take your money and give you a piece of paper instead where people think it has a value. Definitely not throwing shade
     
    </p>

    <button>Home</button>
  </div>

  <!-- some social links to show off -->
  <ul class="profile-social-links">
    <li>
      <a target="_blank" href="https://web.facebook.com/INTI.edu">
        <i class="fa fa-facebook"></i>
      </a>
    </li>
    <li>
      <a target="_blank" href="https://twitter.com/inti_edu">
        <i class="fa fa-twitter"></i>
      </a>
    </li>
    <li>
      <a target="_blank" href="https://github.com/Hawwa11/Rahwy-University-Enrollment-System">
        <i class="fa fa-github"></i>
      </a>
    </li>

  </ul>
</aside>




</body>
</html>