<?php
session_start();
unset($_SESSION['user-id']);
unset($_SESSION['user-email']);
header("Location: ../start/index.php");