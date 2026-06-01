<?php

namespace App\Enums;

enum UserRole: string
{
    case Customer = 'customer';
    case RestaurantOwner = 'restaurant_owner';
    case Admin = 'admin';
}
