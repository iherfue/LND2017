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
                <li class="menus"><a href="procesador/procesador.html" target="_blank">Procesadores</a></li>
                <li class="menus"><a href="../ram/memoria_ram.html" target="_blank">Memoria RAM</a></li>
                <li class="menus"><a href="../graficas/graficas.html" target="_blank">Gráficas</a></li>
                <li class="menus"><a href="../ratones/ratones.html" target="_blank">Ratones</a></li>
                <li class="menus"><a href="../discos/discos.html" target="_blank">Discos</a></li>
                <li class="menus"><a href="../inventario.html" target="_blank">Inventario</a></li>
            </ul>
        </nav>
        </div>
    </header>
    
<section>
    <h2 class="resultados">Todos los Productos</h2>
 <div class="filtro">
            <p>Filtrar por socket</p>
            <a href="procesador_socket_1150.html">1150</a>
            <a href="procesador_socket_1151.html">1151</a>
            <a href="procesador_socket_AM4.html">AM4</a>
            <a href="procesador_socket_TR4.html">TR4</a>
          </div>
    <div class="tabla">
      <table>
    <tr>
      <xsl:for-each select="/almacen/producto[@categoria='Procesadores']">
        <td>
          <img>
          <xsl:attribute name="src">
            <xsl:value-of select="imagen"/>
            </xsl:attribute>
          </img>
          <p><xsl:value-of select="nombre"/></p>
          <p>Socket:<xsl:value-of select="socket"/></p>

          
          <xsl:if test="stock='Si' ">
          <p class="disponible">Disponible:
                  <xsl:value-of select="stock"/>
            </p>
            </xsl:if>
            
            <xsl:if test="cantidad = '0' and stock='No'">
          <p class="no_disponible">Disponible:
                  <xsl:value-of select="stock"/>
            </p>
            </xsl:if>
            
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
