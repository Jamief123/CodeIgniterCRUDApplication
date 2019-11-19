<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->helper('url'); 
	$cssbase = base_url()."assets/css/";
	$jsbase = base_url()."assets/js/";
	$img_base = base_url()."assets/images/";
	$base = base_url() . index_page();
?>

<!DOCTYPE>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Books</title>
<link href="<?php echo $cssbase . "style.css"?>" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo $jsbase."common.js"?>"></script>
</head>

<body>
<header>
	<img class="center-image" src="<?php echo $img_base . "site/LIT_Logo.png"?>" />
    <?= anchor('TitleController/index', 'Home', 'title="Home"'); ?>
	&nbsp;&nbsp;&nbsp;
	<?= anchor('TitleController/handleInsert', 'Insert', 'title="Insert"'); ?>
    &nbsp;&nbsp;&nbsp;
	<?= anchor('TitleController/listTitles', 'List', 'title="List"'); ?>
</header>
