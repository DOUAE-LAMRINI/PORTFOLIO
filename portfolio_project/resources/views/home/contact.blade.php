<!--Contact Page Start-->
<section id="contact" class="page section-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h2 data-shadow="Contact">Contact</h2><br>
                </div>
            </div>
        </div>
        <div class="row">
            <!--Contact Information Column Start-->
            <div class="col-lg-6 contact-detail">
                <div class="sub-heading mb-20">
                    <h3>Get In Touch</h3><br>
                </div>
                <p class="contact-us">For more information, please get in touch with us using the form opposite. Or you can call and follow our social media.</p><br>
                <ul class="contact-info">
                    <li>
                        <p><span class="material-icons">call</span><span>Phone :&nbsp; &nbsp; </span>+ &nbsp;212 &nbsp;616 &nbsp;4034&nbsp; 54</p>
                    </li>
                    <li>
                        <p><span class="material-icons">email</span><span>Email &nbsp;:&nbsp;</span>&nbsp; lamrinidouae70@mail.com</p>
                    </li>
                </ul>
                <!--social media icons-->
                <div class="social-media">
                    <div class="social-media-icons"><br><br>
                        <a class="social-link" href="https://x.com/DouaeLamri19492">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="social-link" href="https://www.instagram.com/douae._.lamrini/">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="social-link" href="https://www.linkedin.com/in/douae-lamrini/">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a class="social-link" href="https://github.com/DOUAE-LAMRINI">
                            <i class="fab fa-github"></i>
                        </a>
                        <a class="social-link" href="https://fr.pinterest.com/douaelamrini/">
                            <i class="fab fa-pinterest"></i>
                        </a>
                        <a class="social-link" href="https://www.snapchat.com/add/dou-lam">
                            <i class="fab fa-snapchat"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--Contact Information Column End-->
            <!--Contact Form Column Start-->
            <div class="col-lg-6">

                <!-- Contact Form -->
                <form id="contact-form" action="{{ route('contact.form') }}" method="POST">
                    @csrf
                    <!--input field-->
                    <div class="input">
                        <input class="input-field cf-validate" id="cf-name" type="text" name="name" placeholder="Your Name">
                    </div>
                    <!--input field-->
                    <div class="input">
                        <input class="input-field cf-validate" id="cf-email" type="text" name="email" placeholder="Your Email">
                    </div>

                    <!--input field-->
                    <div class="input">
                        <textarea class="input-field cf-validate" id="cf-message" name="message" rows="5" placeholder="Message"></textarea>
                    </div>

                    <div class="alert-container col-md-12"></div>
                    <!-- Display Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Display Validation Errors -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--submit button-->
                    <div class="submit-button text-center">
                        <button class="submition-btn" id="cf-submit">Send Message</button>
                    </div>
                </form>

            </div>
            <!--Contact Form Column End-->
        </div>
        <!--Google Map Row Start-->
        <div class="row">
            <div class="col-md-12 google-map">
                <div id="map" data-latitude="34.655954" data-longitude="-1.888811" data-zoom="16"></div>
            </div>
        </div>
        <!--Google Map Row End-->
    </div>
</section>
<!--Contact Page End-->
</div>