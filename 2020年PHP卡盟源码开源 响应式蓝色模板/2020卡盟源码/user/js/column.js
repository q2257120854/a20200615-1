function column(index){
  switch(index){
    case 1:{
	  parent.frames['ifrpage'].location.href='right.php';
      document.getElementById('head1').style.display = "";
      document.getElementById('head2').style.display = "none";
      document.getElementById('head3').style.display = "none";
      document.getElementById('menu1').style.display = "";
      document.getElementById('menu2').style.display = "none";
      document.getElementById('menu3').style.display = "none";
	  break;
    }
    case 2:{
	  parent.frames['ifrpage'].location.href='right2.php';
      document.getElementById('head1').style.display = "none";
      document.getElementById('head2').style.display = "";
      document.getElementById('head3').style.display = "none";
	  document.getElementById('menu1').style.display = "none";
      document.getElementById('menu2').style.display = "";
      document.getElementById('menu3').style.display = "none";
	  break;
    }
    case 3:{
	  parent.frames['ifrpage'].location.href='product/index.php';
      document.getElementById('head1').style.display = "none";
      document.getElementById('head2').style.display = "none";
      document.getElementById('head3').style.display = "";
	  document.getElementById('menu1').style.display = "none";
      document.getElementById('menu2').style.display = "none";
      document.getElementById('menu3').style.display = "";
	  break;
    }
  }
}