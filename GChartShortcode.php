<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class GChartShortcode extends Shortcode
{
    protected $supported = [
        'area' => ['package' => 'corechart', 'visname' => 'AreaChart'], 
        'bar' => ['package' => 'corechart', 'visname' => 'BarChart'], 
        'bar-material' => ['package' => 'bar', 'visname' => 'Bar'],
        'bubble' => ['package' => 'corechart', 'visname' => 'BubbleChart'], 
        'candlestick' => ['package' => 'corechart', 'visname' => 'CandlestickChart'], 
        'column' => ['package' => 'corechart', 'visname' => 'ColumnChart'], 
        'column-material' => ['package' => 'bar', 'visname' => 'Bar'],
        'combo' => ['package' => 'corechart', 'visname' => 'ComboChart'], 
        'donut' => ['package' => 'corechart', 'visname' => 'PieChart'], 
        'gauge' => ['package' => 'gauge', 'visname' => 'Gauge'], 
        'geochart' => ['package' => 'geochart', 'visname' => 'GeoChart'], 
        'histogram' => ['package' => 'corechart', 'visname' => 'Histogram'], 
        'line' => ['package' => 'corechart', 'visname' => 'LineChart'], 
        'line-material' => ['package' => 'line', 'visname' => 'Line'],
        'map' => ['package' => 'map', 'visname' => 'Map'], 
        'pie' => ['package' => 'corechart', 'visname' => 'PieChart'], 
        'scatter' => ['package' => 'corechart', 'visname' => 'ScatterChart'], 
        'scatter-material' => ['package' => 'scatter', 'visname' => 'Scatter'],
        'stepped' => ['package' => 'corechart', 'visname' => 'SteppedAreaChart'], 
        'timeline' => ['package' => 'timeline', 'visname' => 'Timeline'], 
        'treemap' => ['package' => 'treemap', 'visname' => 'TreeMap'], 
        'waterfall' => ['package' => 'corechart', 'visname' => 'CandlestickChart'], 
        'wordtree' => ['package' => 'wordtree', 'visname' => 'WordTree'],
    ];

    public function init()
    {
        $this->shortcode->getHandlers()->add('gchart', array($this, 'process'));
    }

    public function process(ShortcodeInterface $sc) {
        // Get page header
        $header = $this->shortcode->getPage()->header();
        $header = new \Grav\Common\Page\Header((array) $header);

    	// Load overall Google Charts library
    	$this->shortcode->addAssets('js', 'https://www.gstatic.com/charts/loader.js');

    	// Get parameters
        $id = $sc->getParameter('id', null);
        if ($id === null) {
            return '<p>Google Charts: You must provide a unique ID for this chart.</p>';
        }
        $id = static::sanitize($id);
        if (strlen($id) < 1) {
            return '<p>Google Charts: You must provide a valid ID for this chart (only letters, digits, and underscores).</p>';
        }
        $type = $sc->getParameter('type', null);
        if ( ($type === null) || (! array_key_exists($type, $this->supported)) ) {
            return '<p>Google Charts: You either didn\'t provide a type or the type you provided is not supported. Please review the documentation.</p>';
        }
        $class = $sc->getParameter('class', null);
        $data = $sc->getParameter('data', null);
        $options = $sc->getParameter('options', null);
        $contents = $sc->getContent();

        // If there are contents, break that out before proceeding
        $datastr = null;
        $optionstr = null;
        if ( ($contents !== null) && (strlen($contents) > 0) ) {
            $decoded = json_decode($contents);
            if ($decoded !== null) {
                // return '<pre>'.json_encode($decoded, JSON_PRETTY_PRINT).'</pre>';
                if (property_exists($decoded, 'data')) {
                    $datastr = json_encode($decoded->data);
                }
                if (property_exists($decoded, 'options')) {
                    $optionstr = json_encode($decoded->options);
                }
            } else {
                return "<p>Google Charts: Could not interpret the enclosed JSON. Please read the documentation for important caveats.</p>";
            }
        }

        // Data first
        $d = null;
        //   Use JSON string if provided first
        if ($datastr !== null) {
            $d = $datastr;
        //   Otherwise follow data param and look for page.header.[data]
        } elseif ($data !== null) {
            $d = json_encode($header->get($data));
        //   Finally, look for page.header['google-charts'].[id].data
        } else {
            $d = json_encode($header->get('google-charts.' . $id . '.data'));
        }
        if ($d === null) {
            return '<p>Google Charts: Could not find valid data.</p>';
        }

        // Options next
        $o = null;
        //   Use JSON string if provided first
        if ($optionstr !== null) {
            $o = $optionstr;
        //   Otherwise follow data param and look for page.header.[data]
        } elseif ($options !== null) {
            $o = json_encode($header->get($options));
        //   Finally, look for page.header['google-charts'].[id].data
        } else {
            $o = json_encode($header->get('google-charts.' . $id . '.options'));
        }
        // It's ok if there are no options given.

        // Build the inline script
        $code = [];

        $code[] = "google.charts.load('current', {'packages': ['".$this->supported[$type]['package']."']});";
        $code[] = "google.charts.setOnLoadCallback(draw_".$id.");";
        $code[] = "function draw_".$id."() {";
        $code[] = "var data = google.visualization.arrayToDataTable(".$d.");";
        if ($o !== null) {
            $code[] = "var options = ".$o.";";
        } else {
            $code[] = "var options = null;";
        }
        $code[] = "var chart = new google.visualization.".$this->supported[$type]['visname']."(document.getElementById('".$id."'));";
        $code[] = "chart.draw(data, options);";
        $code[] = "}";

        // Inject the script
        $code = implode("\n", $code);
        //$this->grav['assets']->addInlineJs($code);

        // Inject the <div> tag
        $output = '<div id="'.$id.'"';
        if ($class !== null) {
            $output .= ' class="'.htmlspecialchars($class).'"';
        }
        $output .= '></div>';
        return $output . "<script>$code</script>";
    }

    private static function sanitize($str) {
        $pattern = '/[^a-zA-Z0-9_]/';
        return preg_replace($pattern, '', (string) $str);
    }
}
