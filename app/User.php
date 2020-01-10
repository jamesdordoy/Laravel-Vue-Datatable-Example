<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class User extends Authenticatable
{
    use Notifiable, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        "id" => [
            "searchable" => true,
            "orderable" => true,
        ],
        "name" => [
            "searchable" => true,
            "orderable" => true,
        ],
        "email" => [
            "searchable" => true,
            "orderable" => true,
        ],
        "is_active" => [
            "searchable" => true,
            "orderable" => true,
        ],
        "cost" => [
            "searchable" => true,
            "orderable" => true,
        ],
    ];

    protected $dataTableRelationships = [
        "belongsTo" => [
            "role" => [
                "model" => \App\Role::class,
                "foreign_key" => "role_id",
                "columns" => [
                    "name" => [
                        "searchable" => true,
                        "orderable" => true,
                    ],
                ],
            ],
        ],
        "hasMany" => [
            "telephoneNumbers" => [
                "model" => \App\TelephoneNumber::class,
                "foreign_key" => "user_id",
                "columns" => [
                    "name" => [
                        "searchable" => true,
                        "orderable" => true,
                    ],
                ],
            ],
        ],
        "belongsToMany" => [
            "departments" => [
                "model" => \App\Department::class,
                "foreign_key" => "role_id",
                "pivot" => [
                    "table_name" => "department_user",
                    "primary_key" => "id",
                    "foreign_key" => "department_id",
                    "local_key" => "user_id",
                ],
                "order_by" => "name",
                "columns" => [
                    "name" => [
                        "searchable" => true,
                        "orderable" => true,
                    ]
                ],
            ],
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "email", "password",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password", "remember_token",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function role()
    {
        return $this->belongsTo(\App\Role::class);
    }

    public function workZone()
    {
        return $this->belongsTo(\App\WorkZone::class);
    }

    public function departments()
    {
        return $this->belongsToMany(\App\Department::class, "department_user", "user_id", "department_id");
    }

    public function telephoneNumbers()
    {
        return $this->hasMany(\App\TelephoneNumber::class);
    }
}
