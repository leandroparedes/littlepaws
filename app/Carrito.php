<?php

namespace App;

class Carrito {

    public $items = null;
    public $cantidadTotal = 0;
    public $precioTotal = 0;

    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->cantidadTotal = $oldCart->cantidadTotal;
            $this->precioTotal = $oldCart->precioTotal;
        }
    }

    public function add($item, $id) {

        if ($item->descuento > 0) {
            $precioConDcto = round(intval($item->precio) - (intval($item->precio) * intval($item->descuento) / 100));
        } else {
            $precioConDcto = $item->precio;
        }

        $storedItem = [
            'cantidad' => 0,
            'precio' => $precioConDcto,
            'item' => $item
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        if ($storedItem['cantidad'] >= $item->stock) {
            $storedItem['cantidad'] = $item->stock;
        } else {
            $storedItem['cantidad']++;
            $this->precioTotal += $precioConDcto;
            $this->cantidadTotal++;
        }

        $storedItem['precio'] = $precioConDcto * $storedItem['cantidad'];
        $this->items[$id] = $storedItem;
    }

    public function reduceByOne($id) {
        $this->items[$id]['cantidad']--;
        $this->items[$id]['precio'] -= $this->items[$id]['item']['precio'];
        $this->cantidadTotal--;
        $this->precioTotal -= $this->items[$id]['item']['precio'];

        if ($this->items[$id]['cantidad'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id) {
        $this->cantidadTotal -= $this->items[$id]['cantidad'];
        $this->precioTotal -= $this->items[$id]['precio'];
        unset($this->items[$id]);
    }
}
