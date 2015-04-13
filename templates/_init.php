<?php
/**
 * _init.php - Initialize site variables and includes. 
 *
 * This file is called before any template files are rendered
 * This behavior was defined in /site/config.php - $config->prependTemplateFile
 *
 */

/*
 * Initialize some variables used by templates and populate default values.
 * These variables will ultimately be output in the _main.php file. 
 * The individual template files may choose to overwrite any of these. 
 *
 */
$tmplPath = $config->urls->templates;
$browserTitle = $page->get('browser_title|title');
$metaDescription = ($page->summary) ? $page->summary : $browserTitle;
$headline = $page->get('headline|title');
$content = ''; 
$homepage = $pages->get('/'); 

/*
 * Whether to include the _main.php markup file? For example, your template 
 * file would set it to false when generating a page for sitemap.xml 
 * or ajax output, in order to prevent display of the main <html> document.
 *
 */
$useMain = true; 

/*
 * Include any other shared functions we want to utilize in all our templates
 *
 */
require_once("./inc/functions.php");

