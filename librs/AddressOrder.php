<?php
class AddressOrder extends Database {
    protected $table = 'diachidonhang';

    public static function createInfoClient($data) {
        $_this = new static();
        $_this->table = 'diachikh';
        $_this->finds();
    }
}