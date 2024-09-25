<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CodeHim">
  <title>Tendy Playlist</title>

  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/demo.css">
  <style>
    body {
     /* Initial background color */
     
      transition: background-color 2s ease-in-out; /* Transition duration and easing */
    }
    
  </style>
  <script>
    function changeColor() {
        var colors = ["#A02334", "#FFAD60", "#FFEEAD", "#96CEB4", "#96CEB4", "#A02334"]; // Aurora-inspired colors
        var randomIndex = Math.floor(Math.random() * colors.length);
        document.body.style.backgroundColor = colors[randomIndex];
    }

    setInterval(changeColor, 2000);
  </script>
</head>

<body>
  <header class="intro">
    <h1>Music Everywhere</h1>
    <p>Can live without music</p>
