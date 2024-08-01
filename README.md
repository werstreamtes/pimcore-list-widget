# Pimcore List Widget

<!-- TOC -->
* [Pimcore List Widget](#pimcore-list-widget)
  * [Requirements](#requirements)
  * [Installation](#installation)
  * [Good to know](#good-to-know)
  * [Further Information](#further-information)
<!-- TOC -->

### Requirements
This widget is designed for use with Pimcore 10.2 or higher.

### Installation
Install the widget using composer:

```shell
composer require werstreamtes/pimcore-list-widget
```

or via composer.json:
```json
"require" : {
    "werstreamtes/pimcore-list-widget" : "1.0.0",
}
```

Activate the widget with the following command:

### Pimcore 10
```shell
bin/console pimcore:bundle:enable WerStreamtEsListWidgetBundle
```

### Pimcore 11
```shell
bin/console pimcore:bundle:install WerStreamtEsListWidgetBundle
```

Finally, the plugin must be registered in the `registerBundlesToCollection` function in the `App/Kernel.php` file
```
$collection->addBundle(WerStreamtEsListWidgetBundle::class);
```

### Good to know

If you are part of the WerStreamt.es partner program, you can save your tag in the website settings.

Go to the website settings and create a new entry with the key `wseWidgetTag` of type `Text`. You can fill this with your partner tag.

![General Settings](settings.gif)

### How to style the Widget

There are some basic classes for styling the widget.

The color of the shade used for fading can be overwritten with the following variable:
```css
.wse-widget {
    --shadow-color: #fff;
}
```

**Please note:** The shade also exists in dark mode and can be overwritten with the following code:
```css
@media (prefers-color-scheme: dark) {
    .wse-widget {
        --shadow-color: #000;
    }
}
```

The color of the arrows can be adjusted with the following code:
```css
.wse-arrow-fill {
  fill: #ffffff;
}
```

The color of the numbering can be adjusted with the following code:
```css
.wse-numeric .wse-elements li.wse-element:before {
  color: #d90000;
}
```

### Further Information

* [WerStreamt.es Developer Widget Documentation](https://www.werstreamt.es/developers/widget/)

Feel free to reach out if you have any questions or issues!