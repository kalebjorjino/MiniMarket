@extends('layouts.app')

@section('content')
    <div class="container my-4 mb-5">
        <!-- Page title -->
        {{-- <div class="page-title parallax parallax1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title-heading">
                            <h1 class="title">Contacts</h1>
                        </div><!-- /.page-title-heading -->
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div><!-- /.breadcrumbs -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.page-title --> --}}

        <section class="flat-row flat-iconbox">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section">
                            <h2 class="title">
                                Contact Us
                            </h2>
                        </div><!-- /.title-section -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="iconbox text-center">
                            <div class="box-header nomargin">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-content">
                                <p>Purok 1, San Isidro, Hagonoy, 3002 Bulacan</p>
                            </div><!-- /.box-content -->
                        </div><!-- /.iconbox -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4">
                        <div class="divider h0"></div>
                        <div class="iconbox text-center">
                            <div class="box-header">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-content">
                                <p>+639 50 682 4146 / 09190078517</p>
                            </div><!-- /.box-content -->
                        </div><!-- /.iconbox -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4">
                        <div class="divider h0"></div>
                        <div class="iconbox text-center">
                            <div class="box-header">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-content">
                                <p>no-reply@met4-digital.tech</p>
                            </div><!-- /.box-content -->
                        </div><!-- /.iconbox -->
                    </div><!-- /.col-md-4 -->
                </div><!-- /.row -->
                <div class="divider h43"></div>
                <div class="row">
                    <div class="col-md-12 my-3">
                        <div class="flat-map ">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.425102262796!2d120.72973541744385!3d14.857489300000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339651ca93f61871%3A0x7c1d0a6295a834c3!2sSAMJ%20Korean%20Mini-Mart!5e0!3m2!1sen!2sph!4v1680454303934!5m2!1sen!2sph"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.flat-row -->

        <section class="flat-row flat-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section margin_bottom_17">
                            <h2 class="title">
                                Get in Touch
                            </h2>
                        </div><!-- /.title-section -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="wrap-contact">
                        {{-- <form novalidate="" class="contact-form" id="contactform" method="post" action="#">
                            <div class="row">
                                <div class="form-text-wrap clearfix">

                                    <div class="col-lg-4">
                                        <div class="contact-name clearfix">
                                            <label>Name</label>
                                            <input type="text" aria-required="true" size="30" value=""
                                                name="author" id="author">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="contact-email">
                                            <label>Email</label>
                                            <input type="email" size="30" value="" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="contact-subject">
                                            <label>Subject</label>
                                            <input type="text" aria-required="true" size="30" value=""
                                                name="subject" id="subject">
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-message clearfix margin-top-40">
                                    <label>Message</label>
                                    <textarea class="" tabindex="4" name="message" required></textarea>
                                </div>
                                <div class="form-submit margin-top-32 ">
                                    <button class="contact-submit">SEND</button>
                                </div>
                        </form> --}}

                        <form action="#" class="comment-form">
                            <div class="row mt-4">
                                <div class="col-lg-6 mt-4">
                                    <input type="text" id="name" name="name" placeholder="Your name">
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <input type="text" id="email" name="name" placeholder="Your email">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <textarea placeholder="Your message" name="name" id="message"></textarea>
                                    <button type="button" id="submit" name="name" class="red-btn mt-4">Send
                                        message</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.wrap-contact -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.flat-row -->
    </div>
@endsection
@section('script')
    <script>
        $("#submit").click(function() {
            const name = $("#name").val()
            const email = $("#email").val()
            const message = $("#message").val()
            if (name == "" || email == "" || message == "") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "All fields are required!"
                })
            } else {
                const formdata = new FormData()
                formdata.append("name", name)
                formdata.append("email", email)
                formdata.append("message", message)


                axios.post("/contact-us", formdata).then(response => {
                    console.log(response.data)
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "Your inquiry has been submitted successfully!"
                    })
                })
            }

        })
    </script>
@endsection
