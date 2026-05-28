<?php
session_start();

require_once('../config/auth_helper.php');
require_once('../config/destination_helper.php');

checkLogin('admin');

