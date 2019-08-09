<?php if(!empty($lists)){ 
     foreach($lists as $list){
         if(!empty($list['restaurant_id'])){
?>
<div class="sear_cont">
    <a href="<?php echo base_url('restaurant/'.str_replace(' ','-',$list['restaurant_name'])); ?>" class="searchbtns">
        <p><?php echo $list['restaurant_name'];?><span></span></p>
        
    </a>
</div>
<?php } if(!empty($list['product_id'])){ ?>
<div class="sear_cont">
    <a href="<?php echo base_url('product/'.str_replace(' ','-',$list['product_name'])); ?>" class="searchbtns">
        <p><?php echo $list['product_name'];?><span></span></p>
    </a>
</div>
<?php } } } ?>
