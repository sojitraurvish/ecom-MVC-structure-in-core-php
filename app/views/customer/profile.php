<?php $this->view(CUSTOMER_DIR,"header",$data); ?>

<section id="main-content">
    <section class="wrapper">
        <style>
            .col-md-6{
                color:#293444;
            }
            .small{
                color:#6e93ce;
            }
            .p{
                color:#6e93ce;
            }
        </style>
            <div class="row">
                <div class="col-lg-9 main-chart">
                    
                        <div class="col-md-4 mb">
                                <!-- WHITE PANEL - TOP USER -->
                            <div class="white-panel pn">
                                    <div class="white-header" style="background-color:gray;">
                                        <h5 style="color:black;">MY ACCOUNT</h5>
                                    </div>
                                    <p><img src="<?php  echo ASSETS . ADMIN_DIR ?>img/ui-zac.jpg" class="img-circle" width="80"></p>
                                    <p><b style="color:black;"><?php echo $data["user_data"]->name; ?></b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="small mt" style="color:black;">MEMBER SINCE</p>
                                            <p>2012</p>
                                            <p class="small mt" style="color:black;"><i class="fa fa-edit"></i>Edit</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="small mt" style="color:black;">TOTAL SPEND</p>
                                            <p>$ 47,60</p>
                                            <p class="small mt" style="color:black;"><i class="fa fa-delete"></i>Delete</p>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
    </section>
</section>
<?php $this->view(CUSTOMER_DIR,"footer",$data); ?>