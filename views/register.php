<!--************************************
					Inner Banner Start
			*************************************-->
<div class="sj-innerbanner">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="sj-innerbannercontent">
          <h1>Become A Member</h1>
          <ol class="sj-breadcrumb">
            <li><a href="javascript:void(0);">Home</a></li>
            <li><a href="javascript:void(0);">Register</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!--************************************
					Inner Banner End
			*************************************-->
<div class="col-12 d-flex justify-content-center my-3">
  <div id="sj-content" class="sj-content">
    <div class="sj-registerarea">
      <div class="registernow">
        <div class="sj-borderheading d-flex justify-content-center mt-3">
          <h3>Register Now</h3>
        </div>
        <div class="sj-registerformholder">
          <div class="row">
            <div class="col-6 offset-3">
              <form id="registerForm" action="" method="POST" class="sj-formtheme sj-formregister">
                <fieldset>
                  <div class="form-group">
                    <input type="text" name="firstName" class="form-control <?php echo $user->hasError('firstName') ? 'is-invalid' : '' ?>" value="<?php echo $user->firstName ?>" placeholder="First Name*">
                    <div class="invalid-feedback">
                      <?php echo $user->getFirstError('firstName') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" name="lastName" class="form-control <?php echo $user->hasError('lastName') ? 'is-invalid' : '' ?>" value="<?php echo $user->lastName ?>" placeholder="Last Name*">
                    <div class="invalid-feedback">
                      <?php echo $user->getFirstError('lastName') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" name="username" class="form-control <?php echo $user->hasError('username') ? 'is-invalid' : '' ?>" value="<?php echo $user->username ?>" placeholder="Username*">
                    <div class="invalid-feedback">
                      <?php echo $user->getFirstError('username') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control <?php echo $user->hasError('password') ? 'is-invalid' : '' ?>" value="<?php echo $user->password ?>" placeholder="Password*">
                    <div class="invalid-feedback">
                      <?php echo $user->getFirstError('password') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirmPassword" class="form-control <?php echo $user->hasError('confirmPassword') ? 'is-invalid' : '' ?>" value="<?php echo $user->confirmPassword ?>" placeholder="Confirm Password*">
                    <div class="invalid-feedback">
                      <?php echo $user->getFirstError('confirmPassword') ?>
                    </div>
                  </div>                  
                  <button id="registerBtn" type="submit" class="sj-btn sj-btnactive" style="outline: 0; border: 0;">Register</button>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>