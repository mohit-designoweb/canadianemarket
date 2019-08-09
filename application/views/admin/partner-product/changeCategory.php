<option value="">--- Select Shop Section ----</option>
<?php
foreach ($changeCategories as $changeCategory) {
    ?>
    <option value="<?php echo $changeCategory['shop_section_id']; ?>"><?php echo $changeCategory['shop_section_name']; ?></option>
    <?php
}
?>