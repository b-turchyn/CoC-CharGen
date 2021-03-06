<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Call of Cthulhu Character Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Character generator for Call of Cthulhu">
    <meta name="author" content="Brian Turchyn">

    <link href="<?php echo ROOT_DIR ?>css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
      td.table-result, th.table-result {
        width: 1%;
        text-align: center;
      }
    </style>
    <link href="<?php echo ROOT_DIR ?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo ROOT_DIR ?>css/chargen.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-narrow">
