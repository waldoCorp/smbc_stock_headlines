<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf=8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<?php include("./resources.php"); ?>

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
