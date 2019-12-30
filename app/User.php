<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class User extends Authenticatable
{
    use Notifiable, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => true,
            'orderable' => true,
        ],
        'name' => [
            'searchable' => true,
            'orderable' => true,
        ],
        'email' => [
            'searchable' => true,
            'orderable' => true,
        ],
        'is_active' => [
            'searchable' => true,
            'orderable' => true,
        ],
        'cost' => [
            'searchable' => true,
            'orderable' => true,
        ],
    ];

    protected $dataTableRelationships = [
        "belongsTo" => [
            'role' => [
                "model" => \App\Role::class,
                'foreign_key' => 'role_id',
                'columns' => [
                    'name' => [
                        'searchable' => true,
                        'orderable' => true,
                    ],
                ],
            ],
        ],
        "hasMany" => [
            'usernames' => [
                "model" => \App\Username::class,
                'foreign_key' => 'user_id',
                'columns' => [
                    'name' => [
                        'searchable' => true,
                        'orderable' => true,
                    ],
                ],
            ],
        ],
        // "belongsToMany" => [
        //     'roles' => [
        //         "model" => \App\Role::class,
        //         "foreign_key" => "role_id",
        //         "pivot" => [
        //             "table_name" => "role_user",
        //             "primary_key" => "id",
        //             "foreign_key" => "role_id",
        //             "local_key" => "user_id",
        //         ],
        //         "subOrder" => [
        //             "order_by" => "roles.name",
        //             "order_dir" => "asc",
        //         ],
        //         'columns' => [
        //             'name' => [
        //                 'searchable' => true,
        //                 'orderable' => true,
        //             ]
        //         ],
        //     ],
        // ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(\App\Role::class);
    }

    public function workZone()
    {
        return $this->belongsTo(\App\WorkZone::class);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function usernames()
    {
        return $this->hasMany(\App\Username::class);
    }
}
