<?php
session_start();
if($_SESSION['bid']==""){
    header('location:../');
}