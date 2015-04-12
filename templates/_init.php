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

class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename) {
  $dist_path = wire('config')->urls->templates . wire('config')->distDir;
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = wire('config')->paths->templates . wire('config')->distDir . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (wire('config')->env !== 'development' && array_key_exists($file, $manifest->get())) {
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}
