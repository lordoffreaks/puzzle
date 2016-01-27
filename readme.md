# Puzzle

Puzzle is a simple static sites generator which also provides the oportunity to use REST endpoints for your forms 
(or any other type of endpoint you want to use).

Uses [Jigsaw](https://github.com/tightenco/jigsaw) to provide a template engine as Laravel's [Blade](http://laravel.com/docs/5.0/templates)
and compile the resources to a static site.

Uses [Grunt](http://gruntjs.com/) to automate tasks providing an effortless development experience and optimal frontend. 

### Getting Started

#### Installing Globally

1. Install Puzzle globally via Composer:
  
    `$ composer global require lordoffreaks/puzzle`

    > Make sure `~/.composer/vendor/bin` is in your `$PATH`.


2. Initialize a new project:

    `$ puzzle init my-site`

#### Installing Locally

If you run into dependency conflicts when trying to install Puzzle globally, you can always install it locally on a per site basis.

1. Create a folder for your site:

    `$ mkdir my-site && cd my-site`

2. Install Puzzle via Composer:
  
    `$ composer require lordoffreaks/puzzle`

3. Initialize a new project in the current folder:

    `$ ./vendor/bin/puzzle init`


### Building your first site

Building a Puzzle site is exactly like building a static HTML site, except that files ending in `.blade.php` will be rendered using Laravel's [Blade Templating Language](http://laravel.com/docs/5.0/templates).

Build out your site however you like in the `/source` directory. It might look something like this:

```
├─ source
│  ├─ _assets
│  ├─ _layouts
│  │  └─ master.blade.php
│  ├─ img
│  │  └─ logo.png
│  ├─ about-us.blade.php
│  └─ index.blade.php
└─ config.php
```

When you'd like to build it, run the `build` command from within your project root:

`$ puzzle build`

Your site will be built and placed in the `/build_local` directory by default.

Using the example structure above, you'd end up with something like this:

```
├─ build_local
│  ├─ about-us
│  │  └─ index.html
│  ├─ img
│  │  └─ logo.png
│  └─ index.html
├─ source
└─ config.php
```

To quickly preview it, start a local PHP server:

`$ php -S localhost:8000/ -t build_local`

#### Layouts

One of the biggest benefits of a templating language is the ability to create reusable layouts.

Since it's important that a layout is never rendered on it's own, you need to be able to tell Jigsaw when a file shouldn't be rendered.

To prevent a file or folder from being rendered, simply prefix it with an underscore:

```
├─ source
│  ├─ _layouts
│  │  └─ master.blade.php # Not rendered
│  └─ index.blade.php     # Rendered
└─ config.php
```

#### Config variables

Anything you add to the array in `config.php` will be made available as a variable in your templates.

For example, if your config looks like this...

```php
return [
    'contact_email' => 'support@example.com',
];
```

...you can use that variable in your templates like so:

```
@extends('_layouts.master')

@section('content')
    <p>Contact us at {{ $contact_email }}</p>
@stop
```

#### Environments

You might have certain configuration variables that need to be different in different environments, like a Google Analytics tracking ID for example.

Puzzle lets you specify a different configuration file for each environment to handle this.

To create an environment-specific config file, just stick your environment name in front of the file extension:

`config.production.php`

To build your site for a specific environment, use the `--env` option:

`$ puzzle build --env=production`

Each environment gets it's own `build_*` folder, so in this case your site will be placed in `build_production`.

> Note: Environment-specific config files are _merged_ with the base config file, so you don't have to repeat values that don't need to change.

#### Pretty URLs

Puzzle will automatically take any Blade files _not_ named `index` and render them as `index.html` in a subfolder with the same name as the original file.

For example, if you have a file named `about-us.blade.php` in your `source` directory:

```
├─ source
   ├─ _layouts
   ├─ about-us.blade.php
   └─ index.blade.php
```

...it will be rendered as `index.html` in the `build/about-us` directory:

```
├─ build_local
   ├─ about-us
   │  └─ index.html 
   └─ index.html
```

> If you need to disable this behavior, use the `--pretty=false` option when building your site.
