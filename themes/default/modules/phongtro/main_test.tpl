<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
<div class="panel panel-default">
<div class="panel-body">
	<input type="hidden" name="id" value="{ROW.id}" />
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="title" value="{ROW.title}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<select class="form-control" name="unit_id">
				<option value=""> --- </option>
				<!-- BEGIN: select_unit_id -->
				<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
				<!-- END: select_unit_id -->
			</select>
		</div>
	</div>
	<div class="form-group text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</div></div>
</form>
<!-- END: main -->