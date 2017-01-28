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
    private $javascript_include = array();
    private $google_analytics = false;
    private $title = "";
    private $title_append = "";
    private $logo = "webroot/img/logo.jpg";
    private $charset = "'utf-8'";
    private $viewport = '<meta name = "viewport" content = "width=device-width, initial-scale=1" >';
    // Här kommer variablerna för sidinnehåll

    private $header = "";
    private $main = "";
    private $footer = "";
    private $side = array();

    public function __construct() {
        $this->set_property('favicon', 'favicon.ico');
    }

    public function js_include($script_path, $header = TRUE, $id = null) {

        switch ($header) {
            case TRUE:
                if (isset($id)) {
                    $this->javascript_include['header'][$id] = $script_path;
                } else {
                    $this->javascript_include['header'][] = $script_path;
                }
                break;
            case FALSE:
                if (isset($id)) {
                    $this->javascript_include['footer'][$id] = $script_path;
                } else {
                    $this->javascript_include['footer'][] = $script_path;
                }
                break;
            default :
                return false;
        }
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

    public function style() {
        return $this->style;
    }

    public function title() {
        return $this->title;
    }

    public function title_append() {
        return $this->title_append;
    }

    public function logo() {
        return $this->logo;
    }

    

    public function main() {
        return $this->main;
    }

    public function footer() {
        return $this->footer;
    }

    

    public function scripts_header() {
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
            $scripts_footer .= <<<EOD
                    <script>
                    var _gaq=[['_setAccount','$this->google_analytics'],['_trackPageview']];
                    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                    s.parentNode.insertBefore(g,s)}(document,'script'));
                    </script>

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
            case 'lang':
                $this->lang = $value;
                break;
            case 'favicon':
                $this->favicon = (file_exists($value) ? "<link rel='shortcut icon' href='favicon.ico'/>\n" : "");
                break;
            case 'style':
                $this->style[] = $value;
                break;
            case 'embed_style':
                $this->embed_style[] = $value;
                break;
            case 'title':
                $this->title = $value;
                break;
            case 'title_append':
                $this->title_append = $value;
                break;
            case 'logo':
                $this->logo = $value;
                break;
            case 'header':
                $this->header = $value;
                break;
            case 'main':
                $this->main = $value;
                break;
            case 'footer':
                $this->footer = $value;
                break;
            case 'side':
                $this->side = $value;
                break;
            case 'modernizr':
                $this->modernizr = $value;
                break;
                ;
            default:
                echo "Värdet finns inte {$property}";
        }
    }
public function header() {
        if (!$this->header) {
            $this->header = (empty($this->logo)) ? "" : "<img class='sitelogo left' src='{$this->logo}' alt=''/>\n";
            $this->header .= "<div class='sitetitle left'>$this->title</div>\n";
            $this->header .= "<div class='siteslogan left'>$this->title_append</div>\n";
        }
        return $this->header;
    }
    public static function menu($items) {
        CMenu::show($items);
    }

}
