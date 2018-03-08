<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:template match="/">
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../css/css.css"/>
  </head>
  <body>
<div class="contenedor">
    <header>
        <div class="nav-menu">
        <input type="checkbox" id="menu"/>
            <span class="icono"><label class="icon-menu" for="menu"></label></span>
        <nav>
            <ul>
               <li class="menus"><a href="../index.html">Inicio</a></li>
                <li class="menus"><a href="../procesador/procesador.html" target="_blank">Procesadores</a></li>
                <li class="menus"><a href="../ram/memoria_ram.html" target="_blank">Memoria RAM</a></li>
                <li class="menus"><a href="../graficas/graficas.html" target="_blank">Gráficas</a></li>
                <li class="menus"><a href="ratones.html">Ratones</a></li>
                <li class="menus"><a href="../discos/discos.html" target="_blank">Discos</a></li>
                <li class="menus"><a href="../inventario.html" target="_blank">Inventario</a></li>
            </ul>
        </nav>
        </div>
    </header>
    
<section>
    <h2 class="resultados">Todos los Productos</h2>
<div class="item">
      <table>
    <tr>
      <xsl:for-each select="/almacen/producto[dpi = '16000']">
        <td>
        
        <xsl:if test="stock='Si' ">
          <p class="disponible">Disponible:
                  <xsl:value-of select="stock"/>&#160;Cantidad: <xsl:value-of select="cantidad"/>
            </p>
            </xsl:if>
                        <xsl:if test="cantidad = '0' and stock='No'">
          <p class="no_disponible">Disponible:
                  <xsl:value-of select="stock"/>&#160;Cantidad: <xsl:value-of select="cantidad"/>
            </p>
            </xsl:if>
          <img>
          <xsl:attribute name="src">
            <xsl:value-of select="imagen"/>
            </xsl:attribute>
          </img>
          <p><xsl:value-of select="nombre"/></p>
          <p>Tipo:<xsl:value-of select="tipo"/></p>
            
            <p>Precio (impuestos no incluidos)<xsl:value-of select="pvd"/> €</p>
            <p>Precio + IVA <xsl:value-of select="round(pvd * 21 div 100 + pvd)"/> €</p>
            <p>Precio + IGIC <xsl:value-of select="round(pvd * 7 div 100 + pvd)"/> €</p>
            <p>Comentario: <xsl:value-of select="informe"/></p>
          </td>
        </xsl:for-each>
       </tr>
      </table>
  </div>
  </section>
  <footer>
<p>Iván Hernández Fuentes Proyecto de LND sobre las tecnologías XML</p>  
  </footer>
  </div>
    </body>
  </html>
  </xsl:template>
</xsl:stylesheet>
