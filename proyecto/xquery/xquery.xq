(:<table>

  <tr>
    <th>Normal</th>
    <th>Mayúscula</th>
    <th>Minúscula</th>
  </tr>
 {
for $producto in /almacen/producto


return <tr>
        <td>{$producto/nombre/text()}</td>
        <td>{upper-case($producto/nombre/text())}</td>
        <td>{lower-case($producto/nombre/text())}</td>
       </tr>
}
</table>:)

(:<table>
{
   <tr>
   <tr>
   <th>"I"</th>
   {
    for $producto in /almacen/producto  
    where starts-with ($producto/nombre, "I")
    order by $producto descending
    return
     <td>{$producto/nombre/text()}</td>
   }
   </tr>
     <tr>
     <th>"S"</th>
     {
     for $s in(/almacen/producto)
     where starts-with ($s/nombre, "S")
     order by $s descending
     return
       <td>{$s/nombre/text()}</td>
     }
     </tr>
     <tr>
     <th>"C"</th>
      {
     for $c in(/almacen/producto)
     where starts-with ($c/nombre, "C")
     order by $c descending
     return
       <td>{$c/nombre/text()}</td>
     }
     </tr>
   </tr>
}
</table>
:)
(:
<table border="1px">
<tr>
<th>Nombre</th>
<th>Longitud</th>
</tr>
{ 
for $producto in /almacen/producto
where $producto[@categoria = 'Graficas']
order by $producto
return
 <tr>
  <td>{$producto/nombre/text()}</td>
  <td> {string-length($producto/nombre/text())}</td>
 </tr>
}
</table>
:)

(:<table>
  <tr>
    <th>Categoría</th>
    <th>Total</th>
  </tr>
{
for $s in /almacen/producto
let $categoria := $s/@categoria
group by $categoria

return 
<tr>
<td>{$categoria}</td>
<td>Suma Total: {sum($s/cantidad)}</td>
</tr>
}
</table>:)
(:
<table>
  <tr>
  <th>Nombre</th>
  <th>DPI</th>
  </tr>
 {

for $b in /almacen/producto
where exists(($b/dpi))

return
<tr>
<td>{$b/nombre/text()}</td>
<td>{$b/dpi/text()}</td>
</tr>
}
</table>:)

(:
<table>
  <tr>
    <th>Categoría</th>
    <th>Máximo</th>
    <th>Mínimo</th>
  </tr>
{
   for $max in /almacen/producto
 let $categoria := $max/@categoria
 where exists($max/pvd)
group by $categoria

  return 
  <tr>
<td>{$categoria}</td>
  <maximo>{if(max($max/pvd) > 100)

  then <td class="color">{max($max/pvd)}</td>
  else <td>Maximo:{max($max/pvd)}</td>

}</maximo>
  <td>Minimo: {min($max/pvd)}</td>
</tr>
}

</table>
:)
(:
<table>
  <tr>
    <th>Nombre</th>
    <th>Precio</th>
  </tr>
{
for $i in /almacen/producto
where every $numero in $i/pvd satisfies contains($numero,"2")

return
<tr>
  <td>{$i/nombre/text()}</td>
  <td>{$i/pvd/text()}</td>
</tr>
}
</table>
:)

(:MODIFICACION DE NODOS:)

(:insert node 

 <producto categoria="Procesadores">
    <nombre>Intel XEON E31220</nombre>
    <socket>1151 v2</socket><!--Opcional-->
    <cantidad>30</cantidad>
    <stock>Si</stock>
    <pvd>199</pvd>
    <imagen>imagenes/procesadores/xeon_e3.jpg</imagen>
    <informe>
    <comentario>Para servidores</comentario>
    </informe>
  </producto>
  
as first into /almacen:)

(:insert node

 <producto categoria="Graficas">
    <nombre>GTX 950M</nombre>
    <tipo>GDDR3</tipo>
    <cantidad>67</cantidad>
    <stock>Si</stock>
    <pvd>60</pvd>
    <imagen>imagenes/graficas/gtx_950.jpg</imagen>
    <informe>
      <comentario/>
      <!--default en xsd-->
    </informe>
  </producto>

before //producto[11]
:)

(:insert node

<producto categoria="DiscosDuros">
    <nombre>TOSHIBA3764</nombre>
    <tipo_disco>HDD</tipo_disco>
    <cantidad>79</cantidad>
    <stock>Si</stock>
    <pvd>45</pvd>
    <imagen>imagenes/discos/toshiba_3764.jpg</imagen>
    <informe>
      <comentario/>
      <!--default en xsd-->
    </informe>
  </producto>

as last into /almacen:)



(:replace value of node /almacen/producto[1]/pvd with '220':)

(:replace node /almacen/producto[@categoria = 'Graficas' and nombre = 'GTX 950M']
with
 <producto categoria="Graficas">
    <nombre>GTX 1060</nombre>
    <tipo>GDDR5</tipo>
    <cantidad>30</cantidad>
    <stock>Si</stock>
    <pvd>300</pvd>
    <imagen>imagenes/graficas/gtx_160.jpg</imagen>
    <informe>
      <comentario/>
      <!--default en xsd-->
    </informe>
  </producto>
:)


(:delete node doc("almacen.xml")//producto[@categoria = 'Procesadores' and nombre = 'Intel XEON E31220']:)

(:delete node doc("almacen.xml")//producto[10]:)

delete node doc("almacen.xml")//producto[19]
