<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('_partials/head') ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php $this->load->view('_partials/navbar') ?>
      <?php $this->load->view('_partials/sidebar') ?>
      

      <!-- Main Content -->
      <div class="main-content">
      <?php $this->load->view('_partials/content') ?>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?php echo date('Y') ?> <div class="bullet"></div> </a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <?php $this->load->view('_partials/js') ?>
</body>
</html>