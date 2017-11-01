<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 *
 * Stores information for admin users
 *
 * @package App\
 */

class Admin extends Model
{
    use Notifiable;

    protected $admin;
    protected $email;

    // Constructor
    public function __construct() {
        $this->admin = config('admin.name');
        $this->email = config('admin.email');
    }
}
