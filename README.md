# Livewire Shopping Cart

A Laravel package for a dynamic e-commerce cart system using Livewire. Add, remove, and display cart totals without reloading the page.

## Installation

You can install the package via Composer:

```bash
composer require vendor/livewire-shopping-cart
```

## Configuration

```php
php artisan vendor:publish --provider="Vendor\LivewireShoppingCart\CartServiceProvider" --tag="config"

This will create a cart.php file in the config folder where you can modify the cart settings.

```

## Add a Product to the Cart

```php
Create a Livewire component `AddToCart`:

Modify the AddToCart component:

```

```php
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class AddToCart extends Component
{
    public $product;

    public function addToCart($product)
    {
        Cart::add($product);
        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}

```

# Create the view for the add-to-cart.blade.php component:

```php
<!-- resources/views/livewire/add-to-cart.blade.php -->
<button wire:click="addToCart({{ $product->id }})">Add to Cart</button>
```

### Display the Cart Total

Create a Livewire component CartTotal:

```php
php artisan make:livewire CartTotal

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartTotal extends Component
{
    protected $listeners = ['cartUpdated' => 'updateTotal'];

    public $total;

    public function mount()
    {
        $this->total = Cart::total();
    }

    public function updateTotal()
    {
        $this->total = Cart::total();
    }

    public function render()
    {
        return view('livewire.cart-total');
    }
}

Create the view for the cart-total.blade.php component:

<!-- resources/views/livewire/cart-total.blade.php -->
<div>
    Total: ${{ $total }}
</div>


Use the Components in the Main View


<!-- resources/views/shop.blade.php -->
@extends('layouts.app')

@section('content')
    <div>
        @foreach($products as $product)
            <div>
                <h3>{{ $product->name }}</h3>
                <livewire:add-to-cart :product="$product" />
            </div>
        @endforeach
    </div>

    <div>
        <livewire:cart-total />
    </div>
@endsection



```

# Additional Configuration

```php
composer require livewire/livewire

<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
    @livewireStyles
</head>
<body>
    <!-- ... -->
    @livewireScripts
</body>
</html>

```

# Contribution

Contributions are welcome! Please submit a pull request or open an issue for any improvements or fixes.

### License

### 8. Update `composer.json`

```json
{
  "name": "vendor/livewire-shopping-cart",
  "description": "A Laravel e-commerce package with Livewire",
  "require": {
    "php": "^7.3|^8.0",
    "livewire/livewire": "^2.0",
    "laravel/framework": "^11.0"
  },
  "autoload": {
    "psr-4": {
      "Vendor\\LivewireShoppingCart\\": "src/"
    }
  },
  "extra": {
    "laravel": {
      "providers": ["Vendor\\LivewireShoppingCart\\CartServiceProvider"],
      "aliases": {
        "Cart": "Vendor\\LivewireShoppingCart\\CartFacade"
      }
    }
  }
}
```
