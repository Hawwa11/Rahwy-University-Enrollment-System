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
 display: flex;
 height: 3em;
 width: 100px;
 align-items: center;
 justify-content: center;
 background-color: #eeeeee4b;
 border-radius: 3px;
 letter-spacing: 1px;
 transition: all 0.2s linear;
 cursor: pointer;
 border: none;
 background: #fff;
}

button > svg {
 margin-right: 5px;
 margin-left: 5px;
 font-size: 20px;
 transition: all 0.4s ease-in;
}

button:hover > svg {
 font-size: 1.2em;
 transform: translateX(-5px);
}

button:hover {
 box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
 transform: translateY(-2px);
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

    <button style= "margin-left:35px;"  onclick="window.location.href='tabs.php'">
  <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
  <span>Back</span>
</button>
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
    <li>
      <a target="_blank" href="https://www.linkedin.com/school/inti-international-university-&-colleges/">
        <i class="fa fa-linkedin"></i>
      </a>
    </li>

  </ul>
</aside>




</body>
</html>