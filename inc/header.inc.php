<!DOCTYPE html>
<html lang="en">
<head>
 <title><?php echo $pagetitle; ?></title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
.search {
  position: relative;
  color: #aaa;
  font-size: 16px;
}

.search input {
  width: 250px;
  height: 32px;

  background: #fcfcfc;
  border: 1px solid #aaa;
  border-radius: 5px;
  box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb inset;
}

.search input { text-indent: 32px;}
.search .fa-search { 
  position: absolute;
  top: 10px;
  left: 10px;
}

.carousel-inner > .item > img { width:100%; height:600px;}
/*.indexContainer { margin-top: -20px;}*/
.container {margin-top:55px;}

#my_table {
 width: 100%;
}

#my_table_head > .row {
 margin-top:20px;
 font-weight:bold;
 font-size:16px;
 border-bottom: 2px solid #e2e2d0;
 padding: 5px;
}

#cat_list > .row {
 border-bottom: 1px solid #e2e2d0;
 padding: 5px 0;
}

</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

function searchInTable(col_name,col_nr) {
  var input, filter, table, tr, td, i;
  input = document.getElementById(col_name);
  filter = input.value.toUpperCase();
  list = document.getElementById("cat_list");
  tr = list.getElementsByClassName("row");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("div")[col_nr];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


function setActive() {
  liObj = document.getElementById('nav').getElementsByTagName('li');
  for(i=0;i<liObj.length;i++) {
    aObj = liObj[i].getElementsByTagName('a');
    if(document.location.href.indexOf(aObj[0].href)>=0) {
      liObj[i].className='active';
    }
  }
}

window.onload = setActive;

</script>
</head>
<body>

