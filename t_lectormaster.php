<?php
namespace PHPMaker2019\BIBLIOTECA;
?>
<?php if ($t_lector->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_lectormaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
		<tr id="r_Id_lector">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Id_lector->caption() ?></td>
			<td<?php echo $t_lector->Id_lector->cellAttributes() ?>>
<span id="el_t_lector_Id_lector">
<span<?php echo $t_lector->Id_lector->viewAttributes() ?>>
<?php echo $t_lector->Id_lector->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
		<tr id="r_CI_DNI">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->CI_DNI->caption() ?></td>
			<td<?php echo $t_lector->CI_DNI->cellAttributes() ?>>
<span id="el_t_lector_CI_DNI">
<span<?php echo $t_lector->CI_DNI->viewAttributes() ?>>
<?php echo $t_lector->CI_DNI->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
		<tr id="r_Nombres">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Nombres->caption() ?></td>
			<td<?php echo $t_lector->Nombres->cellAttributes() ?>>
<span id="el_t_lector_Nombres">
<span<?php echo $t_lector->Nombres->viewAttributes() ?>>
<?php echo $t_lector->Nombres->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
		<tr id="r_Apellidos">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Apellidos->caption() ?></td>
			<td<?php echo $t_lector->Apellidos->cellAttributes() ?>>
<span id="el_t_lector_Apellidos">
<span<?php echo $t_lector->Apellidos->viewAttributes() ?>>
<?php echo $t_lector->Apellidos->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
		<tr id="r_Direccion">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Direccion->caption() ?></td>
			<td<?php echo $t_lector->Direccion->cellAttributes() ?>>
<span id="el_t_lector_Direccion">
<span<?php echo $t_lector->Direccion->viewAttributes() ?>>
<?php echo $t_lector->Direccion->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
		<tr id="r_Telefono">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Telefono->caption() ?></td>
			<td<?php echo $t_lector->Telefono->cellAttributes() ?>>
<span id="el_t_lector_Telefono">
<span<?php echo $t_lector->Telefono->viewAttributes() ?>>
<?php echo $t_lector->Telefono->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
		<tr id="r_Tipo_Lector">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Tipo_Lector->caption() ?></td>
			<td<?php echo $t_lector->Tipo_Lector->cellAttributes() ?>>
<span id="el_t_lector_Tipo_Lector">
<span<?php echo $t_lector->Tipo_Lector->viewAttributes() ?>>
<?php echo $t_lector->Tipo_Lector->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
		<tr id="r_Institucion">
			<td class="<?php echo $t_lector->TableLeftColumnClass ?>"><?php echo $t_lector->Institucion->caption() ?></td>
			<td<?php echo $t_lector->Institucion->cellAttributes() ?>>
<span id="el_t_lector_Institucion">
<span<?php echo $t_lector->Institucion->viewAttributes() ?>>
<?php echo $t_lector->Institucion->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
