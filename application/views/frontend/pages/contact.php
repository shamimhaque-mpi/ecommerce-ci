<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/contact.css')?>">

<!-- contact section start -->
<section class="contact_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="contact_info">
                    <div class="address">
                        <h2>Where to Find Us</h2>
                        <p>Freelanceitlab, Mymensingh Sadar - 2200</p>
                        <p>Mymensingh, Bangaldesh</p>
                        <a href="https://goo.gl/maps/qGigEfCteyQB21Yi6" target="_blank">On Google Map</a>
                    </div>
                    <article>
                        <h2>Hear our voice</h2>
                        <p>Say hello <a href="tel:01937476716">+880 1937 476716</a></p>
                    </article>
                    <article>
                        <h2>Information</h2>
                        <p><a href="mailto:freelanceitlab@gmail.com"> freelanceitlab@gmail.com</a></p>
                        <p><a href="mailto:info@hello.com">info@hello.com</a></p>
                    </article>
                </div>
            </div>

            <div class="col-md-8">
                <div class="request_form">
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
                    <h2>Reach out to us</h2>
                    <form action="#" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="description">Your Message</label>
                                <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact section end -->
