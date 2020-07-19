Kohana auth module - with Postgres *ORM*
---
| ver   | Stable                                                                                                                       | Develop                                                                                                                        |
|-------|------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------|
| 3.3.x | [![Build Status - 3.3/master](https://travis-ci.org/kohana/auth.svg?branch=3.3%2Fmaster)](https://travis-ci.org/kohana/auth) | [![Build Status - 3.3/develop](https://travis-ci.org/kohana/auth.svg?branch=3.3%2Fdevelop)](https://travis-ci.org/kohana/auth) |
| 3.4.x | [![Build Status - 3.4/master](https://travis-ci.org/kohana/auth.svg?branch=3.4%2Fmaster)](https://travis-ci.org/kohana/auth) | [![Build Status - 3.4/develop](https://travis-ci.org/kohana/auth.svg?branch=3.4%2Fdevelop)](https://travis-ci.org/kohana/auth) |

I've forked the main Auth module because there were some fundamental flaws with it:

 1. It's trivial to [bruteforce](http://dev.kohanaframework.org/issues/3163) publicly hidden salt hashes.
    - I've fixed this by switching the password hashing algorithm to the more secure secret-key based hash_hmac method.
 2. ORM drivers were included.
    - I've fixed this by simply removing them. They cause confusion with new users because they think that Auth requires ORM. The only driver currently provided by default is the file driver.
 3. Auth::get_user()'s api is inconsistent because it returns different data types.
    - I've fixed this by returning an empty user model by default. You can override what gets returned (if you've changed your user model class name for instance) by overloading the get_user() method in your application.

These changes should be merged into the mainline branch eventually, but they completely break the API, so likely won't be done until 3.1.

------------------------------------------------------------------
Hey friend, you'r in right place!
## After start ##
I was forced to fork, because i not found a repo that conect on postgres.
This module depends my other fork ORM - *https://github.com/rmurussi/orm*

## php 7.4

### Considerations
## 1 On Postgres you need to use `schema.table` on queries, or you'll receive error.
## 2 Kohana ORM will build these alias as `table name`.
## 3 On modules/ORM/Model you must create Folder[Schema Name] and Files[table name] Like:
	`modules/ORM/Model/Xwood/Person.php class Model_XWood_Person {..}`

## For dribble other erros, i prefer that you use my Fork Kohana/ORM -> *https://github.com/rmurussi/orm*

###############
## Let's GO! ##
###############

#1. Start including these modules on your app like:
`$. git submodule add https://github.com/rmurussi/auth modules/auth`
`$. git submodule add https://github.com/rmurussi/orm modules/orm`

#2. set bootstrap to load these module:
	`Kohana::modules(array(
		'auth'       => MODPATH.'auth',
		'orm'        => MODPATH.'orm',`

#3. Then set data config of database in: `modules/auth/config/auth.php`

#4. do a test on your index.php, ex:
	`$obAuth = Auth::instance();
	$bol = $obAuth->login('valid_username', 'valid_and_no_hash_password', FALSE);
	var_dump($bol);
	die;`