@extends('frontend.layouts.master')
@section('content')
    <!-- ==================== Banner Section ==================== -->
    <section class="py-4 py-lg-5 product-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1">
                    <h1>{{$product->name}}</h1>
                    <div class="variations">
                        <h6>Package</h6>
                        <ul class="d-flex">
                            <li class="active">{{$product->type_one_name}}</li>
                            <li>{{$product->type_two_name}}</li>
                            <!-- <li>Prime</li> -->
                        </ul>
                    </div>
                    <p>{!! $product->type_one_description !!}
                        
                        <!-- Copyright registrations for logos, books, periodicals & magazines. Inclusive of government fee &
                        taxes -->
                    </p>
                    <div class="price">
                        <span> &#x20B9; {{$product->type_one_price}}/-</span>
                    </div>
                    <button class="btn w-auto ur-submit-button">Purchase</button>
                </div>
                <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                    <img class="img-fluid" src="img/product.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Product Details Section ==================== -->
    <section class="py-4 py-lg-5 product__content">
        <div class="container">
            <div class="row">
                @foreach( $productDes as $des)
                <div class="col-12">
                    <h2 class="blue-heading text-left">Copyright Registration</h2>
                    <h3>What is a copyright?</h3>
                    <p>
                        Copyright is an intellectual property right that provides protection for literary, dramatic,
                        musical, and artistic works. By getting a copyright registration, the creator/author becomes a
                        legal owner of the copyrighted work. A copyright gives the author several commercial and moral
                        rights.
                    </p>
                    <p>
                        {{$des->description}}
                        Registration of copyright is necessary for an author for the creative work to be reproduced,
                        translated, adapted, and communicated to the public. Copyright is an exclusive right to enjoy
                        the benefits arising from one's own creative work, and no other creator can infringe on those
                        rights. A copyright protection is granted for a time period of 60 years.
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==================== Product Details Section ==================== -->
    <section class="py-4 py-md-5 product__content light-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>WHAT IS THE COPYRIGHT REGISTRATION PROCESS?</h3>
                    <p>
                        Although a creator enjoys copyright over the works ever since the work comes into existence,
                        legal registration of copyright provides legal protection and benefits. The process for
                        registration of a copyright is as follows:
                    </p>
                    <ul>
                        <li>
                            <p>
                                <span>Application:</span> An application for copyright registration is made to the
                                Copyright Office using Form-XIV, submitted along with a prescribed fee for that
                                particular type or work. This form contains all the particulars related to the work and
                                the applicant and can be used for both published and unpublished works.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Submission:</span> The forms are attested by the Applicant. A Power of Attorney
                                must be executed if the applicant is being represented by a legal person. All the
                                documents are submitted to the Registry.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Diary Number:</span> A diary number is issued after the application is filed for
                                registration.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Examination:</span> The application is examined by the Examiner within 30 days
                                from the issue of diary number, and any objections or discrepancies which might arise,
                                are highlighted.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Notice:</span> In case an objection arises, a notice is issued to both the
                                parties. The applicant must reply to the objections within 30 days from the date of
                                issue of the notice. If the examiner is not satisfied by the reply to the objections, a
                                hearing might be called for.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Certificate:</span> A copyright is registered after the objections and
                                discrepancies are removed. A registration certificate is issued for the copyright.
                            </p>
                        </li>
                    </ul>

                    <img class="img-800" src="img/image1.gif" alt="">

                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Product Details Section ==================== -->
    <section class="py-4 py-md-5 product__content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>WHAT ARE THE RIGHTS OF A COPYRIGHT OWNER?</h3>
                    <ul>
                        <li>
                            <p>
                                <span>Right to integrity:</span> An author/creator of a work has moral rights, which are
                                non-transferable, and arises as soon as the work is completed. The right of paternity
                                and right to integrity comprise the moral rights of an author. Under these rights, the
                                author has the sole authorship over the work. Also, the author has the right to claim
                                damage over modification, mutilation, or distortion of the original creation.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Right to distribute:</span> A copyright owner can distribute the work using the
                                mode of choice to as many people as they want. This right can also be licensed to a
                                third party as per the author's wish.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Right to reproduce/adapt:</span> Copyright being an exclusive legal right, does
                                not allow anyone to reproduce or adapt the author's work without permission.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Right to performance:</span> Copyright owners can perform their artistic, musical
                                and dramatic works in the public and no one else can do so without their authorization.
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>Right to broadcast:</span> The owner of the copyright can broadcast the work over
                                television or radio, or whatever medium suitable, to the public.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-12 mt-4">
                    <h3>WHAT CAN BE COPYRIGHTED?</h3>
                    <p>
                        The original works can be provided copyright protection under the following three types:
                    </p>

                    <ul>
                        <li>
                            <p>
                                Literary, Dramatic. Musical, and Artistic works like books, music, painting, sculpture,
                                etc.
                            </p>
                        </li>
                        <li>
                            <p>
                                Cinematography Films that consist of any work of visual recording on any medium.
                            </p>
                        </li>
                        <li>
                            <p>
                                Sound recordings that consist of a recording of sounds, regardless of the medium on
                                which such
                            </p>
                        </li>
                        <li>
                            <p>
                                recording is made or the method by which the sound is produced.
                            </p>
                        </li>
                        <li>
                            <p>
                                License to communicate any work to the public by Broadcast.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Product Details Section ==================== -->
    <section class="py-4 py-md-5 product__content light-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>WHAT ARE THE DOCUMENTS/INFORMATION REQUIRED FOR COPYRIGHT REGISTRATION?</h3>
                </div>
                <div class="col-12 col-lg-6">
                    <h5>Documents</h5>
                    <ul>
                        <li>
                            <p>
                                Copies of the work for which a copyright must be filed
                            </p>
                        </li>
                        <li>
                            <p>
                                A Power of Attorney signed by the applicant in whose name the application will be filed;
                            </p>
                        </li>
                        <li>
                            <p>
                                No-objection letter from the author of the work
                            </p>
                        </li>
                        <li>
                            <p>
                                Udyam Certificate (If applicant is a MSME)
                            </p>
                        </li>
                        <li>
                            <p>
                                BOARD RESOLUTION (If applicant is a Pvt/Public Ltd. Co)
                            </p>
                        </li>
                        <li>
                            <p>
                                Aadhar Card of the Applicant
                            </p>
                        </li>
                        <li>
                            <p>
                                Startup Certificate (if applicant is a start-up recognised by DPIIT)
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <h5>Information</h5>
                    <ul>
                        <li>
                            <p>
                                Copies of the work for which a copyright must be filed
                            </p>
                        </li>
                        <li>
                            <p>
                                A Power of Attorney signed by the applicant in whose name the application will be filed;
                            </p>
                        </li>
                        <li>
                            <p>
                                No-objection letter from the author of the work
                            </p>
                        </li>
                        <li>
                            <p>
                                Udyam Certificate (If applicant is a MSME)
                            </p>
                        </li>
                        <li>
                            <p>
                                BOARD RESOLUTION (If applicant is a Pvt/Public Ltd. Co)
                            </p>
                        </li>
                        <li>
                            <p>
                                Aadhar Card of the Applicant
                            </p>
                        </li>
                        <li>
                            <p>
                                Startup Certificate (if applicant is a start-up recognised by DPIIT)
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Product Details Section ==================== -->
    <section class="py-4 py-md-5 product__content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>When can a copyrighted work be used without Permission?</h3>
                    <p>
                        To protect users' interests, some exemptions have been prescribed in respect of specific uses of
                        works enjoying copyright. Some of the exemptions are the uses of the work,
                    </p>
                    <ul>
                        <li>
                            <p>
                                For research or private study,
                            </p>
                        </li>
                        <li>
                            <p>
                                For criticism or review
                            </p>
                        </li>
                        <li>
                            <p>
                                In connection with a judicial proceeding
                            </p>
                        </li>
                        <li>
                            <p>
                                For performance by an amateur club or society, if the performing for a non-paying
                                audience and
                            </p>
                        </li>
                        <li>
                            <p>
                                The making of sound recordings of literary, dramatic, or musical works under certain
                                conditions.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Product FAQ ==================== -->
    <section class="py-4 py-md-5 faq">
        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    <h2 class="blue-heading pb-4 text-left">FAQ</h2>
                    <div class="acc">
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Is Copyright protection valid only in India?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                <p>
                                    India is a part of the Berne Convention, therefore, a copyrighted work in India
                                    would be protected as foreign work in other participant countries to the Berne
                                    Convention.
                                </p>
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Can names be copyrighted?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                Only original and creative works can be given copyright protection.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Can I transfer my copyright?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                Yes, transfer of copyright is possible though selling or licensing.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    How long does it take to obtain a copyright registration?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                It can be obtained within 6 to 8 months.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Is publishing of the work required to get a registration?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                No, both published and unpublished work can get copyright protection. With published
                                works, details of publishing are required.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Can a copyright application get rejected?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                Yes, the Examiner might reject an application after an unsatisfactory reply to a discrepancy.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    Who can obtain copyright protection?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                Any person or a business entity can obtain copyright registration. An individual can be an author, creator, musician, photographer, producer, painter, composer, or company.
                            </div>
                        </div>
                        <div class="acc__card">
                            <div class="acc__title">
                                <h4>
                                    What to do if my copyright is infringed?
                                    <i class="fas fa-angle-right"></i>
                                </h4>
                            </div>
                            <div class="acc__panel">
                                A copyright holder has to send a statutory notice to the person who has infringed the work.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
