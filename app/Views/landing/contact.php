<?= $this->extend('landing/layout/default') ?>

<?= $this->section('content') ?>


<div class="at-innerbanner">
    <div class="at-innerbannerbox">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="at-innerbannercontent">
              <div class="at-pagetitle">
                <h1>Let's Talk</h1>
              </div>
              <ol class="at-breadcrumb">
                <li><a href="javascript:void(0);">Home</a></li>
                <li class="at-active"><span>Contact Us</span></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--************************************
      Home Slider End
  *************************************-->
  <!--************************************
      Main Start
  *************************************-->
  <main id="at-main" class="at-main at-haslayout">
    <div class="at-contactusvtwo">
      <section class="at-sectionspace at-bglight at-haslayout">
        <div class="container">
          <div class="row">
            <div class="at-content">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-left">
                <div class="at-colcontact">
                  <span class="at-contacticon"><i class="icon-telephone114"></i></span>
                  <h2>Get In Touch</h2>
                  <span>Telephone: +44 788 317 2471</span>
                  <!-- <span>Mobile: +501 860 3210</span> -->
                  <span><a href="mailto:services@condieinvestmentslimited.com">services@condieinvestmentslimited.com</a></span>
                  <!-- <span><a href="mailto:info@condieinvestmentslimited.com">info@condieinvestmentslimited.com</a></span> -->
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-left">
                <div class="at-colcontact">
                  <span class="at-contacticon"><i class="icon-icons74"></i></span>
                  <h2>Our Location</h2>
                  <address>FAIRHURST HOUSE,
                  7 ACORN BUSINESS PARK HEATON,
                  <span>LANE STOCKPORT, CHESHIRE, SK4 1AS</span></address>
                  <span><a href="javascript:void(0);">Get Directions</a></span>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-left">
                <div class="at-colcontact">
                  <span class="at-contacticon"><i class="icon-icons98"></i></span>
                  <h2>Looking For A Career?</h2>
                  <div class="at-description">
                    <p>We can help<span>you.</span></p>
                  </div>
                  <span><a href="mailto:info@condieinvestmentslimited.com">info@condieinvestmentslimited.com</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="at-haslayout">
        <div class="at-content">
          <div id="at-locationmap" class="at-locationmap"></div>
          <form class="at-formtheme at-formcontacus">
            <div class="at-sectiontitleborder">
              <h2>Contact Us</h2>
            </div>
            <fieldset>
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
                  <div class="form-group">
                    <input type="email" name="emailaddress" class="form-control" placeholder="Email Address">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
                  <div class="form-group">
                    <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">

                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                  <div class="form-group">
                    <textarea name="message" class="form-control" placeholder="Message"></textarea>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                  <button type="button" onclick="contact()" class="at-btn">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </section>
    </div>
  </main>


<?=  $this->endSection() ?>
