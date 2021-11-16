<?php

include("db.php");


?>



<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="form.css">
  </head>
  <body>
    <form class="signup-form" action="/register" method="post">

      <!-- form header -->
      <div class="form-header">
        <h1>Enrollment Form</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- Firstname and Lastname -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Student name</label>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label">nameee</label>

          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Student ID</label>
          </div>
          <div class="form-group right">
        
            <label for="lastname" class="label">ID</label>

          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Study Year</label>
          </div>
          <div class="form-group right">
          
            <label for="lastname" class="label">year</label>
            
          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Semester</label>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label">sem</label>
          </div>
        </div>

   

        <!-- Gender and Hobbies -->
        <div class="horizontal-group">
        <div class="form-group middle">
        <label class="label-title">Select Subjects to Enroll</label>
        </div>
        </div>



        <div class="horizontal-group">
          <div class="form-group left">
            <div>
              <label><input type="checkbox" value="Web">Music</label>
            </div>
            <div>
            <label><input type="checkbox" value="iOS">Sports</label>
            </div>
            <div>
              <label><input type="checkbox" value="Andriod">Travel</label>
            </div>
            <div>
              <label><input type="checkbox" value="Game">Movies</label>
            </div>
          </div>

          <div class="form-group right">
            <div>
              <label><input type="checkbox" value="Web">Music</label>
            </div>
            <div>
              <label><input type="checkbox" value="iOS">Sports</label>
            </div>
            <div>
              <label><input type="checkbox" value="Andriod">Travel</label>
            </div>
            <div>
              <label><input type="checkbox" value="Game">Movies</label>
            </div>
          </div>
        </div>


        </div>


      <!-- form-footer -->
      <div class="form-footer">
        <span>* required</span>
        <button type="submit" class="btn">Create</button>
      </div>

    </form>

    <!-- Script for range input label -->
    <script>
      var rangeLabel = document.getElementById("range-label");
      var experience = document.getElementById("experience");

      function change() {
      rangeLabel.innerText = experience.value + "K";
      }
    </script>

  </body>
</html>
