<?php echo $header; ?><?php // echo $column_left; ?>
<div id="content" style="margin:0;"><?php // echo $content_top; ?>

<div class="wyszukiwarka"> 
	<div id="wysz">

		<form id="czesci_szuk" class="szukaja" action="<?php echo $car_action; ?>" method="get">
		
			<input type="hidden" value="product/category" name="route" />
            <input type="hidden" name="m_autoload" value="true" />
			<h1><?php echo $text_search_cars; ?></h1>
			<h2><?php echo $text_choose; ?></h2>
			
				<div style="display:table; clear:both; width:100%;">
					<div>
						<div class="marka">
							<select id="make" name="make">
								<option><?php echo $text_marka; ?></option>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="model" name="model">
								<option><?php echo $text_model; ?></option>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="type" name="type">
								<option><?php echo $text_typ; ?></option>
							</select>
						</div>
					</div>
				</div>	
				
			<div style="display:table; margin:5px 0; clear:both; width:100%;">
				<div style="padding:0 4px;">
					<input type="submit" id="szukaj-but" value="Znajdź teraz!" class="submit">
				</div>
			</div>
			
		</form>	
		
		<div id="moreinfo">
			<div>
				<?php echo $column_left; ?>
			</div>
		</div>
	
	</div>
	<div id="rightsite">
		<?php echo $content_bottom; ?>
	</div>
</div>

<div id="fatur">
	<div>
		<?php echo $content_top; ?>
	</div>
</div>

<div class="promot">
	<div>
		<div>
			<h2><?php echo $text_why_us; ?></h2>
			<ul>
				<li><?php echo $text_cheap; ?></li>
				<li><?php echo $text_save; ?></li>
				<li><?php echo $text_send; ?></li>
				<li><?php echo $text_wide_choice; ?></li>
				<li><?php echo $text_zakupy; ?></li>
				<li><?php echo $text_fast; ?></li>
			</ul>
		</div>
	</div>
	<div>
		<div>
			<h2><?php echo $text_payment; ?>:</h2>
			<p>
				<img src="./image/data/payment icons/mastercard_curved_32px.png" alt=""/>
				<img src="./image/data/payment icons/visa_straight_32px.png" alt=""/>
				<img src="./image/data/payment icons/paypal_curved_32px.png" alt=""/>
			</p>
			<h2><?php echo $text_shipping; ?>:</h2>
			<p>
				<img src="http://allegro.ted.net.pl/img/ups.png" alt=""/>
			</p>
		</div>
	</div>
	<div>
		<div>
			<h2><?php echo $text_newsletter; ?></h2>
			</p>
            <?php echo $text_newsletter_ipsum; ?>
			</p>
            <?php  if(isset($this->session->data['newsletter_error'])){echo '<p>Wystąpił błąd</p>'; }?>
			<form id="zapisznewsletter" action="index.php?route=account/newslettervisitor" method="post" >



                            <input type="text" name="email_newsletter" />
                            <input type="submit" value="Zapisz się"  />



			</form>
		</div>
	</div>
</div>

<div class="promot">
	<h2><?php echo $text_about_us; ?></h2>
	<p><?php echo $text_about_us_ipsum; ?></p>
</div>
	
</div>



<?php echo $footer; ?>