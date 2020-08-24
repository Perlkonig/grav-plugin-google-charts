# Google Charts Plugin

The **Google Charts** Plugin is for [Grav CMS](http://github.com/getgrav/grav). It allows you to embed [Google charts](https://developers.google.com/chart/) into pages via shortcode. It supports 19 of the 27 currently available charts. 

  * [Area](https://developers.google.com/chart/interactive/docs/gallery/areachart)
  * [Bar](https://developers.google.com/chart/interactive/docs/gallery/barchart)
  * [Bubble](https://developers.google.com/chart/interactive/docs/gallery/bubblechart)
  * [Candlestick](https://developers.google.com/chart/interactive/docs/gallery/candlestickchart)
  * [Column](https://developers.google.com/chart/interactive/docs/gallery/columnchart)
  * [Combo](https://developers.google.com/chart/interactive/docs/gallery/combochart)
  * [Donut](https://developers.google.com/chart/interactive/docs/gallery/piechart#donut)
  * [Gauge](https://developers.google.com/chart/interactive/docs/gallery/gauge)
  * [GeoCharts](https://developers.google.com/chart/interactive/docs/gallery/geochart)
  * [Histogram](https://developers.google.com/chart/interactive/docs/gallery/histogram)
  * [Line](https://developers.google.com/chart/interactive/docs/gallery/linechart)
  * [Maps](https://developers.google.com/chart/interactive/docs/gallery/map)
  * [Pie](https://developers.google.com/chart/interactive/docs/gallery/piechart)
  * [Scatter](https://developers.google.com/chart/interactive/docs/gallery/scatterchart)
  * [Stepped Area](https://developers.google.com/chart/interactive/docs/gallery/steppedareachart)
  * [Timelines](https://developers.google.com/chart/interactive/docs/gallery/timeline)
  * [Tree Map](https://developers.google.com/chart/interactive/docs/gallery/treemap)
  * [Waterfall](https://developers.google.com/chart/interactive/docs/gallery/candlestickchart#Waterfall)
  * [Word Trees](https://developers.google.com/chart/interactive/docs/gallery/wordtree)

## Installation

Installing the Google Charts plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install google-charts

This will install the Google Charts plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/google-charts`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `google-charts`. You can find these files on [GitHub](https://github.com/aaron-dalton/grav-plugin-google-charts) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/google-charts
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error), [Problems](https://github.com/getgrav/grav-plugin-problems) and [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) plugins to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/google-charts/google-charts.yaml` to `user/config/plugins/google-charts.yaml` and only edit that copy.

There is only one configuration option: `enabled`. This is how you disable the shortcode entirely. See the documentation for the [Shortcode Core plugin](https://github.com/getgrav/grav-plugin-shortcode-core) for information on how to enable/disable shortcodes on a page-by-page basis.

## Usage

### Shortcode

Charts are inserted via the `[gchart]` shortcode, which has the following options:

  * `type` (required): This determines the type of chart you wish to draw. It must be one of the following:
    - area
    - bar
    - bar-material
    - bubble
    - candlestick 
    - column
    - column-materi
    - combo
    - donut
    - gauge
    - geochart
    - histogram
    - line
    - line-material
    - map
    - pie
    - scatter
    - scatter-mater
    - stepped
    - treemap
    - waterfall
    - wordtree    

  * `id` (required): The id can only consist of upper- and lowercase letters, digits, and the underscore. The id is used both as the `id` attribute of the final `<div>` tag and as part of the function names in the JavaScript code.

  * `class` (optional): If provided, the value will be passed through PHP's `htmlspecialchars` and inserted into the `class` attribute of the final `<div>` tag.

  * `data` (optional): Links to where in the page header the chart data can be found (see "Data" section below).

  * `options` (optional): Links to where in the page header the chart options can be found (see "Data" section below).

Normally the shortcode is self-closing (i.e. `[gchart /]`), but see the "Data" section below for exceptions.

### Data

This plugin supports charts whose data are passed via `google.visualization.arrayToDataTable` and whose options can be expressed as simple JSON objects. There are two ways to pass this information to the shortcode: via the page header or via the shortcode itself.

#### Page Header

##### Default

If the shortcode options `data` or `options` are not provided, then by default the plugin looks for the following in the parsed front matter of the page: `page.header.google-charts.ID.data/options`, where `ID` is the `id` given in the shortcode. `data` must be an array and `options` must be an object. For example, the following shortcode would require something like the following front matter:

`[gchart type=bubble id=test /]`

```yaml
google-charts: 
  test: 
    data: 
      - 
        - ID
        - "Life Expectancy"
        - "Fertility Rate"
        - Region
        - Population
      - 
        - CAN
        - 80.66
        - 1.67
        - "North America"
        - 33739900
      - 
        - DEU
        - 79.84
        - 1.36
        - Europe
        - 81902307
      - 
        - DNK
        - 78.6
        - 1.84
        - Europe
        - 5523095
      - 
        - EGY
        - 72.73
        - 2.78
        - "Middle East"
        - 79716203
      - 
        - GBR
        - 80.05
        - 2
        - Europe
        - 61801570
      - 
        - IRN
        - 72.49
        - 1.7
        - "Middle East"
        - 73137148
      - 
        - IRQ
        - 68.09
        - 4.77
        - "Middle East"
        - 31090763
      - 
        - ISR
        - 81.55
        - 2.96
        - "Middle East"
        - 7485600
      - 
        - RUS
        - 68.6
        - 1.54
        - Europe
        - 141850000
      - 
        - USA
        - 78.09
        - 2.05
        - "North America"
        - 307007000
    options: 
      bubble: 
        textStyle: 
          fontSize: 11
      hAxis: 
        title: "Life Expectancy"
      title: "Correlation between life expectancy, fertility rate and population of some world countries (2010)"
      vAxis: 
        title: "Fertility Rate"
```

##### Custom

You can also use the [Import plugin](https://github.com/Deester4x4jr/grav-plugin-import) to load YAML and JSON files into your page header. If you do this, you need to tell the plugin where to find the data. You do this by passing dot notation via the shortcode pointing to where in the page header the data lives.

Let's say you had the following in your front matter:

```yaml
imports:
  - data.yaml
  - options.yaml
```

You would need to pass the following options to the shortcode: `data="imports.data"` and `options="imports.options"`.

#### Shortcode Content

You can also pass the information within the shortcode itself. To do this, between the opening and closing `[gchart]` tags, insert a valid JSON string representing an object with the `data` property and an optional `options` property. Those will be used to render the chart.

##### IMPORTANT NOTE

In Grav, markdown is processed before shortcodes. This means that the included JSON string has to follow three rules to ensure it will survive the initial processing:

1. The opening brace of the JSON string must occur on the same line as the opening `[gchart]` tag.
2. The closing brace of the JSON string must occur on the same line as the closing `[/gchart]` tag.
3. The JSON string itself can contain no blank lines.

```
[gchart type=donut id=test]{
    "data": [
        ["Task", "Hours per Day"],
        ["Work", 11],
        ["Eat", 2],
        ["Commute", 2],
        ["Watch TV", 2],
        ["Sleep", 7]
    ],
    "options": {
        "title": "My Daily Activities",
        "pieHole": 0.4
    }
}[/gchart]
```

### Errors

The plugin tries to catch common errors. When an expected error occurs, a (hopefully) helpful error messages is outputted in place of the shortcode. If the shortcode comes through verbatim, then something is probably wrong with the plugin (or Grav) more generally. Runtime exceptions should be rare and will usually be caused by something very weird in your data.

### Examples

[A demo of the plugin is available on my website.](https://perlkonig.com/demos/google-charts) You can view the source code to see how the front matter and shortcodes look.

Here are some example shortcodes:

  * Minimal example; assumes the data and options can be found in the front matter under `google-charts`

    `[gchart type=bubble id=test/]`

  * Points to files loaded by the Import plugin: `data.yaml` and `options.yaml`

    `[gchart type=bar-material data="imports.data" options="imports.options"/]`

  * JSON data is passed within the shortcode; also applies a `class` attribute to the `<div>` tag

    ```
    [gchart type=donut id=test3 class="left"]{
        "data": [
            ["Task", "Hours per Day"],
            ["Work", 11],
            ["Eat", 2],
            ["Commute", 2],
            ["Watch TV", 2],
            ["Sleep", 7]
        ],
        "options": {
            "title": "My Daily Activities",
            "pieHole": 0.4
        }
    }[/gchart]
    ```

## Caveats

I have not been able to test every single supported chart type in every possible circumstance. Bug reports are warmly welcomed. But before submitting an issue, double check that the data you're passing is well formed. I use (but do not endorse) the following tools:

  * [JSONLint](http://jsonlint.com/)
  * [YAML Lint](http://www.yamllint.com/)
  * [JSON to YAML](http://www.json2yaml.com/) (to convert JSON data into something I can paste into the front matter of my page)

I will endeavour to support additional chart types over time.


