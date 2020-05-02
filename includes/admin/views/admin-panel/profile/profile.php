<!-- Page Header -->
<h1 class="d-block page-header p-3 mb-6">
  <span>Manage Profile</span>
</h1>

<div class="row px-3">
  <div class="col-lg-4 col-12 d-lg-block d-none">
    <h2 class="mb-4 simple-heading">
      <strong>Options</strong>
    </h2>
    <div class="simple-nav">
      <ul>
        <li><a href="#" class="active">
          <span class="stag-icon stag-icon-arrow-next"></span> Profile Details
        </a></li>
        <li><a href="#">
          <span class="stag-icon stag-icon-arrow-next"></span> Security Settings
        </a></li>
        <li><a href="#">
          <span class="stag-icon stag-icon-arrow-next"></span> Dashboard Settings
        </a></li>
      </ul>
    </div>
  </div>
  <div class="col-lg-8 col-12">
    <!-- Navigation for small menu -->
    <div class="input-group header-text-with-menu d-md-none mb-md-0 mb-4">
      <input type="text" class="form-control" aria-label="Text input with dropdown button" value="Profile Details" readonly>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div role="separator" class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </div>
    </div>

    <h2 class="mb-4 simple-heading with-menu d-md-block d-none">
      <strong>Profile Details</strong>
    </h2>
    <form class="text-left m-0" method="post" action="<?php echo get_home_url().'/?setup=db'; ?>">
      <div class="form-group">
        <label for="database-name">Full Name</label>
        <input type="text" class="form-control" name="database-name" id="database-name" aria-describedby="database-name-help" placeholder="Enter Database Name" value="stag_app" required>
        <small id="database-name-help" class="form-text text-muted"> The name of the database you want to use with StagPHP.</small>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" aria-describedby="username-help" placeholder="Enter Username" value="root" required>
        <small id="username-help" class="form-text text-muted"> Your database username.</small>
      </div>

      <div class="form-group">
        <label for="password">Email</label>
        <input type="text" class="form-control" name="password" id="password" aria-describedby="password-help" placeholder="Enter Password">
        <small id="password-help" class="form-text text-muted">Your database password.</small>
      </div>

      <div class="form-group">
        <label for="db-host">Gender</label>
        <input type="text" class="form-control" name="db-host" id="db-host" aria-describedby="db-host-help" placeholder="Enter Database Host" value="localhost" required>
        <small id="db-host-help" class="form-text text-muted">You should be able to get this info from your web host, if localhost doesn’t work.</small>
      </div>

      <div class="form-group">
        <label for="gender-select">Gender</label>
        <select class="custom-select" id="gender-select">
          <option selected>Select your gender</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <small id="db-host-help" class="form-text text-muted">You should be able to get this info from your web host, if localhost doesn’t work.</small>
      </div>

      <div class="cmf-group  mb-3">

      </div>
    </form>
  </div>
</div>