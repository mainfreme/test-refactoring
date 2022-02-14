<?php

namespace App;

final class GildedRose
{
    public function updateQuality(Item $item): void
    {
        if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($item->quality > 0) {
                $item->quality--;
                if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                    $item->quality = 80;
                }
            }
        } else {
            if ($item->quality < 50) {
                $item->quality++;
                $this->checkIsPress($item);
            }
        }

        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in--;
        }

        $this->checkIsNotSell($item);
    }

    public function checkIsPress(Item $item): Item
    {
        if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {

            if ($item->sell_in < 11) {
                $this->checkQuality($item);
            }

            if ($item->sell_in < 6) {
                $this->checkQuality($item);
            }
        }

        return $item;
    }

    public function checkQuality(Item $item): Item
    {
        if ($item->quality < 50) {
            $item->quality++;
        }

        return $item;
    }

    public function checkIsNotSell(Item $item): Item
    {
        if ($item->sell_in < 0) {
            if ($item->name == 'Aged Brie') {

                return $this->checkQuality($item);
            }

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                $item->quality = 0;
            }

            if ($item->quality > 0 and $item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->quality--;
            }
        }

        return $item;
    }
}
