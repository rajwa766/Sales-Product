<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $sourcePath = '@web';
    public $baseUrl = '@web';
    public $css = [//'css/site.css',
        'css/pace-theme-flash.css',
        'css/bootstrap-theme.min.css',
        'css/bootstrap.min.css',
 'css/style.css',
 'css/responsive.css',
  'css/animate.min.css',
        'fonts/font-awesome/css/font-awesome.css',
        'css/animate.min.css',
        'css/perfect-scrollbar.css',
        'css/morris.css',
        'css/jquery-ui.min.css',
        'css/graph.css',
        'css/detail.css',
        'css/legend.css',
        'css/extensions.css',
        'css/rickshaw.min.css',
        'css/lines.css',
        'css/jquery-jvectormap-2.0.1.css',
        'css/white.css',
        'css/morris.css',
        'css/jquery-ui.min.css',
        'css/graph.css',
        'css/detail.css',
        'css/legend.css',
        'css/extensions.css',
        'css/rickshaw.min.cs',
        'css/lines.css',
        'css/jquery-jvectormap-2.0.1.css',
          'css/white.css',

    ];
    public $js = [
        'js/jquery-1.11.2.min.js',
        'js/jquery.easing.min.js',
        'js/bootstrap.min.js',
        'js/pace.min.js',
        'js/perfect-scrollbar.min.js',
        'js/viewportchecker.js',
        'js/d3.v3.js',
        'js/jquery-ui.min.js',
        'js/Rickshaw.All.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.easypiechart.min.js',
        'js/raphael-min.js',
        // 'js/morris.min.js',
        'js/jquery-jvectormap-2.0.1.min.js',
        'js/jquery-jvectormap-world-mill-en.js',
        'js/gauge.min.js',
        'js/icheck.min.js',
        // 'js/dashboard.js',
        'js/scripts.js',
        'js/jquery.sparkline.min.js',
        'js/chart-sparkline.js'

        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
        public $jsOptions = array(
    'position' => \yii\web\View::POS_HEAD
);
}
