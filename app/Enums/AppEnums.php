<?php

namespace App\Enums;

/**
 * Enum-like constants untuk Zoneline.
 *
 * Kenapa tidak pakai PHP Enum?
 * Karena beberapa status (order, payment method) sudah dinamis via tabel DB.
 * Enum ini hanya untuk nilai-nilai yang benar-benar fixed.
 */
class TenantStatus
{
    const TRIAL     = 'Trial';
    const ACTIVE    = 'Active';
    const SUSPENDED = 'Suspended';
    const EXPIRED   = 'Expired';

    public static function all(): array
    {
        return [self::TRIAL, self::ACTIVE, self::SUSPENDED, self::EXPIRED];
    }
}

class PaymentStatus
{
    const UNPAID  = 'Unpaid';
    const PARTIAL = 'Partial';
    const PAID    = 'Paid';
}

class UserRole
{
    const SUPER_ADMIN = 'super_admin';
    const OWNER       = 'owner';
    const MANAGER     = 'manager';
    const CASHIER     = 'cashier';
    const EMPLOYEE    = 'employee';
}

class Permission
{
    // Order
    const CREATE_ORDER  = 'create_order';
    const EDIT_ORDER    = 'edit_order';
    const DELETE_ORDER  = 'delete_order';
    const VIEW_ORDER    = 'view_order';

    // Customer
    const CREATE_CUSTOMER = 'create_customer';
    const EDIT_CUSTOMER   = 'edit_customer';
    const DELETE_CUSTOMER = 'delete_customer';

    // Report
    const VIEW_REPORT     = 'view_report';

    // Employee
    const MANAGE_EMPLOYEE = 'manage_employee';

    // Settings
    const MANAGE_SETTINGS = 'manage_settings';

    // Subscription
    const MANAGE_SUBSCRIPTION = 'manage_subscription';
}
