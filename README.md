#SAGE ProcessWire Site Profile
Port of the WP SAGE theme to ProcessWire

##What is this?
This site profile for the ProcessWire CMS/CMF is a port of the fabulous Wordpress theme [SAGE](https://roots.io/sage/)

It takes advantage of the build workflow of SAGE which utilizes gulp and bower to organize, build and load site assets.
It is a blank site profile and does not use any of the php templates of the original SAGE theme.
It comes with Bootstrap SASS version and fontawesome.

##Prerequisites
- [npm](https://www.npmjs.com/)
- [gulp](http://gulpjs.com/)
- [bower](http://bower.io/)

##How to install
**from zip:**
1. download the [zip](https://github.com/gebeer/site-pwsage/archive/master.zip)
2. extract the folder "site-pwsage" into a clean [ProcessWire](https://github.com/ryancramerdesign/ProcessWire) install's root folder
3. during install of ProcessWire choose the profile "Processwire SAGE Site Profile" 

**git clone:**
1. clone [ProcessWire](https://github.com/ryancramerdesign/ProcessWire) into your projects root folder
2. open a terminal in that root folder and execute `git clone https://github.com/gebeer/site-pwsage.git`
3. during install of ProcessWire choose the profile "Processwire SAGE Site Profile"

##Getting Started
After installation open ProcessWire's site/templates/ directory in a terminal and:
- execute `npm install` to install all requeired node modules
- execute `bower install` to install all bower components
- execute `gulp` to build your assets. They will be pusblished in site/templates/dist/

You should now see the site in a browser with all js and css applied.

##The gulp Magic
To have automated compilation of scss in the backgound and an updated browser window every time you change something in your code, execute `gulp watch` in a terminal.
To make the automated browser update work, you need to add the url of your development site in [templates/assets/manifest.json](https://github.com/gebeer/site-pwsage/blob/master/templates/assets/manifest.json#L28)

##Control Bootstrap Components
- in site/templates/assets/styles/common/_bootstrap-custom.scss you can control which Bootstrap CSS components get loaded. Just comment out the ones you don't need.
- in site/templates/bower.json in the section "overrides"->"bootstrap-sass-official" you can control which Bootstrap JS components get included. Just delete the ones you don't need (be careful not to have a comma after the last one in the list)

##Ready for Production?
Once your site is ready for production, execute `gulp --production`, go to site/config.php and change `$config->env = 'development';` to `$config->env = 'production';`

##Credits
This site profile was inspired by jlahijani's post ["How to Adapt WordPress Sage Starter Theme to ProcessWire (Video Tutorial)"](https://processwire.com/talk/topic/9624-how-to-adapt-wordpress-sage-starter-theme-to-processwire-video-tutorial/). I strongly recommend watching his tutorial video to get to know the development workflow.
And of course credits go to [SAGE](https://roots.io/sage/) for setting up this awesome workflow.

##Notes
As I personally prefer SASS over LESS, I removed all LESS specific files from the original SAGE theme. If need be, I can add a branch where they are included. Just drop me a line.
