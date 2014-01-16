<?php echo $header; ?><?php // echo $column_left; ?>
<div id="content" style="margin:0;"><?php // echo $content_top; ?>

<div class="wyszukiwarka"> 
	<div id="wysz">

		<form id="czesci_szuk" class="szukaja" action="<?php echo $car_action; ?>" method="get">
		
			<input type="hidden" value="product/category" name="route" />
            <input type="hidden" name="m_autoload" value="true" />
			<h1>Znajdź potrzebne części wg auta</h1>
			<h2>Wystarczy że wybierzesz markę, model i typ swojego pojazdu!</h2>
			
				<div style="display:table; clear:both; width:100%;">
					<div>
						<div class="marka">
							<select id="make" name="make">
								<option>Marka</option>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="model" name="model">
								<option>Model</option>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="type" name="type">
								<option>Typ</option>
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
			<h2>Dlaczego my?</h2>
			<ul>
				<li>Lorem ipsum tanio</li>
				<li>Bezpieczne zakupy lorem</li>
				<li>Lorem ipsum, tania przesyłka</li>
				<li>Szeroki wybór części lorem ipsum</li>
				<li>Bezpieczne zakupy lorem</li>
				<li>Lorem ipsum szybko</li>
			</ul>
		</div>
	</div>
	<div>
		<div>
			<h2>Płatność:</h2>
			<p>
				<img src="./image/data/payment icons/mastercard_curved_32px.png" alt=""/>
				<img src="./image/data/payment icons/visa_straight_32px.png" alt=""/>
				<img src="./image/data/payment icons/paypal_curved_32px.png" alt=""/>
			</p>
			<h2>Wysyłka:</h2>
			<p>
				<img src="http://allegro.ted.net.pl/img/ups.png" alt=""/>
			</p>
		</div>
	</div>
	<div>
		<div>
			<h2>Newsletter</h2>
			</p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum sit amet velit nec venenatis.
			</p>
			<form id="zapisznewsletter">
				<input type="text"><input type="submit" value="zapisz się">
			</form>
		</div>
	</div>
</div>

<div class="promot">
	<h2>O nas</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam condimentum sit amet velit nec venenatis. Nam dolor arcu, adipiscing at dui ac, mollis ullamcorper leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris enim dolor, semper sed mi vel, adipiscing condimentum neque. Donec vestibulum, ipsum ut pretium aliquam, nisi mauris blandit elit, sit amet sollicitudin urna massa ut neque. Maecenas vitae faucibus metus.</p>
</div>
	
</div>



<?php echo $footer; ?>