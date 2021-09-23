<?= $this->extend('landing/layout/default') ?>

<?= $this->section('content') ?>

<style media="screen">
body {
  font-family: tahoma;
  background-image: url(https://s3.ca-central-1.amazonaws.com/image-web-frankie/BackgroundBlue.jpg);
  background-size: cover;
  background-position: center;
}

.testimonial {
  background-color: white;
  text-align: center;
  padding: 30px 30px 50px;
  margin: 100px 15px 160px;
  position: relative;
}

.testimonial::before,
.testimonial::after {
  content: "";
  border-top: 40px solid white;
  border-right: 125px solid transparent;
  position: absolute;
  bottom: -40px;
  left: 0;
}

.testimonial::after {
  border-right: none;
  border-left: 125px solid transparent;
  left: auto;
  right: 0;
}

.testimonial .icon {
  display: inline-block;
  font-size: 80px;
  color: #fd961a;
  margin-bottom: 20px;
  opacity: 0.6;
}

.testimonial .description {
  font-size: 14px;
  color: black;
  text-align: justify;
  margin-bottom: 30px;
  opacity: 0.9;
}

.testimonial .testimonial-content {
  width: 100%;
  left: 0;
  position: absolute;
}

.testimonial .pic {
  display: inline-block;
  border: 4px solid white;
  border-radius: 50%;
  box-shadow: 0 0 4px 4px #fd961a;
  overflow: hidden;
  z-index: 1;
  position: relative;
}

.testimonial .pic img {
  width: 100%;
  height: auto;
}

.testimonial .name {
  font-size: 15px;
  font-weight: bold;
  color: white;
  text-transform: capitalize;
  margin: 10px 0 5px 0;
}

.testimonial .title {
  display: block;
  font-size: 14px;
  color: #ffd9b8;
}

.owl-controls {
  margin-top: 20px;
}

.owl-pagination {
  display: flex;
  justify-content: center;
}

.owl-page {
  height: 10px;
  width: 40px;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 10%;
}

.owl-page:hover,
.owl-page.active {
  background-color: rgba(255, 255, 255, 0.3);
}

.owl-page:not(first-item) {
  margin-left: 10px;
}

</style>


<div class="demo">
  <div class="container">
    <div class="row">
      <div id="testimonial-slider" class="owl-carousel">
        <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
          My name is Michele and I am your VIP customer. Just wanted to let you know that I made the best decision in my life by investing to this website, Made very good profits!!!. Thank you once again!
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=1027" alt="">
            </div>
            <h3 class="name">Michele Miller</h3>
            <span class="title">Marketer at CR group.</span>
          </div>
        </div><br>

        <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
            This is my first month as a investor and my happiness is incredible! Been able to take $1k account up to over $1,600 with you guys in 24 hours. Thats before the start of this session! Your best is more then I expected! Thank you soo much for all your hard work!
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=839" alt="">
            </div>
            <h3 class="name">Patricia Knott</h3>
            <span class="title">Manager at Loans & Finance.</span>
          </div>
        </div><br>

        <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
I started investing less than a week ago and hands down you are the best ever! Allowing me to make $250 to sometimes $400 a day my account has grown significantly! I am going to re-invest next month and keep making money with you guys. I can say that you are the best! Good work!!!
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=856" alt="">
            </div>
            <h3 class="name">Justin Ramos</h3>
            <span class="title">Web Developer</span>
          </div>
        </div><br>
        <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
            Really happy with your service $500 – $900 in a little over 2 days. I am building my account and my trading levels and increasing the volumes accordingly because as of now you haven’t let me down. Now looking for a 12 month plan! That’s how confident I am with your service. Keep up the great work. I will highly recommend you to anyone!!!
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=836" alt="">
            </div>
            <h3 class="name">Mary Huntley</h3>
            <span class="title">Copywriter at KINGCo.</span>
          </div>
        </div><br>
        <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
            “Wow. I just got my first redrawal SO SIMPLE. I am blown away. You guys truly kick ass. Thanks for being so awesome. High fives!”
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=883" alt="">
            </div>
            <h3 class="name">Aaron Newell</h3>
            <span class="title">Web Developer</span>
          </div>
        </div><br>
                <div class="testimonial">
          <span class="icon fa fa-quote-left"></span>
          <p class="description">
            I just wanted to share a quick note and let you know that you guys do a really good job. I’m glad I decided to work with you. It’s really great how easy your websites are to update and manage. I never have any problem at all.
          </p>
          <div class="testimonial-content">
            <div class="pic">
              <img src="https://picsum.photos/130/130?image=777" alt="">
            </div>
            <h3 class="name">Lizzie Geren</h3>
            <span class="title">Ceo Zeal Group</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<br><br><br>


<?= $this->endSection() ?>
