<?php
  $mysqli = new mysqli("localhost", "root", "root", "blog");
  if ($mysqli->connect_error) {
    exit("connection failed $mysqli->connect_error");
  }