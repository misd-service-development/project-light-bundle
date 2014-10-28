ProjectLightBundle
==================

Adds the University of Cambridge's house style to your Symfony2 application.

Authors
-------

* Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>

Installation
------------

 1. Add the ProjectLightBundle to your dependencies:

        // composer.json

        {
           // ...
           "require": {
               // ...
               "misd/project-light-bundle": "~1.0@dev"
           }
        }

 2. Use Composer to download and install the ProjectLightBundle:

        $ php composer.phar update misd/project-light-bundle

 3. Register the bundle in your application:

        // app/AppKernel.php

        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Misd\ProjectLightBundle\ProjectLightBundle()
            );
        }

Project Light assets
--------------------

The bundle contains all of the Project Light assets (stylesheet, JavaScript and images).

Base template
-------------

Either extend the base template:

    {% extends 'ProjectLightBundle::base.html.twig' %}

Or one of the themes:

    {% extends 'ProjectLightBundle::theme_blue.html.twig' %}
    {% extends 'ProjectLightBundle::theme_green.html.twig' %}
    {% extends 'ProjectLightBundle::theme_grey.html.twig' %}
    {% extends 'ProjectLightBundle::theme_orange.html.twig' %}
    {% extends 'ProjectLightBundle::theme_purple.html.twig' %}
    {% extends 'ProjectLightBundle::theme_red.html.twig' %}
    {% extends 'ProjectLightBundle::theme_turquoise.html.twig' %}

### `title`

The HTML `<title>` can be set in the `title` block. This is blank by default.

Example:

    {% block title %}My title{% endblock %}

### `stylesheets`

Local stylesheets can be included in the `stylesheets` block.

Example:

    {% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('path/to/my/stylesheet.css') }}">
    {% endblock %}

### `theme`

If not extending one of the specific theme templates, you can set it in the `theme` block.

Example:

    {% block theme %}campl-theme-3{% endblock %}

### `content`

This contains all content (including the local header).

### `footer`

A local footer can be included in the `footer` block.

### `javascripts`

Local JavaScript files can be included in the `javascripts` block. This appear at the end of the page (ie before the `</body>`).

Example:

    {% block javascripts %}
    <script src="{{ asset('path/to/my/javascript.css' }}"></script>
    {% endblock %}

### `partnerships`

Partnership branding can be included in the `partnerships` block.

Example:

    {% block partnerships %}

        <div class="campl-row campl-content">
            <div class="campl-wrap clearfix">
                <div class="campl-column12 campl-partnership-branding">
                    <div class="campl-content-container campl-side-padding">
                        <div class="campl-content-container campl-logo-container campl-bottom-padding">
                            <p class="campl-branding-title">Supported by</p>
                            <ul class="campl-unstyled-list campl-logo-list campl-horizontal-navigation clearfix">
                                <li><img src="{{ asset('path/to/the/logo.png') }}" alt="Some Company"/></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {% endblock %}

Notifications
-------------

The bundle comes with a template for notifications, which you can use like:

    {% for level, messages in app.session.flashbag.all() %}
        {% for message in messages %}
            {% include 'ProjectLightBundle:Component:notification.html.twig' with {level: level, text: message} %}
        {% endfor %}
    {% endfor %}

Expected levels are `success`, `warning`, `alert` and `information` (default).

KnpMenu render
--------------

The bundle comes with a custom menu renderer which replaces the default. If you want to use your own renderer, you can configure the KnpMenuBundle as normal.

Pagerfanta view
---------------

The bundle comes with a custom view which replaces the default. If you want to use your own view, you can configure the WhiteOctoberPagerfantaBundle as normal.
