# Using Symfony Route Attributes in Laminas Action Controller

This guide will walk you through on how to use Symfony Route Attributes in Laminas Action Controller in PHP 8.1.

## Requirements

- PHP 8.1 or higher

## Installation

Install the required packages via composer.

`composer require nubox/laminas-router-annotations`

## Usage

You can start by creating a new action controller which we will 
annotate with Symfony's Route attributes instead of the laminas configuration.

```php
<?php 

namespace App\Controller; 

use Symfony\Component\Routing\Annotation\Route; 
use Laminas\Mvc\Controller\AbstractActionController;

class MyController extends AbstractActionController 
{ 
    #[Route('/my-path', name: 'my_route_name')] 
    public function myAction() { 
        //Your action code goes here...
    }
}
```

In the example above, `#[Route('/my-path', name: 'my_route_name')]` defines the path for the action and names the route.

That's all! You have successfully configured Symfony Route Attributes in your Laminas Action Controller.

## Troubleshooting

If you run into any issue while trying to use Symfony Route attributes in your Laminas Action Controller, please refer to the respective Symfony and Laminas documentation.

- Symfony Documentation: https://symfony.com/doc/current/routing.html
- Laminas Documentation: https://docs.laminas.dev/laminas-mvc/

Should you encounter issues that are not documented, kindly log them in our issues tracker.

Happy Coding!
