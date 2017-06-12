![logo](http://eden.openovate.com/assets/images/cloud-social.png) Eden Model
====
[![Build Status](https://api.travis-ci.org/Eden-PHP/Model.png)](https://travis-ci.org/Eden-PHP/Model)
====

- [Install](#install)
- [Introduction](#intro)
- [Contributing](#contributing)

====

<a name="install"></a>
## Install

`composer install eden/model`

====

<a name="intro"></a>
## Introduction

Manipulating array data in most cases can be expressed as a model. Models in *Eden* is defined loosely and as a utility class to help managing data in a controlled and chainable format. The basic setup of a model is described in `Figure 1`.

**Figure 1. Setup**

	$user = array(
		'user_name' => 'Chris',
		'user_email' => 'cblanquera@openovate.com',
		'user_location' => 'Manila, Philippines');
	
	eden('model', $user);

From here we can access properties in our model as a method, property or back as an array. `Figure 2` shows the ways to access data in action.

**Figure 2. Accessing Model Properties**

```
//set user name
$model->setUserName('Chris');            

// returns user email
$model->getUserEmail();                  

// set any abstract key
$model->setAnyThing('somthing');

// get any abstract key
$model->getAnyThing();              	
 
//access as array
echo $model['user_name'];

//set as array
$model['user_email'] = 'my@email.com';

//access as object
echo $model->user_name;  

//set as object
$model->user_name = 'my@email.com';    
```

We added several common methods to futher manipulate model data.

**Figure 3. Utility Methods**

```
//for each row, copy the value of post_user to the user_id column
$model->copy('post_user', 'user_id');

//returns a raw array (no object)
$model->get();  
```

====

<a name="contributing"></a>
#Contributing to Eden

Contributions to *Eden* are following the Github work flow. Please read up before contributing.

##Setting up your machine with the Eden repository and your fork

1. Fork the repository
2. Fire up your local terminal create a new branch from the `v4` branch of your 
fork with a branch name describing what your changes are. 
 Possible branch name types:
    - bugfix
    - feature
    - improvement
3. Make your changes. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

##Making pull requests

1. Please ensure to run `phpunit` before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. An Eden developer will review your code and merge it in when it has been classified as suitable.