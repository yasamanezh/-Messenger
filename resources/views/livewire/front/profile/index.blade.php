<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>profile</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>profile</li>
                    </ul>
                </div>
            </div>
            <div class="divider"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="banner-shape1"><img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="image"></div>
        </div>
          <!-- Start Checkout Area -->
		<div class="checkout-area ptb-100">
            <div class="container">
                
                <form>
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="billing-details">
                                <h3 class="title">Profile</h3>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                       
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email<span class="required">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>password</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <label>coniform password</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-6">
                                        <button class="default-btn">save</button>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </form>
            </div>
        </div>
		<!-- End Checkout Area -->

        <!-- End Page Title Area -->
    <livewire:front.layout.footer :language="$multiLanguage">

</div>

