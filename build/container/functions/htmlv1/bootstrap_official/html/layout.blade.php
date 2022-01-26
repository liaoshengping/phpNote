<!-- Header Section Start -->
<div class="header section">


    <!-- Header Bottom Start -->
    <div class="header-bottom">
        <div class="header-sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- Header Logo Start -->
                    <div class="col-md-2 col-lg-2 col-xl-2 col-6">
                        <div class="header-logo">
                            <a href="/"><img src="{{$logo}}" alt="Site Logo"/></a>
                        </div>
                    </div>
                    <!-- Header Logo End -->

                    <!-- Header Menu Start -->
                    <div class="col-lg-8 d-none d-lg-block">

                        <div class="main-menu">
                            <ul>

                                @foreach($menus as $item)

                                    @if(!empty($item['sub']))
                                        <li class="has-children">
                                            <a href="#">{{$item['name']}} <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub-menu">

                                                @foreach($item['sub'] as $sub_item)
                                                    <li><a href="{{$sub_item['href']}}">{{$sub_item['name']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{$item['href']}}">{{$item['name']}}</a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>

                    </div>
                    <!-- Header Menu End -->

                    <!-- Header Action Start -->
                    <div class="col-md-2 col-lg-2 col-xl-2 col-6 justify-content-end">
                        <div class="header-actions">


                            <a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid;border-radius: 20px;">注册登录</button></a>

                            <!-- Mobile Menu Hambarger Action Button Start -->
                            <a href="javascript:void(0)"
                               class="header-action-btn header-action-btn-menu d-lg-none d-md-block">
                                <i class="fa fa-bars"></i>
                            </a>
                            <!-- Mobile Menu Hambarger Action Button End -->

                        </div>
                    </div>
                    <!-- Header Action End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom End -->

    <!-- Offcanvas Search Start -->

    <!-- Offcanvas Search End -->

    <!-- Cart Offcanvas Start -->
    <div class="cart-offcanvas-wrapper">
        <div class="offcanvas-overlay"></div>

        <!-- Cart Offcanvas Inner Start -->
        <div class="cart-offcanvas-inner">

            <!-- Button Close Start -->
            <div class="offcanvas-btn-close">
                <i class="pe-7s-close"></i>
            </div>
            <!-- Button Close End -->

            <!-- Offcanvas Cart Content Start -->
            <div class="offcanvas-cart-content">

                <!-- Cart Product/Price Start -->
                <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                    <!-- Single Cart Product Start -->
                    <div class="single-cart-product">
                        <div class="cart-product-thumb">
                            <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg"
                                                               alt="Cart Product"></a>
                        </div>
                        <div class="cart-product-content">
                            <h3 class="title"><a href="single-product.html">New badge product</a></h3>
                            <div class="product-quty-price">
                                <span class="cart-quantity">3 <strong> × </strong></span>
                                <span class="price">
											<span class="new">$70.00</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Cart Product End -->

                    <!-- Product Remove Start -->
                    <div class="cart-product-remove">
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                    <!-- Product Remove End -->

                </div>
                <!-- Cart Product/Price End -->

                <!-- Cart Product/Price Start -->
                <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                    <!-- Single Cart Product Start -->
                    <div class="single-cart-product">
                        <div class="cart-product-thumb">
                            <a href="single-product.html"><img src="assets/images/products/small-product/2.jpg"
                                                               alt="Cart Product"></a>
                        </div>
                        <div class="cart-product-content">
                            <h3 class="title"><a href="single-product.html">Soldout new product</a></h3>
                            <div class="product-quty-price">
                                <span class="cart-quantity">4 <strong> × </strong></span>
                                <span class="price">
											<span class="new">$80.00</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Cart Product End -->

                    <!-- Product Remove Start -->
                    <div class="cart-product-remove">
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                    <!-- Product Remove End -->

                </div>
                <!-- Cart Product/Price End -->

                <!-- Cart Product/Price Start -->
                <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                    <!-- Single Cart Product Start -->
                    <div class="single-cart-product">
                        <div class="cart-product-thumb">
                            <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg"
                                                               alt="Cart Product"></a>
                        </div>
                        <div class="cart-product-content">
                            <h3 class="title"><a href="single-product.html">New badge product</a></h3>
                            <div class="product-quty-price">
                                <span class="cart-quantity">2 <strong> × </strong></span>
                                <span class="price">
											<span class="new">$50.00</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <!-- Single Cart Product End -->

                    <!-- Product Remove Start -->
                    <div class="cart-product-remove">
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                    <!-- Product Remove End -->

                </div>
                <!-- Cart Product/Price End -->

                <!-- Cart Product Total Start -->
                <div class="cart-product-total mb-4 pb-4 border-bottom">
                    <span class="value">Total</span>
                    <span class="price">220$</span>
                </div>
                <!-- Cart Product Total End -->

                <!-- Cart Product Button Start -->
                <div class="cart-product-btn mt-4">
                    <a href="cart.html" class="btn btn-light btn-hover-primary w-100"><i
                                class="fa fa-shopping-cart"></i> View cart</a>
                    <a href="checkout.html" class="btn btn-light btn-hover-primary w-100 mt-4"><i
                                class="fa fa-share"></i> Checkout</a>
                </div>
                <!-- Cart Product Button End -->

            </div>
            <!-- Offcanvas Cart Content End -->

        </div>
        <!-- Cart Offcanvas Inner End -->
    </div>
    <!-- Cart Offcanvas End -->

</div>
<!-- Header Section End -->

【content】

<!-- Footer Section Start -->
<footer class="section footer-section">
    <!-- Footer Top Start -->
    <div class="footer-top bg-gray section-padding">
        <div class="container">
            <div class="row mb-n8">

                <div class="col-12 col-sm-6 col-lg-2 mb-8">
                    <div class="single-footer-widget aos-init aos-animate">
                        <div>
                            <img src="{{config('logo')}}">
                        </div>
                        <div class="widget-slogan bg-white">
                            {{config('slogan')}}
                        </div>
                    </div>
                </div>

                @foreach(config('footer_urls') as $items)
                    <div class="col-12 col-sm-6 col-lg-2 mb-8">
                        <div class="single-footer-widget aos-init aos-animate">
                            <h2 class="widget-title">{{$items['name']}}</h2>
                            <ul class="widget-list">
                                @foreach($items['items'] as $item)
                                    <li><a href="{{$item['url']}}">{{$item['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

{{--                二维码--}}
                <div class="col-12 col-sm-6 col-lg-2 mb-8">
                    <div class="single-footer-widget aos-init aos-animate d-flex flex-column align-items-center">
                        <div><h6>全国统一服务热线</h6></div>
                        <div><h5>4000-526-528</h5></div>
                        <div>
                            <img src="{{config('qrCode')}}">
                        </div>
                        <div>扫码关注微信公众号</div>
                    </div>
                </div>
                {{--                <div class="col-12 col-sm-6 col-lg-3 mb-8">--}}
                {{--                    <div class="single-footer-widget">--}}
                {{--                        <h2 class="widget-title">Signup for newsletter</h2>--}}
                {{--                        <div class="widget-body">--}}
                {{--                            <!-- Newsletter Form Start -->--}}
                {{--                            <div class="newsletter-form-wrap pt-1">--}}
                {{--                                <form id="mc-form" class="mc-form">--}}
                {{--                                    <input type="email" id="mc-email" class="form-control email-box mb-4"--}}
                {{--                                           placeholder="demo@example.com" name="EMAIL">--}}
                {{--                                    <button id="mc-submit" class="newsletter-btn" type="submit">Subscribe</button>--}}
                {{--                                </form>--}}
                {{--                                <!-- mailchimp-alerts Start -->--}}
                {{--                                <div class="mailchimp-alerts text-centre">--}}
                {{--                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->--}}
                {{--                                    <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->--}}
                {{--                                    <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->--}}
                {{--                                </div>--}}
                {{--                                <!-- mailchimp-alerts end -->--}}
                {{--                            </div>--}}
                {{--                            <!-- Newsletter Form End -->--}}
                {{--                            <p class="desc-content mb-0">Join over 1,000 people who get free and fresh content delivered--}}
                {{--                                automatically each time we publish</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Footer Top End -->

    <!-- Footer Bottom Start -->
{{--    <div class="footer-bottom bg-secondary pt-4 pb-4">--}}
{{--        <div class="container">--}}
{{--            <div class="row align-items-center">--}}
{{--                <div class="col-12 text-center">--}}
{{--                    <div class="copyright-content">--}}
{{--                        <p class="mb-0">Copyright &copy; 2021.Company name All rights reserved.<a target="_blank"--}}
{{--                                                                                                  href="https://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<!-- Footer Bottom End -->
</footer>
<!-- Footer Section End -->


<!-- Modal Start  -->
<div class="modalquickview modal fade" id="quick-view" tabindex="-1" aria-labelledby="quick-view" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="btn close" data-bs-dismiss="modal">×</button>
            <div class="row">
                <div class="col-md-6 col-12">

                    <!-- Product Details Image Start -->
                    <div class="modal-product-carousel">

                        <!-- Single Product Image Start -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/1.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/2.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/3.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/4.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/5.jpg" alt="Product">
                                </a>
                            </div>

                            <!-- Swiper Pagination Start -->
                            <!-- <div class="swiper-pagination d-md-none"></div> -->
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-button-next swiper-button-next"><i class="pe-7s-angle-right"></i>
                            </div>
                            <div class="swiper-product-button-prev swiper-button-prev"><i class="pe-7s-angle-left"></i>
                            </div>
                            <!-- Next Previous Button End -->
                        </div>
                        <!-- Single Product Image End -->

                    </div>
                    <!-- Product Details Image End -->

                </div>
                <div class="col-md-6 col-12 overflow-hidden position-relative">

                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">

                        <!-- Product Head Start -->
                        <div class="product-head mb-3">
                            <h2 class="product-title">Sample product title</h2>
                        </div>
                        <!-- Product Head End -->

                        <!-- Rating Start -->
                        <span class="ratings justify-content-start mb-2">
                            <span class="rating-wrap">
                                <span class="star" style="width: 100%"></span>
                            </span>
                            <span class="rating-num">(4)</span>
                            </span>
                        <!-- Rating End -->

                        <!-- Price Box Start -->
                        <div class="price-box mb-2">
                            <span class="regular-price">$80.00</span>
                            <span class="old-price"><del>$90.00</del></span>
                        </div>
                        <!-- Price Box End -->

                        <!-- Description Start -->
                        <p class="desc-content mb-5">I must explain to you how all this mistaken idea of denouncing
                            pleasure and praising pain was born and I will give you a complete account of the system,
                            and expound the actual teachings of the great explorer of the truth, the master-builder of
                            human happiness.</p>
                        <!-- Description End -->

                        <!-- Quantity Start -->
                        <div class="quantity d-flex align-items-center mb-5">
                            <span class="me-2"><strong>Qty: </strong></span>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" value="1" type="text">
                                <div class="dec qtybutton"></div>
                                <div class="inc qtybutton"></div>
                            </div>
                        </div>
                        <!-- Quantity End -->

                        <!-- Cart Button Start -->
                        <div class="cart-btn mb-4">
                            <div class="add-to_cart">
                                <a class="btn btn-dark btn-hover-primary" href="cart.html">Add to cart</a>
                            </div>
                        </div>
                        <!-- Cart Button End -->

                        <!-- Action Button Start -->
                        <div class="actions border-bottom mb-4 pb-4">
                            <a href="compare.html" title="Compare" class="action compare"><i
                                        class="pe-7s-refresh-2"></i> Compare</a>
                            <a href="wishlist.html" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i>
                                Wishlist</a>
                        </div>
                        <!-- Action Button End -->

                        <!-- Social Shear Start -->
                        <div class="social-share">
                            <span><strong>Social: </strong></span>
                            <a href="#" class="facebook-color"><i class="fa fa-facebook"></i> Like</a>
                            <a href="#" class="twitter-color"><i class="fa fa-twitter"></i> Tweet</a>
                            <a href="#" class="pinterest-color"><i class="fa fa-pinterest"></i> Save</a>
                        </div>
                        <!-- Social Shear End -->

                        <!-- Payment Option Start -->
                        <div class="payment-option mt-4 d-flex">
                            <span><strong>Payment: </strong></span>
                            <a href="#">
                                <img class="fit-image ms-1" src="assets/images/payment/payment.png"
                                     alt="Payment Option Image">
                            </a>
                        </div>
                        <!-- Payment Option End -->

                        <!-- Product Delivery Policy Start -->
                        <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                            <li><i class="fa fa-check-square"></i> <span>Security Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                            <li>
                                <i class="fa fa-truck"></i><span>Delivery Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                            <li>
                                <i class="fa fa-refresh"></i><span>Return Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                        </ul>
                        <!-- Product Delivery Policy End -->

                    </div>
                    <!-- Product Summery End -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End  -->

<a href="#" class="scroll-top show" id="scroll-top">
    <i class="arrow-top pe-7s-angle-up-circle"></i>
    <i class="arrow-bottom pe-7s-angle-up-circle"></i>
</a>

<!-- Mobile Menu Start -->
<div class="mobile-menu-wrapper">
    <div class="offcanvas-overlay"></div>

    <!-- Mobile Menu Inner Start -->
    <div class="mobile-menu-inner">

        <!-- Button Close Start -->
        <div class="offcanvas-btn-close">
            <i class="pe-7s-close"></i>
        </div>
        <!-- Button Close End -->

        <!-- Mobile Menu Inner Wrapper Start -->
        <div class="mobile-menu-inner-wrapper">
            <!-- Mobile Menu Search Box Start -->

            <!-- Mobile Menu Search Box End -->

            <!-- Mobile Menu Start -->
            <div class="mobile-navigation">
                <nav>
                    <ul class="mobile-menu">
                        @foreach($menus as $item)

                            @if(!empty($item['sub']))
                                <li class="has-children">
                                    <a href="#">{{$item['name']}} <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">

                                        @foreach($item['sub'] as $sub_item)
                                            <li><a href="{{$sub_item['href']}}">{{$sub_item['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{$item['href']}}">{{$item['name']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
            <!-- Mobile Menu End -->

            <!-- Language, Currency & Link Start -->

            <!-- Language, Currency & Link End -->

            <!-- Contact Links/Social Links Start -->

            <!-- Contact Links/Social Links End -->
        </div>
        <!-- Mobile Menu Inner Wrapper End -->

    </div>
    <!-- Mobile Menu Inner End -->
</div>
<!-- Mobile Menu End -->