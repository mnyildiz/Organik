<?php 

	require_once('../Connections/Conn.php'); 


	if(!isset($_SESSION['UserID'])){
		yonlendir($AdminURL."login.php?girisyap=ok");	
		exit();
	} 
	
	$ACCESS = true; 
	require_once('inc/translations.php');
	
	$sayfa = "anasayfa";
	if (isset($_GET['sayfa'])) {
	  $sayfa = $_GET['sayfa'];
	}
	
	function sayfa($sayfa){
		global $AdminURL;
		return $AdminURL.'index.php?sayfa='.$sayfa;	
	}
	
	function yonlendir_($url){
		echo '<script>document.location = "'.$url.'";</script>';
		exit();	
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Yönetim Paneli</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('css_js/css.php'); ?>
</head>
<body class="sidebar-mini layout-fixed text-sm">
<div class="wrapper">
  <?php require_once('inc/header.php'); ?>
  <?php require_once('inc/sidebar.php'); ?>
        <?php require_once('pages/'.$sayfa.'.php'); ?>
	<?php require_once('inc/footer.php'); ?>
</div>
</body>
<?php require_once('css_js/js.php'); ?>
<script>
  $(function () {
	  $('.editor').summernote({
			callbacks: {
				onImageUpload: function(image) {
					editor = $(this);
					uploadImageContent(image[0], editor);
					}
			}
		});
		
    $('#dataTablo').DataTable({
		"order": [[ 0, "desc" ]],
		"language": {
            "url": "<?php echo $AdminURL ?>plugins/datatables/Turkish.json"
        },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
  function uploadImageContent(image, editor) {
		var data = new FormData();
		data.append("Resimmm", image);
		$.ajax({
			url: "<?php echo $AdminURL ?>inc/summernoteUpload.php",
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			type: "post",
			success: function(url) {
				var image = $("<img>").attr("src", url);
					$(editor).summernote("insertNode", image[0]);
				}
			});
		}
</script>
</html>
<?php unset($_SESSION['islemMesaj']);?>
