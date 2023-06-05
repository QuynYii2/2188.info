@extends('frontend.layouts.master')

@section('title', 'Home page')

@section('content')
    <style>
        .vertical-menu {
            width: 100%;
        }

        .vertical-menu .navbar-nav {
            display: block;
        }

        .vertical-menu .nav-item {
            background: #ffffff;
        }

        li {
            list-style: none;
        }

        .vertical-menu .nav-link {
            color: #757575;
            padding: 10px;
        }

        /* CSS cho megamenu */
        .megamenu {
            display: none;
        }

        .vertical-menu .nav-item:hover .megamenu {
            display: block;
            position: absolute;
            top: 8px;
            left: 94%;
            z-index: 999;
            width: 700px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
            height: 350px;
        }

        .megamenu a:hover, a:focus {
            color: #e7ab3c;
            font-weight: 500;
        }

        .depart-hover li:hover .megamenu {
            display: block;
            position: absolute;
            top: 8px;
            left: 94%;
            z-index: 999;
            width: 700px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
        }

        .depart-hover .megamenu li a {
            padding-left: 0 !important;
        }

        .img-banner-1 {
            /*height: 30vw;*/
            margin-top: -30px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
        }

        .tablet-button {
            display: none;
        }

        @media only screen and (min-width: 1200px) {

        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {

        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .menu-header {
                margin-right: -8px;
                margin-left: 8px;
                max-width: 30% !important;
            }

            .mega-menu-header {
                margin-right: -8px;
                margin-left: 8px;
            }

            .menu-bottom {
                max-width: 20% !important;
            }
        }

        @media (max-width: 767px) {
            .height-banner {
                height: 40vw;
                width: 100%;
            }

        }

        @media (min-width: 768px) {
            .height-banner {
                height: 30vw;
            }
        }

        @media only screen and (max-width: 480px) {
            .filter-control .mr-5 {
                margin-right: 0 !important;
            }

            .filter-control .ml-5 {
                margin-left: 0 !important;
            }
        }

        @media only screen and (min-width: 481px ) and  (max-width: 939px) {
            .tablet-button {
                display: block;
            }

            .not-tablet-button {
                display: none !important;
            }
        }

        @media not (min-width: 481px ) and  (max-width: 939px) {
            .tablet-button {
                display: none;
            }

            .not-tablet-button {
                display: block !important;
            }
        }

    </style>
   <div class="" id="body-content">
       <!-- Hero Section Begin -->

       <section class="header_bottom">
           <div class="container-fluid" id="nav-header">
               <div class="row">
                   <div class="col-lg-3 col-md-3 col-12 col-xl-2 menu-header desktop-button">
                       <nav class="navbar navbar-expand-lg mega-menu-header"
                            style="padding: 0; width: 100%; align-items: start">
                           <div class="vertical-menu">
                               <ul class="navbar-nav" id="side-cate" style="overflow-y: scroll; ">
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit " href="#"><i class="fa fa-laptop"
                                                                                               aria-hidden="true"></i>&ensp;
                                           Electronic Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="/category/1"><i
                                                   class="fa fa-television"
                                                   aria-hidden="true"></i>&ensp;
                                           TV & Home Appliances</a>
                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-laptop"
                                                                                              aria-hidden="true"></i>&ensp;
                                           Electronic Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-television"
                                                                                              aria-hidden="true"></i>&ensp;
                                           TV & Home
                                           Appliances</a>
                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-laptop"
                                                                                              aria-hidden="true"></i>&ensp;
                                           Electronic
                                           Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit " href="#"><i class="fa fa-laptop"
                                                                                               aria-hidden="true"></i>&ensp;
                                           Electronic Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="/category/1"><i
                                                   class="fa fa-television"
                                                   aria-hidden="true"></i>&ensp;
                                           TV & Home Appliances</a>
                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-laptop"
                                                                                              aria-hidden="true"></i>&ensp;
                                           Electronic Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="/category/1">All-In-One</a></li>
                                                       <li><a href="/category/1">Gaming Desktops</a></li>
                                                       <li><a href="/category/1">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Traditional Laptops</a></li>
                                                       <li><a href="/category/1">Gaming Laptops</a></li>
                                                       <li><a href="/category/1">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="/category/1">Headphones & Headsets</a></li>
                                                       <li><a href="/category/1">Portable Speakers</a></li>
                                                       <li><a href="/category/1">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-television"
                                                                                              aria-hidden="true"></i>&ensp;
                                           TV & Home
                                           Appliances</a>
                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-laptop"
                                                                                              aria-hidden="true"></i>&ensp;
                                           Electronic
                                           Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-television"
                                                                                              aria-hidden="true"></i>&ensp;
                                           TV & Home
                                           Appliances</a>
                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-laptop"
                                                                                              aria-hidden="true"></i>&ensp;
                                           Electronic
                                           Devices</a>
                                       <div class="megamenu">
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                           <hr>
                                           <div class="row">
                                               <div class="col-sm-4">
                                                   <h5>Desktops Computers</h5>
                                                   <ul>
                                                       <li><a href="#">All-In-One</a></li>
                                                       <li><a href="#">Gaming Desktops</a></li>
                                                       <li><a href="#">DIY</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Laptops</h5>
                                                   <ul>
                                                       <li><a href="#">Traditional Laptops</a></li>
                                                       <li><a href="#">Gaming Laptops</a></li>
                                                       <li><a href="#">2-in-1s</a></li>
                                                   </ul>
                                               </div>
                                               <div class="col-sm-4">
                                                   <h5>Audio</h5>
                                                   <ul>
                                                       <li><a href="#">Headphones & Headsets</a></li>
                                                       <li><a href="#">Portable Speakers</a></li>
                                                       <li><a href="#">Home Audio</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                                   </li>
                                   <li class="border-bottom"></li>
                                   <li class="nav-item d-grid">
                                       <a class="nav-link text-nowrap text-limit" href="#"><i class="fa fa-television"
                                                                                              aria-hidden="true"></i>&ensp;
                                           TV & Home
                                           Appliances</a>
                                   </li>
                               </ul>
                           </div>
                       </nav>

                   </div>
                   <div class="col-lg-6 col-md-6 col-12 col-xl-7 mb-2 not-tablet-button">
                       <!-- Hero Section Begin -->
                       <section class="slider-section">
                           <div class="carousel slide" data-ride="carousel">
                               <div class="carousel-inner mt-1" id="carousel__1" role="listbox">
                                   <div class="carousel-item active img-banner-1 img height-banner"
                                        style="background-image: url('{{asset('images/img/banner1.jpeg')}}');">
                                   </div> <!-- End of Carousel Item -->

                                   <div class="carousel-item img-banner-1 img height-banner"
                                        style="background-image: url('{{asset('images/img/banner2.png')}}');">
                                   </div> <!-- End of Carousel Item -->
                               </div> <!-- End of Carousel Content -->

                               <!-- Previous & Next -->
                               <a href="#carousel" class="carousel-control-prev" role="button" data-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="sr-only"></span>
                               </a>
                               <a href="#carousel" class="carousel-control-next" role="button" data-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="sr-only"></span>
                               </a>
                           </div> <!-- End of Carousel -->
                       </section>
                       <!-- Hero Section End -->
                   </div>
                   <div class="col-lg-3 col-md-3 col-12 mt-2 menu-bottom not-tablet-button" id="mini-img">
                       <div class="single-banner mb-3">
                           <img class="img" src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}"
                                alt=""
                                height="100%">
                       </div>

                       <div class="single-banner mb-3">
                           <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt=""
                                height="100%">
                       </div>

                       <div class="single-banner">
                           <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt="" height="100%">
                       </div>
                   </div>

                   <div class="col-lg-9 col-md-9 col-12 col-xl-10 tablet-button">
                       <div class="row" id="carousel__2">
                           <div class="col-lg-8 col-md-12 col-12 col-xl-7">
                               <!-- Hero Section Begin -->
                               <section class="slider-section">
                                   <div id="carousel2" class="carousel slide" data-ride="carousel">
                                       <div class="carousel-inner mt-1" role="listbox">
                                           <div class="carousel-item active img-banner-1 img height-banner"
                                                style="background-image: url('{{asset('images/img/banner1.jpeg')}}');">
                                           </div> <!-- End of Carousel Item -->

                                           <div class="carousel-item img-banner-1 img height-banner"
                                                style="background-image: url('{{asset('images/img/banner2.png')}}');">
                                           </div> <!-- End of Carousel Item -->
                                       </div> <!-- End of Carousel Content -->

                                       <!-- Previous & Next -->
                                       <a href="#carousel2" class="carousel-control-prev" role="button" data-slide="prev">
                                           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                           <span class="sr-only"></span>
                                       </a>
                                       <a href="#carousel2" class="carousel-control-next" role="button" data-slide="next">
                                           <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                           <span class="sr-only"></span>
                                       </a>
                                   </div> <!-- End of Carousel -->
                               </section>
                               <!-- Hero Section End -->
                           </div>
                           <div class="col-md-12 mt-2">
                               <div class="row">
                                   <div class="col-md-4">
                                       <div class="">
                                           <img class="img"
                                                src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}"
                                                alt=""
                                                height="100%">
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="">
                                           <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt=""
                                                height="100%">
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="">
                                           <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt=""
                                                height="100%">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- Hero Section End -->

       <!-- Women Banner Section Begin -->
       <section class="man-banner mt-2 spade">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-2 ">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                           <h2>Women’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Women’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
                   <div class="col-lg-8">
                       <div class="product-slider owl-carousel">
                           @foreach($productByLocal as $product)
                               <div class="row ">
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Women’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                           <h2>Women’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- Women Banner Section End -->

       <section class="deal-of-week set-bg spad" data-setbg="{{asset('images/img/time-bg.jpg')}}">
           <div class="container">
               <div class="col-lg-6 text-center">
                   <div class="section-title">
                       <h2>Deal Of The Week</h2>
                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br/> do ipsum dolor sit amet,
                           consectetur adipisicing elit </p>
                       <div class="product-price">
                           $35.00
                           <span>/ HanBag</span>
                       </div>
                   </div>
                   <div class="countdown-timer" id="countdown">
                       <div class="cd-item">
                           <span>56</span>
                           <p>Days</p>
                       </div>
                       <div class="cd-item">
                           <span>12</span>
                           <p>Hrs</p>
                       </div>
                       <div class="cd-item">
                           <span>40</span>
                           <p>Mins</p>
                       </div>
                       <div class="cd-item">
                           <span>52</span>
                           <p>Secs</p>
                       </div>
                   </div>
                   <a href="#" class="primary-btn">Shop Now</a>
               </div>
           </div>
       </section>

       <section class="man-banner spad">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
                   <div class="col-lg-8">
                       <div class="filter-control d-flex justify-content-between">
                           <ul class="ml-5">
                               <li><img class="img border" width="60px" height="40px"
                                        src="{{ asset('images/korea.png') }}" alt=""></li>
                           </ul>
                           <ul class="mr-5">
                               <li><a class="link-read-more"
                                      href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                           </ul>
                       </div>
                       <div class="product-slider owl-carousel">
                           @foreach($productByKr as $product)
                               <div class="row ">
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <section class="man-banner spad">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
                   <div class="col-lg-8">
                       <div class="filter-control d-flex justify-content-between">
                           <ul class="ml-5">
                               <li><img class="img border" width="60px" height="40px"
                                        src="{{ asset('images/japan.webp') }}" alt=""></li>
                           </ul>
                           <ul class="mr-5">
                               <li><a class="link-read-more"
                                      href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                           </ul>
                       </div>
                       <div class="product-slider owl-carousel">
                           @foreach($productByJp as $product)
                               <div class="row ">
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <section class="man-banner spad">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
                   <div class="col-lg-8">
                       <div class="filter-control d-flex justify-content-between">
                           <ul class="ml-5">
                               <li><img class="img" width="60px" height="40px" src="{{ asset('images/china.webp') }}"
                                        alt=""></li>
                           </ul>
                           <ul class="mr-5">
                               <li><a class="link-read-more"
                                      href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                           </ul>
                       </div>
                       <div class="product-slider owl-carousel">
                           @foreach($productByCn as $product)
                               <div class="row">
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                                   {{--                                        <span>$35.00</span>--}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="product-item">
                                           <div class="pi-pic">
                                               <img class="img" src="{{$product->thumbnail}}" alt="">
                                               <div class="sale">Sale</div>
                                               <div class="icon">
                                                   <i class="icon_heart_alt"></i>
                                               </div>
                                           </div>
                                           <div class="pi-text">
                                               <div class="catagory-name">{{$product->category->name}}</div>
                                               <a href="{{route('detail_product.show', $product->id)}}">
                                                   <h5>{{$product->name}}</h5>
                                               </a>
                                               <div class="product-price">
                                                   ${{$product->price}}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
                   <div class="col-lg-2">
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                       <div class="product-large set-bg m-large"
                            data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                           <h2>Men’s</h2>
                           <a href="#">Discover More</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>

       <section class="latest-blog spad">
           <div class="container">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="section-title">
                           <h2>From The Blog</h2>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-lg-4 col-md-6">
                       <div class="single-latest-blog">
                           <img class="img" src="{{asset('images/img/latest-1.jpg')}}" alt="">
                           <div class="latest-text">
                               <div class="tag-list">
                                   <div class="tag-item">
                                       <i class="fa fa-calendar-o"></i>
                                       May 4,2019
                                   </div>
                                   <div class="tag-item">
                                       <i class="fa fa-comment-o"></i>
                                       5
                                   </div>
                               </div>
                               <a href="#">
                                   <h4>The Best Street Style From London Fashion Week</h4>
                               </a>
                               <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="single-latest-blog">
                           <img class="img" src="{{asset('images/img/latest-2.jpg')}}" alt="">
                           <div class="latest-text">
                               <div class="tag-list">
                                   <div class="tag-item">
                                       <i class="fa fa-calendar-o"></i>
                                       May 4,2019
                                   </div>
                                   <div class="tag-item">
                                       <i class="fa fa-comment-o"></i>
                                       5
                                   </div>
                               </div>
                               <a href="#">
                                   <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                               </a>
                               <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="single-latest-blog">
                           <img class="img" src="{{asset('images/img/latest-3.jpg')}}" alt="">
                           <div class="latest-text">
                               <div class="tag-list">
                                   <div class="tag-item">
                                       <i class="fa fa-calendar-o"></i>
                                       May 4,2019
                                   </div>
                                   <div class="tag-item">
                                       <i class="fa fa-comment-o"></i>
                                       5
                                   </div>
                               </div>
                               <a href="#">
                                   <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                               </a>
                               <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="benefit-items">
                   <div class="row">
                       <div class="col-lg-4">
                           <div class="single-benefit">
                               <div class="sb-icon">
                                   <img class="img" src="{{asset('images/img/icon-1.png')}}" alt="">
                               </div>
                               <div class="sb-text">
                                   <h6>Free Shipping</h6>
                                   <p>For all order over 99$</p>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="single-benefit">
                               <div class="sb-icon">
                                   <img class="img" src="{{asset('images/img/icon-2.png')}}" alt="">
                               </div>
                               <div class="sb-text">
                                   <h6>Delivery On Time</h6>
                                   <p>If good have prolems</p>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="single-benefit">
                               <div class="sb-icon">
                                   <img class="img" src="{{asset('images/img/icon-3.png')}}" alt="">
                               </div>
                               <div class="sb-text">
                                   <h6>Secure Payment</h6>
                                   <p>100% secure payment</p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </div>

    <script>
        let side_cate = document.getElementById('side-cate');
        let carousel_1 = document.getElementById('carousel__1');
        let carousel_2 = document.getElementById('carousel__2');

        let h_car_1 = carousel_1.offsetHeight;
        let h_car_2 = carousel_2.offsetHeight;

        console.log(h_car_1);
        console.log(h_car_2);

        let heightB = h_car_1 !== 0 ? h_car_1 : h_car_2;
        side_cate.style.height = heightB + 'px';

    </script>
@endsection