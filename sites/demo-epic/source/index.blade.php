@extends('_layouts.master')

@section('body')
    <div class="row page_wrap">
        <!-- page wrap -->
        <div class="twelve columns">
            <!-- page wrap -->

            <div class="row">
                <div class="twelve columns header_nav">

                    <div class="twelve columns">
                        <ul id="menu-header" class="nav-bar horizontal">

                            <li><a href="index.html"><img src="images/logo.png" alt="desc" style="border:none"/></a>
                            </li>


                            <li class="has-flyout">
                                <a href="#">Example Pages</a><a href="#" class="flyout-toggle"></a>

                                <ul class="flyout">

                                    <li class="has-flyout"><a href="index.html">Homepage</a></li>

                                    <li class="has-flyout"><a href="blog.html">Blog</a></li>

                                    <li class="has-flyout"><a href="blog_single.html">Blog Single Page</a></li>

                                    <li class="has-flyout"><a href="products-page.html">Products Page</a></li>

                                    <li class="has-flyout"><a href="product-single.html">Product Single</a></li>

                                    <li class="has-flyout"><a href="pricing-table.html">Pricing Table</a></li>

                                    <li class="has-flyout"><a href="contact.html">Contact Page</a></li>

                                </ul>
                            </li>

                            <li class=""><a href="galleries.html">Boxed Gallery</a></li>

                            <li class=""><a href="portfolio.html">Portfolio Gallery</a></li>

                            <li class=""><a href="pinterest-style.html">Pinterest Gallery</a></li>

                        </ul>
                        <script type="text/javascript">
                            //<![CDATA[
                            $('ul#menu-header').nav - bar();
                            //]]>
                        </script>

                    </div>

                </div>


            </div>
            <!-- END Header -->


            <div class="show-for-large-up">
                <div class="row">
                    <div class="twelve columns">
                        <div id="featured"><img src="images/demo1.jpg" alt="desc"/> <img src="images/demo2.jpg"
                                                                                         alt="desc"/> <img
                                    src="images/demo3.jpg" alt="desc"/></div>
                    </div>
                </div>
            </div>


            <div class="row hide-for-small">

                <div class="twelve columns">
                    <div class="heading_dots"><h1 class="heading_supersize" style="margin-bottom:10px"><span
                                    class="heading_center_bg">This is Epic!</span></h1></div>
                </div>

            </div>
            <!-- end row -->


            <div class="row">
                <div class="three columns">
                    <h3>Adipiscing Elit</h3>

                    <p><span class="dropcap_green">1</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Nunc viverra, lacus id interdum ultrices, elit metus semper tellus, vel lacinia libero purus
                        vitae risus. Integer a eros sit amet felis tincidunt commodo.</p>
                </div>

                <div class="three columns">
                    <h3>Lectus Congue</h3>

                    <p><span class="dropcap_black">2</span> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet
                        consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque
                        penatibus et magnis dis parturient montes.</p>
                </div>

                <div class="three columns">
                    <h3>Gravida Pharetra</h3>

                    <p><span class="dropcap_black">3</span> Sed vitae nisi leo. Nulla tincidunt, turpis non gravida
                        pharetra, diam sapien posuere massa, non luctus leo mauris at sapien. Donec ut fermentum eros.
                        Vestibulum placerat dui sit amet quam.</p>
                </div>

                <div class="three columns">
                    <h3>Gravida Pharetra</h3>

                    <p><span class="dropcap_black">4</span> Sed vitae nisi leo. Nulla tincidunt, turpis non gravida
                        pharetra, diam sapien posuere massa, non luctus leo mauris at sapien. Donec ut fermentum eros.
                        Vestibulum placerat dui sit amet quam.</p>
                </div>

            </div>
            <!-- end row -->

            <hr/>

            <div class="row" style="padding-top: 20px">

                <div class="four columns">
                    <img src="images/demo2_small.jpg" alt="desc"/>

                    <h3>Adipiscing Elit</h3>

                    <p><em>Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci.</em></p>
                </div>

                <div class="four columns">
                    <img src="images/demo1_small.jpg" alt="desc"/>

                    <h3>Adipiscing Elit</h3>

                    <p><em>Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci.</em></p>
                </div>

                <div class="four columns">
                    <img src="images/demo3_small.jpg" alt="desc"/>

                    <h3>Adipiscing Elit</h3>

                    <p><em>Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci.</em></p>
                </div>

            </div>
            <!-- end row -->


            <div class="row">
                <div class="twelve columns">
                    <ul id="menu3" class="footer_menu horizontal">
                        <li class=""><a href="index.html">Home</a></li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                //<![CDATA[
                $('ul#menu3').nav - bar();
                //]]>
            </script>

        </div>

    </div><!-- end page wrap) -->
@endsection
