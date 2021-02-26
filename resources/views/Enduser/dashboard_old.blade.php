@extends('Enduser.layouts.app')

@section('content')
<div class="main_container padding_topTwo"   style="padding-top: 0px;">
    <div class="banner home_banner">
        <figure><img src="{{asset('future_html/images/home_banner_final.jpg')}}" alt="banner"></figure>
        <div class="banner_content">
            <div class="auto_container">
                <div class="main_banner">
                    <div class="top_logos">
                        <ul>
                            <li>
                                <a href="javascript:void(0);">
                                    <img src="{{asset('future_html/images/future_fair.png')}}" alt="logo">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <img src="{{asset('future_html/images/company_logos/company1.png')}}" alt="logo">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="comapny_logos">
                        <ul>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company2.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company3.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company4.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company5.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company6.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company7.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company8.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company9.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company10.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company11.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company12.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company13.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company14.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company15.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company16.png')}}" alt="logo"></a>
                                </div>
                            </li>
                            <li>
                                <div class="logos_main">
                                    <a href="#"><img src="{{asset('future_html/images/company_logos/company1.png')}}" alt="logo"></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="my_description">
                        <h1>
                            A Global Virtual Event Solution.
                        </h1>
                        <p>A Global Virtual Event Solution For Everyone.
                            The COVID-19 coronavirus has challenged event planners to find education and networking opportunities that don’t rely on in-person events. Connect attendees from anywhere in the world through virtual, hybrid, and in-person events. Build Buzz and Engage with Prospects Through an Immersive Online Trade Show. Leverage a gorgeous virtual space for your biggest trade show yet, with customizable exhibitor booths, on-demand content, chat forums, and convenient online order placement.</p>

                            </div>
                            <div class="row">
                              <div class="col"></div>
                                <div class="col-6 mt-3 pb-5" style="border-radius: 25px;
                                background-color: black; opacity: 0.7; color: #14ff47;">
                                  <events-select :events="{{$events}}"></events-select>
                                </div>
                               <div class="col"></div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="arrow_scroll">
                    <a id="animate_arrow" href="javascript:void(0);"><img src="{{asset('future_html/images/arow_down.png')}}" alt="img"></a>
                </div>
            </div>
        </div>
        @endsection
