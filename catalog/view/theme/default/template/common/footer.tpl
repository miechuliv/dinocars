</div></div>

<?/*
<div id="mychat"><a href="http://www.phpfreechat.net">Creating chat rooms everywhere - phpFreeChat</a></div>

<script type="text/javascript">
    $('#mychat').phpfreechat({ serverUrl: '/phpfreechat-2.1.0/server' });
</script>
*/?>


<div id="ultraheader">
	<div class="poziom">
		<div><span><?php echo $text_bok; ?> </span><strong><?php echo $this->config->get('config_telephone'); ?></strong> | <a href="<?php echo $this->config->get('config_email'); ?>"><strong><?php echo $this->config->get('config_email'); ?></strong></a></div>
		<div><a href="./index.php?route=account/login"> <?php echo $text_login; ?> </a> | <a href="javascript:void(0);" id="jezykclick"><?php echo $text_language; ?>
        <ul id="mielone">
            <?php foreach($stores as $store){ ?>
                <li class="<?php echo $store['name']; ?>">
                    <?php if($store['active']){ echo 'aktywny';  } ?>
                    <a href="<?php echo $store['url']; ?>" ><?php echo $store['name']; ?></a>
                </li>
            <?php } ?>
        </ul>
        </div>
	</div>
</div>

<div id="footer">
<div class="poziom" style="width:950px;">
  <?php if ($informations) { ?>
  <div class="column">
    <h3><?php echo $text_information; ?></h3>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <div class="column">
    <h3><?php echo $text_service; ?></h3>
    <ul>
      <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
  <?/*
  <div class="column">
    <h3><?php echo $text_extra; ?></h3>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
      <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
  */?>
  <div class="column">
    <h3><?php echo $text_account; ?></h3>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
  <div class="column" style="color:#e78888;">
	<h3><?php echo $text_contact; ?>Kontakt</h3>
	Ul. Długa 301/340<br/>
	80-330 Gdańsk<br/><br/>
	<?php echo $this->config->get('config_telephone'); ?><br/>
	<a href="mailto:<?php echo $this->config->get('config_email'); ?>"><?php echo $this->config->get('config_email'); ?></a>

	</div>
<div class="column">
<h3>Facebook</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/pages/Dinocars/583125971761725?skip_nax_wizard=true" data-width="200" data-height="100" data-colorscheme="dark" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
</div>

</div>

<script type="text/javascript"><!--
    $('#button-cart').bind('click', function() {

        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('.product-inf input[type=\'text\'], .product-inf input[type=\'hidden\'], .product-inf input[type=\'radio\']:checked, .product-inf input[type=\'checkbox\']:checked, .product-inf select, .product-inf textarea, input[name="kaucja"]'),
            dataType: 'json',
            success: function(json) {
                $('.success, .warning, .attention, information, .error').remove();

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                        }
                    }
                }

                if (json['success']) {

                    html = cartNotify(json);

                    $('#notification').html(html);

                    $('.success').fadeIn('slow');

                    $('#cart-total').html(json['total']);

                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                }
            }
        });
    });

	$('#jezykclick').click(function() {
		$(this).hide();
		$('#mielone').css('display','inline-block');
	});

    //--></script>

</body></html>