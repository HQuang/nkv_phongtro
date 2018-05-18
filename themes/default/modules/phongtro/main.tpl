<!-- BEGIN: main -->
<!-- BEGIN: view -->
<div class="well">
	<form action="{NV_BASE_SITEURL}index.php" method="get">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
		<div class="row">
			<div class="col-xs-24 col-md-6">
				<div class="form-group">
					<input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
				</div>
			</div>
		</div>
	</form>
</div>
<!-- BEGIN: loop -->
<div class="col-md-12">
	<div class="pt_items">
		<div class="col-md-10">
			<a href="#"><img width="200" height="200" class="img-thumbnail" src="{VIEW.img}" title="{VIEW.img_alt}" /></a>
		</div>
		<div class="col-md-14">
			<div class="col-md-24 no-padding">
				<div class="col-md-24 line_custom">
					<h4>
						<a href="{VIEW.link_detail}">{VIEW.title}</a>
					</h4>
				</div>
				<div class="col-md-10">
					<p class="bg-success price">{VIEW.price}</p>
				</div>
				<div class="col-md-7 pd-5">{VIEW.area}m²</div>
				<div class="col-md-7 pd-5">{VIEW.object_id}</div>
				<div class="col-md-24 locations">
					<i>{VIEW.locations}</i>
				</div>
				<div class="col-md-24 line_custom">{VIEW.note}</div>
			</div>
		</div>
		<div class="col-lg-24 no-padding quick_view">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#product_view{VIEW.id}">
				<i class="fa fa-search"></i> {LANG.quick_view}
			</button>
		</div>
	</div>
</div>
<div class="modal fade product_view" id="product_view{VIEW.id}">
	<div class="modal-dialog modal_edit">
		<div class="modal-content">
			<div class="modal-header">
				<a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				<h3 class="modal-title">{VIEW.title}</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 product_img">
						<img src="{VIEW.img}" title="{VIEW.img_alt}" class="img-responsive">
					</div>
					<div class="col-md-14 items_detail">
						<div class="col-md-24 no-padding text-center">
							<div class="col-md-10">
								<p class="bg-success price">{VIEW.price}</p>
							</div>
							<div class="col-md-7 pd-5">{VIEW.area}m²</div>
							<div class="col-md-7 pd-5">{VIEW.object_id}</div>
							<div class="col-md-24 locations text-left">
								<i>{VIEW.locations}</i>
							</div>
						</div>
						<p>{VIEW.note}</p>
						<b class="cost"> <span class="glyphicon glyphicon-usd"></span> {VIEW.price} VNĐ
						</b>
						<div class="space-ten"></div>
						<div class="btn-ground">
							<a href="{VIEW.link_detail}" class="btn btn-primary">
								aaa
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: loop -->
<!-- <tr> -->
<!-- 	<td></td> -->
<!-- 	<td>{VIEW.cat_id}</td> -->
<!-- 	<td>{VIEW.phone}</td> -->
<!-- 	<td>{VIEW.price}</td> -->
<!-- 	<td>{VIEW.unit_id}</td> -->
<!-- 	<td>{VIEW.area}</td> -->
<!-- 	<td>{VIEW.object_id}</td> -->
<!-- 	<td>{VIEW.province_id}</td> -->
<!-- 	<td>{VIEW.district_id}</td> -->
<!-- 	<td>{VIEW.ward_id}</td> -->
<!-- 	<td>{VIEW.address}</td> -->
<!-- 	<td>{VIEW.note}</td> -->
<!-- 	<td>{VIEW.img}</td> -->
<!-- 	<td>{VIEW.img_alt}</td> -->
<!-- 	<td class="text-center"><input type="checkbox" name="active" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" /></td> -->
<!-- 	<td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td> -->
<!-- </tr> -->
<div class="col-lg-24 col-md-24 col-sm-24 text-center">
	<!-- BEGIN: generate_page -->
	{NV_GENERATE_PAGE}
	<!-- END: generate_page -->
</div>
<!-- END: view -->
<!-- END: main -->