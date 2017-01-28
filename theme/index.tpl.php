<!DOCTYPE html>
<html class='no-js' <?=$this->lang() ?>>
    <head>
        <meta charset="<?=$tango->charset()"/>
        <?=$tango->viewport()?>
        <?=$tango->title()?'> 
        <?=$tango->favicon()?> 
        <?=$tango->stylesheet()?>
        <?=$tango->script_header()?'> 
    </head>
    <body>
        <div id='wrapper'>
            <div id='header'>
                <?=$tango->header()?>
                <?=$tango->menu($main_menu) ?>
            </div><!-- header -->
            <div id='main'>
                <div id='content'>
                    <?=$tango->content()?>
                </div> <!-- content -->
                <footer id='footer'>
                    <?=$tango->footer()?>
                </footer>
            </div><!-- main -->
            <?= $tango->scripts_footer(); ?>
        </div> <!-- wrapper -->
    </body>
</html>