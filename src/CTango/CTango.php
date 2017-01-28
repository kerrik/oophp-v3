<?php

/**
 *
 * Skapar tangoobjektet
 *
 */
class CTango {

    // Först lite settings för hela <head>
    private $head = [];
    private $lang = "sv";
    private $favicon = "";
    private $style = [];
    private $embed_style = "";
    private $script = [];
    private $google_analytics = false;
    private $title = "";
    private $title_append = "";
    private $logo = "webroot/img/logo.jpg";
    private $charset = "'utf-8'";
    private $viewport = '<meta name = "viewport" content = "width=device-width, initial-scale=1" >';
    // Här kommer variablerna för sidinnehåll

    private $header = "";
    private $content = "";
    private $footer = "";
    private $side = array();

    public function __construct() {
        $this->set_property('favicon', 'favicon.ico');
    }

    
public function set_lang($lang) {
        $this->lang=$lang;
    }
    public function lang() {
        return $this->lang;
    }

    public function set_favicon($favicon) {
        $this->favicon = (file_exists($favicon) ? "<link rel='shortcut icon' href='favicon.ico'/>\n" : "");
               
    }
    public function favicon() {
        return $this->favicon;
    }
public function set_title($title) {
         $this->title = $title;
    }

    public function title() {
        return $this->title;
    }
public function set_title_append($title_append) {
       $this->title_append = $title_append;
    }
    public function title_append() {
        return $this->title_append;
    }

     public function set_logo($logo) {
         $this->logo = (file_exists($logo) ? "<link rel='shortcut icon' href='favicon.ico'/>\n" : "");
       }
    public function logo() {
        return $this->logo;
    }

    public function set_content($content) {
        $this->content .=$content;
    }

    public function main() {
        return $this->main;
    }
    public function set_header($header) {
        $this->header=$header;
    }
    public function header() {
        if (!$this->header) {
            $this->header = (empty($this->logo)) ? "" : "<img class='sitelogo left' src='{$this->logo}' alt=''/>\n";
            $this->header .= "<div class='sitetitle left'>$this->title</div>\n";
            $this->header .= "<div class='siteslogan left'>$this->title_append</div>\n";
        }
        return $this->header;
    }

    public function footer() {
        return $this->footer;
    }

    public function set_script($script_path, $header = TRUE, $id = null) {

        switch ($header) {
            case TRUE:
                if (isset($id)) {
                    $this->script['header'][$id] = $script_path;
                } else {
                    $this->script['header'][] = $script_path;
                }
                break;
            case FALSE:
                if (isset($id)) {
                    $this->script['footer'][$id] = $script_path;
                } else {
                    $this->script['footer'][] = $script_path;
                }
                break;
            default :
                return false;
        }
    }

    public function scripts_head() {
        $scripts_header = '';
        if (isset($this->javascript_include['header'])) {
            foreach ($this->javascript_include['header'] as $val) {
                $scripts_header .= "<script src='$val'></script>\n";
            }
        }
        return $scripts_header;
    }

    public function scripts_footer() {
        $scripts_footer = '';
        if (isset($this->javascript_include['footer'])) {
            foreach ($this->javascript_include['footer'] as $val) {
                $scripts_footer .= "<script src='$val'></script>\n";
            }
        }
        if ($this->google_analytics) {
            $scripts_footer .= "<script>\n";
            $scripts_footer .= "var _gaq=[['_setAccount','{$this->google_analytics}'],['_trackPageview']];n";
            $scripts_footer .= "(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
            $scripts_footer .= "g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
            $scripts_footer .= "s.parentNode.insertBefore(g,s)}(document,'script'))\n";
            $scripts_footer .= "</script>\n";

EOD
            ; // endif
        }
        return $scripts_footer;
    }

    public function main_content($content) {
        $this->main .= $content;
    }

    public function content($content) {
        $this->main .= $content;
    }

    public function set_property($property, $value) {
        switch ($property) {
           
            case 'embed_style':
                $this->embed_style[] = $value;
                break;
            case 'footer':
                $this->footer = $value;
                break;
            case 'side':
                $this->side = $value;
                break;
                ;
            default:
                echo "Värdet finns inte {$property}";
        }
    }

    public static function menu($items) {
        CMenu::show($items);
    }

}
