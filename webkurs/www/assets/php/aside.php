<!-- aside -->
<aside>
	<h3>Купить недвижимость</h3>
	<form onsubmit="generateEstateFilters(true);return false" id='filters-form'>
		<input type="text" name='is-filters' class="invisible">
		<div id='aside-filters'>
			<div class="input-group filters-form">
				<input type="text" name='town' class="form-control filters-form-price-elem" placeholder="Город">
			</div>
			<div class="btn-group" role="group">
				<!--<div class="btn btn-outline-secondary select-btn">
					<select class='realty-filters' name='type-sale'>
						<option>
							Купить
						</option>
						<option>
							Снять
						</option>
					</select>
				</div>-->
				<div class="btn btn-outline-secondary select-btn">
					<select class='realty-filters' name='type-house'>
						<option value='Квартира'>
							Квартира
						</option>
						<option value='Комната'>
							Комната
						</option>
						<option value='Дом'>
							Дом
						</option>
						<option value='Коммерческая недвижимость'>
							Коммерческая недвижимость
						</option>
					</select>
				</div>
			</div>
			<div class="input-group filters-form">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Цена</span>
				</div>
				<input type="text" name='min-price' class="form-control filters-form-elem" placeholder="от">
				<input type="text" name='max-price' class="form-control filters-form-elem" placeholder="до">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">₽</span>
				</div>
			</div>
			<div class="input-group filters-form">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Площадь</span>
				</div>
				<input type="text" name='min-square' class="form-control filters-form-elem" placeholder="от">
				<input type="text" name='max-square' class="form-control filters-form-elem" placeholder="до">
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">м2</span>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Найти">
		</div>
	</form>
</aside>