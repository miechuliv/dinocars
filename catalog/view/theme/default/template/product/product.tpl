<?php echo $header; ?><?php // echo $column_left; ?><?php echo $column_right; ?>
<div id="content" ><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
 
  <div class="product-inf">
    <?php if ($thumb || $images) { ?>
    <div class="left">
      <?php if ($thumb) { ?>
    <!--  <div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div> -->
        <a id="zoom1" href="<?php echo $popup; ?>" class="cloud-zoom" rel="position: 'inside', adjustX: 0, adjustY: 0">
            <img id="image" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
        </a>
      <?php } ?>
      <?php  if ($images) { ?>
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a onmouseover="ZoomGallery('<?php echo $image["popup"];?>','<?php echo $image["middle"]; ?>')" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox">
		<img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a> 
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
	
<div class="right">
	<div>	
	
		<div id="prod-left">
			<div class="description">
				<h1><?php echo $heading_title; ?></h1>	
				
				  <?php if ($attribute_groups) { ?>
					  <div class="atrybuty">
						  <?php foreach ($attribute_groups as $attribute_group) { ?>
							<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
							  <div><strong><?php echo $attribute['name']; ?>:</strong> <?php echo $attribute['text']; ?></div>
							<?php } ?>
						  <?php } ?>
					  </div>
				<?php } ?> 
				
				<hr>
				
				<div class="atrybuty">
					<div><strong><?php echo $this->language->get('text_telephone'); ?></strong><?php echo $this->config->get('config_telephone'); ?></div>
					<div><strong>E-mail:</strong><?php echo $this->config->get('config_email'); ?></div>
				</div>
				
			</div>
		</div>
	
	<div id="prod-right">
	
      <?php if ($price) { ?>
	  
		  <div class="price"><?php echo $text_price; ?>
			<?php if (!$special) { ?>
			<?php echo $price; ?>
			<?php } else { ?>
			<span class="price-new" style="color:#cc0000"><?php echo $special; ?></span><br/>
			<small class="price-old" style="text-decoration: line-through; font-weight:normal; color:#aaa;"><?php echo $price; ?></small> 
			<?php } ?>
			<br/>
			<?php if ($tax) { ?>
			<span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span>
			<?php } ?>
			<?php if ($points) { ?>
			<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
			<?php } ?>
			<?php if ($discounts) { ?>
			<br/>
			<div class="discount">
			  <?php foreach ($discounts as $discount) { ?>
			  <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?>
			  <?php } ?>
			</div>
			<?php } ?>
		  </div>

		<div class="dost">
			<div><?php echo $this->language->get('text_service_48h'); ?></div>
		</div>
	  
	    <div class="cart" >

		<div>
			<div>
				<div style="float:left; padding:4px; color:#000;"><?php echo $text_qty; ?></div>
				<div id="minus">-</div>
				<input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" id="ilosc-prod"/>
				<div id="plus">+</div>
			</div>
		</div>
		
		<div>
			<div>
				<input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
				<input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="button" />
			</div>
		</div>
		
		<div class="promot">
			<div style="width:100%; padding:15px 0; border-top:1px solid #eee; margin:10px 0 0;">
				<div>
					<ul>
						<li><?php echo $this->language->get('text_cheap'); ?></li>
						<li><?php echo $this->language->get('text_save'); ?></li>
						<li><?php echo $this->language->get('text_send'); ?></li>
					</ul>
				</div>
			</div>
		</div>

		  <?/*
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <span class="links"><a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a><br />
            <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></span>
		*/?>

        <?php if ($minimum > 1) { ?>
        <div class="minimum"><?php echo $text_minimum; ?></div>
        <?php } ?>
      </div>
	  

	  
      <?php } ?>
      <?php if ($options) { ?>
      <div class="options">
        <h2><?php echo $text_option; ?></h2>
        <br />
        <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <select name="option[<?php echo $option['product_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
		  
		  	   <h1><?php echo $heading_title; ?></h1>
			   
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <table class="option-image">
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <tr>
              <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </label></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <br />
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
	 
	  </div>
    </div>
	</div>
</div>
 
  <div id="tabs" class="htabs"><a href="#tab-description"><?php echo $tab_description; ?></a>
    <?php if ($attribute_groups) { ?>
    <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
    <?php } ?>
    <?php if ($review_status) { ?>
    <a href="#tab-review"><?php echo $tab_review; ?></a>
    <?php } ?>
    <?php if ($products) { ?>
    <a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</a>
    <?php } ?>
  </div>
  <div id="tab-description" class="tab-content">
	<?php echo $description; ?>
	
	<div id="dane">
       <table>
	   
	           <tbody><tr>
            <td>
                Orginalne kody producenta            </td>
            <td>
                <ul>
                                     IB0445110002

                                </ul>
            </td>
        </tr>

           <tr>
               <td>
                   Samochód               </td>
               <td>
                   FIAT BRAVO I (182) 1.9 JTD 105               </td>
           </tr>

           <tr>
               <td>
                   Rocznik               </td>
               <td>
                   1998-12 - 2001-10               </td>
           </tr>

           <tr>
               <td>
                   Pojemność               </td>
               <td>
                   1910 ccm
               </td>
           </tr>

           <tr>
               <td>
                   Moc silnika               </td>
               <td>
                   KW:  77 KW:  105               </td>
           </tr>

           <tr>
               <td>
                   Liczba cylindrów               </td>
               <td>
                   4               </td>
           </tr>


        <tr>
               <td>
                   Kod EAN               </td>
               <td>
                                  </td>
           </tr>

           <tr>
               <td>
                   Kod silnika               </td>
               <td>
                   182 B4.000               </td>
           </tr>



        <tr>
            <td>
                Dodatkowe kody producentow            </td>
            <td>
                <ul>
                                        BOSCH 0445110002

                                        BOSCH 0986435001

                                        ALFA ROMEO 464302102

                                        FIAT 464302102

                                        LANCIA 464302102

                                        ALFA ROMEO 464629710

                                        FIAT 464629710

                                        LANCIA 464629710

                                        ALFA ROMEO 46472233

                                        FIAT 46472233

                                        LANCIA 46472233

                                    </ul>
            </td>
        </tr>
       </tbody></table>

    </div>

      <div id="typy">
          <table>
              <tr>
                  <td>
                      <?php echo $text_make; ?>
                  </td>
                  <td>
                      <?php echo $text_model; ?>
                  </td>
                  <td>
                      <?php echo $text_type; ?>
                  </td>
                  <td>
                      <?php echo $text_year_start; ?>
                  </td>
                  <td>
                      <?php echo $text_year_end; ?>
                  </td>
                  <td>
                      <?php echo $text_ccm; ?>
                  </td>
                  <td>
                      <?php echo $text_power; ?>
                  </td>
              </tr>
              <?php foreach($types as $type){ ?>
              <tr>
                  <td>
                      <?php echo $type['make_name']; ?>
                  </td>
                  <td>
                      <?php echo $type['model_name']; ?>
                  </td>
                  <td>
                      <?php echo $type['type_name']; ?>
                  </td>
                  <td>
                      <?php echo $type['year_start']; ?>
                  </td>
                  <td>
                      <?php echo ($type['year_end']=='0000-00'?'-':$type['year_end']); ?>
                  </td>
                  <td>
                      <?php echo $type['ccm']; ?>
                  </td>
                  <td>
                      KW:  <?php echo $type['kw']; ?>
                  </td>
              </tr>

              <?php } ?>



          </table>

      </div>
	
  </div>


  <?php if ($products) { ?>
  <div id="tab-related" class="tab-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <a onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button"><?php echo $button_cart; ?></a></div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php // echo $alsobought; ?></div>
  <?php echo $content_bottom; ?>
<?/*
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
});
//--></script> 
*/?>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<? /*
<script type="text/javascript"><!--

$(document).ready(function(){

 var el = $('#ilosc-prod');
  function change( amt ) {
    el.val( parseInt( el.val(), 10 ) + amt );
  }

  $('#plus').click( function() {
    change( 1 );
  } );
  $('#minus').click( function() {
      if($(this).next().val() > 0 )
      {
          change( -1 );
      }

  } );

	$('#tab-description a').contents().unwrap();
	$('#tab-description li').contents().unwrap();
	$("#tab-description p").first().css('display','none');
	$("#tab-description p").last().css('width','100%');
});

$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script>
*/?> 
<?/*
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> */?>

<?php echo $footer; ?>