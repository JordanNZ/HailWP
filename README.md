# SPF Websites + Hail.to Wordpress Plugin Documentation

The documentation that will help you display content on your Wordpress site using some shortcodes which have been provided in this plugin.

## Getting Started

To get started all you need is a Wordpress install and the Hail.to Wordpress Connector

### Avaliable Short Codes


```
 [hail_content columns=2 display_hero=true orderby=date order=asc]
 [hail_page pid=aKrywI8 display_hero=true btn jsn=true]
 [hail_title pid=aKrywI8]
 [hail_lead pid=aKrywI8]
 [hail_hero pid=aKrywI8]
```

## Installing

### Via composer

1If you're using composer (https://roots.io/using-composer-with-wordpress/) then you can add the following requirement to your composer.json:
```json
"require": {
  "JordanNZ/Hail": "1.*"
}
```
The plugin isn't registered on the wordpress.org plugin repository (or wpackagist.org) so you also need to tell composer where to find the repository, by adding the following to your composer.json repositories section:
```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/JordanNZ/Hail"
  }
],
```

### Via zip file

You can install the plugin via .zip file available [here](https://github.com/JordanNZ/Hail/releases)


## Built With

* [Wordpress](https://wordpress.org) - The CMS Used.
* [hail.to](https://hail.to) - The CMS for the Content.
* [Hail WP](https://github.com/hail/hail-wordpress) - The Hail + Wordpress API Connector.


## Authors

* **SPF Websites** [SPF Websites](http://spf.nz)
* **Jordan Diamond** [SPF Websites](http://spf.nz)


