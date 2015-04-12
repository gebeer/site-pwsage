<?php

/*

Navigation for ProcessWire using the Bootstrap 2.3 markup

Altered by Philipp for usage with Bootstrap 3

This allows for endless sub-categories. However, this might not be a sensible use for touch devices and would be better to use just one level of dropdown. No alteration of this script is necessary, simply restrict the menu in the Pages section of the admin.

Note: The Top level item where they have children cannot be linked to a page. This is to allow "click to open" for touch devices. So you need to arrange your pages accordingly.

Bootstrap 3 - there is no guarantees that this will work in Bootstrap 3 (whenever that comes out) simply because they are considering scrapping sub menus.

This menu was written by Soma based on work by NetCarver and a very small bit thrown in by Joss

*** NOTES from Soma ***

 render markup menu for bootstrap nested navigation

 @param  PageArray  $pa     pages of the top level items
 @param  Page  $root   root page optional, if you use other root than home page (id:1)
 @param  string  $output for returned string collection
 @param  integer $level  internally used to count levels
 @return string          menu html string
*/

function renderChildrenOf($pa, $root = null, $output = '', $level = 0) {
    if(!$root) $root = wire("pages")->get(1);
    $output = '';
    $level++;
    foreach($pa as $child) {
        $atoggle = '';
        $class = '';
        $carret = '';
        $has_children = count($child->children) ? true : false;
 
        if($has_children && $child !== $root) {
            if($level == 1){
                $class .= 'dropdown'; // first level boostrap dropdown li class
                $carret = '<b class="caret"></b>';
                $atoggle .= ' class="dropdown-toggle" data-toggle="dropdown"'; // first level anchor attributes
            } else {
                $class .= 'dropdown-submenu'; // sub level boostrap dropdown li class
            }
        }
 
        // make the current page and only its first level parent have an active class
        if($child === wire("page")){
            $class .= ' active';
        } else if($level == 1 && $child !== $root){
            if($child === wire("page")->rootParent || wire("page")->parents->has($child)){
                $class .= ' active';
            }
        }
 
        $class = strlen($class) ? " class='".trim($class)."'" : '';
 
        $output .= "<li$class><a href='$child->url'$atoggle>$child->title$carret</a>";
 
        // If this child is itself a parent and not the root page, then render its children in their own menu too...
        if($has_children && $child !== $root) {
            $output .= renderChildrenOf($child->children, $root, $output, $level);
        }
        $output .= '</li>';
    }
    $outerclass = ($level == 1) ? "nav navbar-nav" : 'dropdown-menu';
    return "<ul class='$outerclass'>$output</ul>";
}
 
// bundle up the first level pages and prepend the root home page
//$root = $pages->get(1);
//$pa = $root->children;
 
// Set the ball rolling...
//echo renderChildrenOf($pa); 

/*render a Bootstrap 3 accordion from a PW PageArray
variables passed to this function
$pages: PageArray the children of which will be rendered into an accordion
$title: string, name of the field to be used as panel title, eg "title"
$content: string, name of the field to be used as panel content, eg "bodycopy"
$accordion = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
*/
function bs3AccordionMarkup($pages, $titlefield, $contentfield) {

    $accordion = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";

    $i = 1;
    foreach ($pages as $child) {
        $in = ($i == 1) ? " in" : "";
        $collapsed = ($i != 1) ? " class='collapsed'" : "";
        $accordion .= "  <div class='panel panel-default'>
        <div class='panel-heading' role='tab' id='heading$i'>
          <h3 class='panel-title'>
            <a$collapsed data-toggle='collapse' data-parent='#accordion' href='#collapse$i' aria-expanded='true' aria-controls='collapse$i'>
              {$child->$titlefield}
            </a>
          </h3>
        </div>
        <div id='collapse$i' class='panel-collapse collapse$in' role='tabpanel' aria-labelledby='heading$i'>
          <div class='panel-body'>
          {$child->$contentfield}
          </div>
        </div>
      </div>";
      $i++;
    }

    $accordion .= "</div>";
    return $accordion;
}

/*renders markup for a Bootstrap 3 Carousel from a ProcessWire images array
$images: ProcessWire images array
*/
function bsCarouselMarkup($images) {
    $carouselId = $images->get('page').$images->get('field')->id;
    $carouselMarkup = "<div id='carousel-$carouselId' class='carousel slide' data-ride='carousel'>
    <ol class='carousel-indicators'>";
    $i = 0;
    foreach ($images as $image) :
        $class = ($i == 0) ? " class='active'" : "";
        $carouselMarkup .= "<li data-target='#carousel-$carouselId' data-slide-to='$i'$class ></li>";
        $i++;
    endforeach;
    $carouselMarkup .= "</ol>
    <div class='carousel-inner'>";
    $i = 0;
    foreach ($images as $image) :
        $class = ($i == 0) ? "active" : "";
        $carouselMarkup .= "<div class='item $class'>
          <img src='$image->url' alt='$image->description' width='$image->width' height ='$image->height'>
          <div class='carousel-caption'>
            <p>$image->description</p>
          </div>
        </div>";
        $i++;
    endforeach;
    $carouselMarkup .= "</div>";

    $carouselMarkup .= "<a class='left carousel-control' href='#carousel-$carouselId' data-slide='prev'>
    <span class='fa fa-chevron-left'></span>
    </a>
    <a class='right carousel-control' href='#carousel-$carouselId' data-slide='next'>
    <span class='fa fa-chevron-right'></span>
    </a>
    </div>";
    return $carouselMarkup;
}
