<?php
require __DIR__ . '/../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$serviceAccount = json_decode(getenv('FIREBASE_CONFIG'), true);

$factory = (new Factory)->withServiceAccount($serviceAccount);
$auth = $factory->createAuth();
