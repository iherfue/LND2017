(:<table> {
for $producto in /almacen/producto

where starts-with ($producto/nombre, "K")
order by $producto descending
return <tr><td>{$producto/nombre/text()}</td></tr>
}
</table>:)

(:<table border="1px"> {
for $producto in /almacen/producto
where $producto[@categoria = 'Graficas']
order by $producto
return
 <tr>
  <td>{$producto/nombre/text()}</td>
  <td> {string-length($producto/nombre/text())}</td>
 </tr>
}
</table>:)

(:<table border="1px">{
for $c in /almacen/producto
let $suma := $c/@categoria
group by $suma

return 
<tr>
<td><resultado>Suma Total: {sum($c/cantidad)}</resultado></td>
</tr>
}
</table>
:)


<table border="1px"> {
for $producto in /almacen/producto

order by $producto/nombre
return
 <tr>
  <td>{lower-case($producto/nombre/text())}</td>
  
 </tr>
}
</table>
