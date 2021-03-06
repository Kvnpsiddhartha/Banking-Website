<header>
  <nav class="navbar navbar-expand-lg bg-light px-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">Some Bank</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./customers.php">Customers</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./register.php">Register</a>
          </li>
          <?php
          // echo $_SESSION['userid'];
          if (isset($_SESSION['userid'])) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="./transfer.php">Transfer</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./history.php">History</a>
            </li>
            <li class="nav-item float-right">
              <a class="nav-link" href="./profile.php">My profile</a>
            </li>
            <li class="nav-item float-right">
              <a class="nav-link" href="./logout.php">Logout</a>
            </li>

          <?php
          } else {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="./login.php">Login</a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>