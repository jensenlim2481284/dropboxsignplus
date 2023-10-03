@extends("pages.pwa.layout")

@section('head')

<title>KKM Web</title>
<link href="/css/page/pwa/homepage.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />

@endsection

@section('content')
    <div id='bg-dot1'></div>
    <div id='bg-dot2'></div>
    <div id='app-body'>
        <img src='/img/vector/v1.png' id='v1'/>
        <img src='/img/icon/like.png' id='v2'/>
        <img src='/img/icon/brand-identity.png' id='v3'/>
        <img src='/img/icon/box.png' id='v4'/>
        <!-- <img src='/img/icon/medical.png' id='v5'/> -->
        <img src='/img/icon/medicine.png' id='v6'/>
        <h1> Welcome </h1>
        <p>Our cutting-edge app gives you the power to ensure the products you buy are genuine and high-quality. </p>
        <div id='app-sections' class='mt-4'>
            <div class='row'>
                <div class='col-6'>
                    <div class='app-section-item'>
                        <a  href='/scan'>
                            <img src='/img/icon/qr-code.gif'/>
                            <p>Scan QR</p>
                        </a>
                    </div>
                </div>
                <div class='col-6'>
                    <div class='app-section-item'  id='productBtn'>
                        <img src='/img/icon/dairy-products.gif'/>
                        <p>My Products</p>
                    </div>
                </div>
                <div class='col-6'>
                    <div class='app-section-item'  id='contactBtn'>
                        <img src='/img/icon/society.gif'/>
                        <p>Connect Us</p>
                    </div>
                </div>
                <div class='col-6'>
                    <div class='app-section-item' id='aboutBtn'>
                        <img src='/img/icon/info.gif'/>
                        <p>About</p>
                    </div>
                </div>
            </div>
            <div class='copyright'>
                <small> VerifyAuthentic Copyright ©2023 </small> 
            </div>

            <div class='slideup-box' id='productBox'>
                <div class='slideup-container'>
                    <div class='slideup-content'>
                        <div class='btn-close'>
                            <i class='ti ti-close'></i>
                        </div>

                        <img src='/img/vector/space.png'/>
                        <h2> Coming Soon </h2>
                        <p>Monitor your scanned products and maintain a record of your purchasing patterns.</p>
                        <button class='btn btn-default close-btn'>Close</button>
                    </div>
                </div>
            </div>
            

            <div class='slideup-box' id='contactBox'>
                <div class='slideup-container'>
                    <div class='slideup-content'>
                        <div class='btn-close'>
                            <i class='ti ti-close'></i>
                        </div>
                        <img src='/img/vector/agency.png'/> 
                        <h2>Connect with Us</h2>
                        <div class='connect-btn-section'>
                            <button class='btn connect-btn'>
                                <i class='ti-email'></i>
                            </button>
                            <button class='btn connect-btn'>
                                <i class='ti-mobile'></i>
                            </button>
                            <button class='btn connect-btn active'>
                                <i class='ti-facebook'></i>
                            </button>
                          
                        </div>
                        <button class='btn btn-default close-btn'>Close</button>
                    </div>
                </div>
            </div>
            

            <div class='slideup-box' id='aboutBox'>
                <div class='slideup-container'>
                    <div class='slideup-content'>
                        <div class='btn-close'>
                            <i class='ti ti-close'></i>
                        </div>
                        <img src='/img/logo/logo1.png' class='logo'/> 
                        <h2>About VerifyAuthentic </h2>
                        <p> Welcome to VerifyAuthentic, your ultimate weapon against counterfeit products. Simply scan the product's barcode or QR code, and VerifyAuthentic will swiftly analyze the item, cross-referencing it with our extensive database.  </p>
                        <button class='btn btn-default close-btn'>Close</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $(document).on('click','#productBtn',function(){
                $("#productBox").addClass('open');
            })
            $(document).on('click','#aboutBtn',function(){
                $("#aboutBox").addClass('open');
            })
            $(document).on('click','#contactBtn',function(){
                $("#contactBox").addClass('open');
            })

            $(document).mouseup(function(e) 
            {
                var container = $(".slideup-container");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) 
                {
                    closeModal();
                }
            });

            $(document).on('click','.btn-close, .close-btn', function(){
                closeModal();
            })

        })

        function closeModal(){
            $('.slideup-box.open').addClass('close');
            setTimeout(function(){
                $('.slideup-box.open.close').removeClass('open').removeClass('close')
            },200)
        }


    </script>
@stop
