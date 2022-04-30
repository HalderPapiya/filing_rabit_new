@extends('frontend.layouts.master')
@section('content')
<section class="blog-detail pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <img class="img-thumbnail border-0 p-0"
                        {{-- src="https://filingrabbit.in/wp-content/uploads/2021/05/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.png"> --}}
                        src="{{URL::to('/').'/uploads/blog/'}}{{$blog->image}}" >
                    <div class="card-body">
                        <h5 class="card-title">
                            {{$blog->title}} </h5>
                        <h6 class="card-subtitle">
                            <i class="fa fa-calendar mr-2 text-grey"></i>
                            {{-- {{$blog->created_at}} --}}
                            {{date("  M d,Y", strtotime($blog->created_at))}}
                            {{-- April 22,2021 --}}
                        </h6>
                        <div class="py-3">
                            {!!$blog->description!!}
                            {{-- <p>
                                Trademark is one among the kinds of property within the area of product and
                                services. In general, the trademark services identifies as service marks. The
                                trademark owner can be anyone may be a person, an organization, or a legal entity
                                who is in the business of manufacturing and development area. Package, label, name,
                                word, phrase, logo, symbol, design, image, or voucher are the kinds during which
                                styles trademark are often found. When a trademark gets registered it is an
                                untouchable asset for future business and company investment. It is not a new
                                concept. This started within the history of the Romanian empire when the blacksmiths
                                made swords they want to make a selected logo or design thereon sword so it are
                                often identified. But in the new era, some rules vary from the country by country
                                regarding intellectual property. Each country has its own value in intellectual
                                property. Sometimes history, geography, economy, and politics can also affect them.
                                The internationally only symbol or trademark is unique. In general, we can see an
                                'R' in a circle or 'TM' in the square as a trademark symbol. Now in India online
                                trademark registration is possible. But you can file it offline also in the
                                trademark registration office of government which is 'Controller general of patent,
                                design, and trademark', 'Ministry of commerce and industry, 'Government of India'.
                                Registered trademark leads to good advertisement and services. Trademark
                                registration requires some legal and original documents except this the registration
                                procedure is simple but after the registration, real patience is required.
                            </p>
                            <p>
                                <strong>Search for the trademarks</strong> - When you start a business you will
                                already have the name
                                of your business in your mind. But it's really arduous to get a unique name with a
                                unique business. So, the primary search if you've got an identical business name
                                with anyone. It will offer you forewarning of the likelihood of the trademarks.
                                Because it will be a waste of money if it is trademark ligitation and it will be a
                                lot of time-consuming. So it's better than we are prepared in advanced. By doing
                                this your business will be unique in this digital world with a unique name. So, one
                                piece of advice is also there that be creative and simple so people can remember you
                                very easily.
                            </p>
                            <p>
                                <strong>Trademark Application</strong> - When you chose the correct brand name which is not
                                registered in the trademark previously you are good to go further. You have to file
                                the trademark registration application under the trademark registry of your country.
                                Nowadays these applications can be filed offline and online also. You will get an
                                instantaneous receipt for future preference. This process can be done in some
                                minutes it will not take more time.
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
