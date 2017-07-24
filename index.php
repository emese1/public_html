
<?php
 $pagetitle = "Welcome to pets.com";
 include 'inc/header.inc.php';
 include 'inc/nav_menu.inc.php';
?>


<div class="container text-center indexContainer">

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
   
   <!-- Wrapper for slides -->
   <div class="carousel-inner">
     <div class="item active">
      <img  src="img/cat1.jpg" alt="Cat">
     </div>

     <div class="item">
      <img  src="img/cat2.jpg" alt="Cat">
     </div>

     <div class="item">
      <img  src="img/cat3.jpeg" alt="Cat">
     </div>

     <div class="item">
      <img  src="img/cat4.jpg" alt="Cat">
     </div>

     <div class="item">
      <img  src="img/cat5.jpg" alt="Cat">
     </div>

     <div class="item">
      <img  src="img/cat6.jpg" alt="Cat">
     </div>


   </div>
 
   <!-- Left and right controls -->
   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
   </a>

 </div>

 <h1>Welcome to pets site!</h1>
 
</div>

<?php
 include 'inc/footer.inc.php';
?>

