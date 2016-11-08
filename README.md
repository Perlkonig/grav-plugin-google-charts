# Google Charts Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of this plugin.**

https://developers.google.com/chart/

https://developers.google.com/chart/interactive/docs/basic_load_libs

Supported:
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
  * [Tree Map](https://developers.google.com/chart/interactive/docs/gallery/treemap)
  * [Waterfall](https://developers.google.com/chart/interactive/docs/gallery/candlestickchart#Waterfall)
  * [Word Trees](https://developers.google.com/chart/interactive/docs/gallery/wordtree)

The **Google Charts** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Embeds Google charts into pages

[gchart id= type= data= options= data_str= options_str= /]

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
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/google-charts/google-charts.yaml` to `user/config/plugins/google-charts.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

**Describe how to use the plugin.**

## Credits

**Did you incorporate third-party code? Want to thank somebody?**

## To Do

- [ ] Future plans, if any

