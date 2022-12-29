<!DOCTYPE html>
<!--
 -    Copyright (c) 2020 Ben Cerjan, Lief Esbenshade
 -
 -    This file is part of smbc_stocks.
 -
 -    smbc_stocks is free software: you can redistribute it and/or modify
 -    it under the terms of the GNU Affero General Public License as published by
 -    the Free Software Foundation, either version 3 of the License, or
 -    (at your option) any later version.
 -
 -    smbc_stocks is distributed in the hope that it will be useful,
 -    but WITHOUT ANY WARRANTY; without even the implied warranty of
 -    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 -    GNU Affero General Public License for more details.
 -
 -    You should have received a copy of the GNU Affero General Public License
 -    along with smbc_stocks.  If not, see <https://www.gnu.org/licenses/>.
-->
<html lang="en">
<head>
<meta charset="utf=8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<?php include("./resources.php"); ?>

<style>
body {
  background-color: #FFF3BA;
}
</style>

<?php
  require_once __DIR__ . '/../functions.php/get_headline.php';
  require_once __DIR__ . '/../functions.php/get_adjective.php';
  $arr = get_headline();
  $headline = $arr['headline'];
  $url = $arr['url'];
  $adjective_res = get_adjective();
  $adjective = strtoupper($adjective_res['adjective']);
  $pos = $adjective_res['positive'];
?>

<title>Stock Market Analysis</title>

</head>

<body>

<main role="main">

<div class="container">
  <div class="row justify-content-center">
    <h1>Stock Market</h1>
  </div>
    <br>
  <div class="row justify-content-center">
    <h1><?php echo htmlspecialchars($adjective); ?></h1>
  </div>
  <br>
  <div class="row justify-content-center">
    <h2>as</h2>
  </div>
  <br>
  <div class="row justify-content-center">
    <h1><?php echo htmlspecialchars($headline); ?></h1>
  </div>
  <div class="row justify-content-center">
    <span class="text-muted">
      (<a href="<?php echo htmlspecialchars($url); ?>">link to article</a>)
    </span>
  </div>
<!-- Container -->
</div>
<br>
<br>
<footer class="footer">
  <div class="container-fluid">
    <span class="text-muted">
      Find a bug? Want a new feature? <a href="mailto:contact@waldocorp.com">Drop us a line!</a>
      | <a href="https://waldocorp.com">Other Projects</a>
      | <a href="https://github.com/waldoCorp/smbc_stock_headlines">Github Page</a>
      | <a href="https://www.smbc-comics.com/comic/markets">Inspiration</a>
    </span>
  </div>
</footer>

</main>

<script type="text/javascript">

</script>


</body>

</html>
