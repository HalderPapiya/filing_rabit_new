@extends('frontend.layouts.master')
@section('content')
    <!-- ==================== Banner Section ==================== -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2 data-aos="fade-down" data-aos-duration="1000">REFUND POLICY</h2>
                        <div class="shadow_text">Filingrabbit</div>
                    </div>
                    <a href="{{route('home')}}" class="home">Home</a> / <span>Refund Policy</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Content Section ==================== -->
    <section class="py-4 py-lg-5 product__content">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <p>
                    At FILINGRABBIT, we take pride in the services delivered by us and guarantee your satisfaction with our services and support. We constantly improve and strive to deliver the best accounting, financial or secretarial services through the internet. However, in case you are not satisfied with our services, please contact us immediately and we will correct the situation, provide a refund or offer credit that can be used for future FilingRabbit orders.
                    </p>

                    <ol class="main-ol">
                        @foreach ($refundPolicies as $data)
                        <!-- <li> -->
                            <h3>{{$data->title}}</h3>
                            <p>
                               {!! $data->description !!}
                            </p>
                        <!-- </li> -->
                        @endforeach
                       
                        {{-- <li>
                            <h3>PERSONAL IDENTIFICATION INFORMATION</h3>
                            <p>
                                We may collect personal identification information from Users in a variety of ways,
                                including,
                                but not limited to, when Users visit our site, register on the site, place an order, and
                                in
                                connection with other activities, services, features or resources we make available on
                                our
                                Site.
                                Users may be asked for, as appropriate, name, email address, mailing address, phone
                                number.
                                Users may, however, visit our Site anonymously. We will collect personal identification
                                information from Users only if they voluntarily submit such information to us. Users can
                                always
                                refuse to supply personally identification information, except that it may prevent them
                                from
                                engaging in certain Site related activities.
                            </p>
                        </li>

                        <li>
                            <h3>NON-PERSONAL IDENTIFICATION INFORMATION</h3>
                            <p>
                                We may collect non-personal identification information about Users whenever they
                                interact
                                with
                                our Site. Non-personal identification information may include the browser name, the type
                                of
                                computer and technical information about Users means of connection to our Site, such as
                                the
                                operating system and the Internet service providers' utilized and other similar
                                information.
                            </p>
                        </li>

                        <li>
                            <h3>WEB BROWSER COOKIES</h3>
                            <p>
                                Our Site may use “cookies” to enhance User experience. User's web browser places cookies
                                on
                                their hard drive for record-keeping purposes and sometimes to track information about
                                them.
                                User
                                may choose to set their web browser to refuse cookies, or to alert you when cookies are
                                being
                                sent. If they do so, note that some parts of the Site may not function properly.
                            </p>
                        </li>

                        <li>
                            <h3>HOW WE USE COLLECTED INFORMATION</h3>
                            <p>
                                FilingRabbit may collect and use Users personal information for the following purposes:
                            </p>

                            <ol type="1" class="inner-ol">
                                <li>
                                    <p>
                                        To improve customer service - Information you provide helps us respond to your
                                        customer
                                        service
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        requests and support needs more efficiently.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        To personalize user experience - We may use information in the aggregate to
                                        understand
                                        how our Users
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        as a group use the services and resources provided on our Site.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        To improve our Site - We may use feedback you provide to improve our products
                                        and
                                        services.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        To process payments - We may use the information Users provide about themselves
                                        when
                                        placing an
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        order only to provide service to that order. We do not share this information
                                        with
                                        outside parties
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        except to the extent necessary to provide the service.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        To run a promotion, contest, survey or other Site feature - To send Users
                                        information
                                        they agreed to
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        receive about topics we think will be of interest to them.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        To send periodic emails - We may use the email address to send User information
                                        and
                                        updates
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        pertaining to their order. It may also be used to respond to their inquiries,
                                        questions,
                                        and/or
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        other requests. If User decides to opt-in to our mailing list, they will receive
                                        emails
                                        that
                                        may
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        include company news, updates, related product or service information, etc. If
                                        at
                                        any
                                        time
                                        the User
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        would like to unsubscribe from receiving future emails, we include detailed
                                        unsubscribe
                                        instructions
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        at the bottom of each email or User may contact us via our Site.
                                    </p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>HOW WE PROTECT YOUR INFORMATION</h3>
                            <p>
                                We adopt appropriate data collection, storage and processing practices and security
                                measures
                                to
                                protect against unauthorized access, alteration, disclosure or destruction of your
                                personal
                                information, username, password, transaction information and data stored on our Site.
                            </p>

                            <p>
                                Sensitive and private data exchange between the Site and its Users happens over a SSL
                                secured
                                communication channel and is encrypted and protected with digital signatures.
                            </p>
                        </li>

                        <li>
                            <h3>SHARING YOUR PERSONAL INFORMATION</h3>
                            <p>
                                We may use third party service providers to help us operate our business and the Site or
                                administer activities on our behalf, such as sending out newsletters or surveys. We may
                                share
                                your information with these third parties for those limited purposes provided that you
                                have
                                given us your permission.
                            </p>
                        </li>

                        <li>
                            <h3>GOOGLE ADSENSE</h3>
                            <p>
                                Some of the ads may be served by Google. Google's use of the DART cookie enables it to
                                serve
                                ads
                                to Users based on their visit to our Site and other sites on the Internet. DART uses
                                “non
                                personally identifiable information” and does NOT track personal information about you,
                                such
                                as your name, email address, physical address, etc. You may opt out of the use of the
                                DART
                                cookie by visiting the Google ad and content network privacy policy at
                                http://www.google.com/privacy_ads.html
                            </p>
                        </li>

                        <li>
                            <h3>COMPLIANCE WITH CHILDREN'S ONLINE PRIVACY PROTECTION ACT</h3>
                            <p>
                                Protecting the privacy of the very young is especially important. For that reason, we
                                never
                                collect or maintain information at our Site from those we actually know are under 13,
                                and no
                                part of our website is structured to attract anyone under 13.
                            </p>
                        </li>
                        <li>
                            <h3>CHANGES TO THIS PRIVACY POLICY</h3>
                            <p>
                                FilingRabbit.in have the discretion to update this privacy policy at any time. When we
                                do,
                                we
                                will send you an email. We encourage Users to frequently check this page for any changes
                                to
                                stay informed about how we are helping to protect the personal information we collect.
                                You
                                acknowledge and agree that it is your responsibility to review this privacy policy
                                periodically and become aware of modifications.
                            </p>
                        </li> --}}

                     
                    </ol>

                </div>
            </div>
        </div>
    </section>
@endsection

