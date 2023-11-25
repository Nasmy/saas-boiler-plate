<?php

namespace App\Services;

class PermissionService
{
    const PERMISSION_FULL_ACCESS = "fullAccess";
    const PERMISSION_VIEW = "show";
    const PERMISSION_CREATE = "store";
    const PERMISSION_EDIT = "update";
    const PERMISSION_LIST = "index";
    const PERMISSION_DELETE = "destroy";
    const PERMISSION_APPROVE = "approve";

    public function getPermissionCategory(): array
    {
        return ["Reports", "Dashboard", "Settings", "Documents", "Accountant", "Purchases", "Sales", "Banking", "Items", "Contacts"];
    }

    public static function getPermissions(): array
    {
        return [

            // Contact Related Permissions
            [
                "name" => "Contacts",
                "parent" => "contacts",
                "child" => "customers",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Customers",
                "active" => 1
            ],
            [
                "name" => "Contacts",
                "parent" => "contacts",
                "child" => "vendors",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Vendors",
                "active" => 1
            ],

            // Item Relates permissions
            [
                "name" => "Items",
                "parent" => "items",
                "child" => "items",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Item",
                "active" => 1
            ],

            [
                "name" => "Items",
                "parent" => "items",
                "child" => "inventory-adjustments",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Inventory Adjustments",
                "active" => 1
            ],

            [
                "name" => "Items",
                "parent" => "items",
                "child" => "warehouses",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Warehouses",
                "active" => 1
            ],

            [
                "name" => "Items",
                "parent" => "items",
                "child" => "price-lists",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Price List",
                "active" => 1
            ],

            // Sales Related permissions
            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "invoices",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Invoices",
                "active" => 1
            ],

            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "customer-payments",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Customer Payments",
                "active" => 1
            ],
            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "estimates",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Estimates",
                "active" => 1
            ],
            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "sales-receipts",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Sales Receipt",
                "active" => 1
            ],
            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "sales-orders",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Sales Orders",
                "active" => 1
            ],
            [
                "name" => "Sales",
                "parent" => "sales",
                "child" => "credit-notes",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Credit Notes",
                "active" => 1
            ],

            // Purchase related routes
            [
                "name" => "Purchases",
                "parent" => "Purchase",
                "child" => "bills",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Bills",
                "active" => 1
            ],

            [
                "name" => "Purchases",
                "parent" => "Purchase",
                "child" => "vendor-payments",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Vendor Payments",
                "active" => 1
            ],
            [
                "name" => "Purchases",
                "parent" => "Purchase",
                "child" => "expenses",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST],
                "description" => "Expenses",
                "active" => 1
            ],
            [
                "name" => "Purchases",
                "parent" => "Purchase",
                "child" => "purchase-orders",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Purchase Orders",
                "active" => 1
            ],
            [
                "name" => "Purchases",
                "parent" => "Purchase",
                "child" => "vendor-credits",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Vendor Credits",
                "active" => 1
            ],

            [
                "name" => "Users",
                "parent" => "users",
                "child" => "roles",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "User Roles",
                "active" => 1
            ],

            [
                "name" => "Users",
                "parent" => "users",
                "child" => "permissions",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_LIST],
                "description" => "User Permissions",
                "active" => 1
            ],

            [
                "name" => "Users",
                "parent" => "users",
                "child" => "users",
                "ident" => [self::PERMISSION_FULL_ACCESS, self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_LIST, self::PERMISSION_APPROVE],
                "description" => "Manage Users",
                "active" => 1
            ],
        ];
    }
}
