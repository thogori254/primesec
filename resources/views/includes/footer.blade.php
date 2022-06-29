<footer class="my-footer">
    <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <div class="row">

      <div class="col-md-6 mt-md-0 mt-3 footer-container">

        <h5 class="text-uppercase footer-header">SUBSCRIBE TO OUR MONTHLY SERVICES</h5>
        <p class="footer-content">Leave us your email address and we will be in touch soon. </p>
        
        <div v-if="savingMailing">
          <p>Saving....</p>
        </div>
        <div v-else-if="savedMailing">
          <p class="mailingSuccess">You will receive our next newsletter</p>
        </div>

      </div>
      <div class="col-md-6 footer-container">

        <div class="form-inline">
          <label class="sr-only" for="email_subscription">Email</label>
          <input type="email" v-model="newMail" class="form-control mb-2 mr-sm-2" id="email_subscription" placeholder="Email">
          <button class="btn btn-outline-info mb-2" @click="createMailing()">Submit</button>
        </div>


        <ul v-if="mailingFailed" class="item-list row" id="items-card">
          <li class="col-md-6" transition="expand" v-for="(error, index) in errors" :key="index">
            <span style="color: red;"> <small>@{{error}}</small> </span>
          </li>
        </ul>
        <p class="footer-content"> Or to text us on WhatsApp: <a class="whatsapp" href="http://wa.me/254735171038"> Click Here </a></p>
      </div>

      <hr class="clearfix w-100 d-md-none pb-3">

    </div>
  </div>    
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3"> 
      <div>
        <a target="_blank" href="http://wa.me/254735171038"> 
          <i class="fab fa-whatsapp"></i>
        </a>
        <a target="_blank" href="https://web.facebook.com/PrimeSecKe">
          <i class="fab fa-facebook"></i>
        </a>
        <a target="_blank" href="https://twitter.com/PrimeSecKe?ref_src=twsrc%5Etfw">
          <i class="fab fa-twitter"></i>
        </a>
      </div>
      © 2020 <a  href="" @click.prevent="showHome()">Prime Securities Kenya</a>
  </div>
</footer>