## Installation
Clone the repo in the following location

```Laravel_Root/packages/tunnelconflux/auto-jwt```

```git clone https://github.com/TunnelConflux/auto-jwt.git .```

Then append the following code block on Laravel ```composer.json```

```
"repositories": [
    {
        "type": "path",
        "url": "packages/tunnelconflux/auto-jwt",
        "options": {
            "symlink": true
        }
    }
]

```

Then run ```composer require "tunnelconflux/auto-jwt"``` and ```php artisan jwt:secret```

Now you are all set to go ahead !

Now have to implement ```JWTSubject``` in the Auth service provider model

```
<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}


```

[Follow JWT doc](https://github.com/tymondesigns/jwt-auth/blob/1.0.0-rc.4.1/docs)

## Test
```We build on Laravel 5.8```

## License
The Module is open-source software licensed under the MIT