<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>


  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

<div id="content">

   <?php  if(!empty($filter_labels)){ ?>
      <div id="filtery">
	  <h3 style="margin:0 0 10px;">Aktywne filtry:</h3>
          <?php  foreach($filter_labels as $label){ ?>
                <div class="kill-filter">
                    <input type="hidden" name="input_name" value="<?php echo $label['input_name']; ?>"  />
                     <small class="filter-name"><?php echo $label['name']; ?></small><small class="filter-value" style="margin-left: 5px" ><?php echo $label['value']; ?></small> <span>X</span>
                </div>
			<?php }  ?>
		</div>
	<?php  } ?>

<?php echo $content_top; ?>

<?php if ($products) { ?>  

	<div class="product-list">
    <?php foreach ($products as $product) { ?>
    <div>

      <?php if ($product['thumb']) { ?>

        <?php if ($product['additional_image']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img id="<?php echo $product['product_id']?>_first" onmouseover="ReplaceImageOnHover(<?php echo $product['product_id'];?>)" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
        <img class="DisplayOff" id="<?php echo $product['product_id']?>_second" onmouseout="ReplaceImageOnHoverOut(<?php echo $product['product_id'];?>)" src="<?php echo $product['additional_image']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php }else{ ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img  src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <?php } ?>
      <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
      <div class="description"><?php echo $product['description']; ?><br/><br/><div class="dost">Dostawa: 48h</div></div>
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
        <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
      <div class="cart">
        <a href="<?php echo $product['href']; ?>"  ><input type="button" value="zobacz"  class="button" /></a>
      </div>
    </div>
    <?php } ?>


  </div>
  <div class="pagination"><?php echo $pagination; ?></div>

<?php }else{ ?>

	<div id="search-error">
		<?php echo $contact_link_text; ?><br/>		
	</div>
	
<?php } ?>

  <?php echo $content_bottom; ?>
 
</div>
<?php echo $footer; ?>