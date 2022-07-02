TwigBemBundle
======================
This symfony bundle provides BEM helper functions to use in twig template.

Installation
------------
Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require mothership-gmbh/twig-bem-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mothership-gmbh/twig-bem-bundle
```

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Mothership\TwigBemBundle\TwigBemBundle::class => ['all' => true],
];
```

Usage
-----

### bemBlock(blockName, modifiers = [])
Use it like this: `<div class="{{ bemBlock('myBlock') }}"></div>`

Parameters:
- *blockName*: String
- *modifiers*: (optional) String[]

### bemElem(elementName, modifiers = [])
This function can only be used if there is a `bemBlock` defined in the parent tree.
Use it like this: `<div class="{{ bemElem('myElement') }}"></div>`


Parameters:
- *elementName*: String
- *modifiers*: (optional) String[]

## Example
```html
{% block body %}
    <div class="{{ bemBlock('listing') }}">
        <div class="{{ bemElem('pagination') }}"></div>
        <div class="{{ bemBlock('product') }}">
            <div class="{{ bemElem('title') }}"></div>
        </div>
        <div class="{{ bemBlock('product', ['active', 'sale']) }}">
            <div class="{{ bemElem('title', ['bold']) }}"></div>
        </div>
    </div>
{% endblock %}
```
This will be the corresponding output/markup:
```html
<div class="listing">
    <div class="listing__pagination"></div>
    <div class="product">
        <div class="product__title"></div>
    </div>
    <div class="product product--active product--sale">
        <div class="product__title product__title--bold"></div>
    </div>
</div>
```