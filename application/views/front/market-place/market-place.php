 <section class="brows_store marketPlace_main topScrl">
        <div class="container">
            <div class="bread_crumb breadcrumb_shipping">
                <ul class="bread_crumb_menu">
                    <li><a href="<?php echo base_url('site');?>">Home</a></li>
                    <li><a> <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)" class="active">Market Place</a></li>
                </ul>
            </div>
            <div class="browsStore_inner boxs">
                <div class="row">
                    <div class="col-sm-3 colWidth1 colWidth1_2">
                        <div class="brows_store_lft boxs dnone">
                            <div class="categories boxs">
                                <h3>PRODUCT CATEGORIES</h3>
                                <div class="categories_btm shop_secton_d boxs">
                                    <ul class="market_prod">
                                        <?php 
                                         $i = 1;
                                        foreach($categories as $category){
                                        ?>
                                        <li><a href="<?php echo base_url('marketPlace/get-market-place-wrapper/' . $category['category_id'] . '/0'); ?>" class="common-menu <?php
                                    if ($i == 1) {
                                        echo 'active';
                                    }
                                    ?>"><?php echo $category['category_name']; ?><span>(<?php echo $category['total']; ?>)</span></a></li>
                                        <?php
                                        $i++;
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 colWidth2 colWidth2_1">
                        <div class="browsAll_store_lft boxs">
                            <div class="browsAll_store canad_foot market_allstr boxs">
                                <div class="brows_head boxs">
                                    <h2>Marketplace 
                                        <!--<span>(1–16 OF 599)</span>-->
                                    </h2>
                                </div>
                                <div class="brows_store_box boxs">
                                    <div class="browsAll_str_lft">
                                        <div class="search_sec market_search_sec boxs">
                                            <input type="text" class="form-control" id="serach-product" placeholder="Search product name etc.">
                                            <img src="<?php echo base_url('assets/img/searchicon.png');?>" alt="search">
                                        </div>
                                    </div>
                                    <div class="res_prod_cat boxs">
                                        <div class="categories boxs">
                                            <a href="javascript:void(0)" class="pro_drop">Product Categories <img src="<?php echo base_url('assets');?>/img/arrowdwn.png" alt="arrowdwn" class="img-responsive rotate"></a>
                                            <div class="pro_drop_menu boxs">
                                                <a href="fashion.html">Fashion</a>
                                                <a href="javascript:void(0)">Grocery</a>
                                                <a href="javascript:void(0)">Home</a>
                                                <a href="javascript:void(0)">Party / Events</a>
                                                <a href="javascript:void(0)">Uncategorized</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="browsAll_str_rht res_prod_sort">
                                        <div class="fil_drop">
                                            <button type="button" class="filDrop_btn popFil_btn">
                                                Sort By : <span>popularity</span>
                                                <img src="<?php echo base_url('assets');?>/img/arrowdwn.png" alt="arrow">
                                            </button>
                                            <div class="filDrop_content popularity marketSort">
                                                <!--<a href="javascript:void(0)">newness</a>-->
                                               <a href="javascript:void(0)" class="filteration-product" data-val="low-to-high">low to high</a>
                                               <a href="javascript:void(0)" class="filteration-product" data-val="high-to-low">high to low</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="content-wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>