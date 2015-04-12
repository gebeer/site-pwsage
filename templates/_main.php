<?php 

/**
 * This is the main markup file containing the container HTML that all pages are output in.
 *
 * The primary focus of this file is to output these variables (defined in _init.php) in the 
 * appropriate places:
 *
 * $headline - Text that goes in the primary <h1> headline
 * $browserTitle - The contents of the <title> tag
 * $body - Content that appears in the bodycopy area
 * $side - Additional content that appears in the sidebar
 *
 * Note: if a variable called $useMain is set to false, then _main.php does nothing.
 *
 */

// if any templates set $useMain to false, abort displaying this file
// an example of when you'd want to do this would be XML sitemap or AJAX page.
if(!$useMain) return;
/**********************************************************************************************/
?><!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />

	<title><?php echo $browserTitle; ?></title>

	<?php if($page->summary) echo "<meta name='description' content='$page->summary' />"; ?>
	<link href="<?php echo asset_path("styles/main.css"); ?>" media="screen, projection, print" rel="stylesheet" type="text/css" id="sage_css-css" />
</head>
<body class='<?php echo "template-{$page->template} section-{$page->rootParent->name} page-$page {$page->name}"; ?>'>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainnav">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?php echo $homepage->url ?>">pwsage</a>
		    </div>
		    <div class="collapse navbar-collapse navbar-left" id="mainnav">
			<?php echo renderChildrenOf($homepage->children); ?>
			</div>
		</div>
	</nav>

	<main class="main content container">
		<div class="row">

			<section class="col-sm-12">

				<?php echo $content; ?>

			</section>
		</div>


	</main><!--/#content-->

	<hr />

	<footer class="footer">
		<p class="col-sm-12">&copy; <?php echo date('Y'); ?> pwsage</p>
	</footer>
	<script type="text/javascript" src="<?php echo asset_path("scripts/modernizr.js");?>"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo asset_path("scripts/jquery.js"); ?>"><\/script>')</script>
	<script type="text/javascript" src="<?php echo asset_path("scripts/main.js");?>"></script>
</body>
</html>
