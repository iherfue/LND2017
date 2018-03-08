<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:template match="/">
  <html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/css.css"/>
  </head>
  <body>
    <div class="contenedor">
      <header>
        <div class="nav-menu">
          <input type="checkbox" id="menu"/>
          <span class="icono">
            <label class="icon-menu" for="menu"/>
          </span>
          <nav>
            <ul>
                <li class="menus"><a href="index.html">Inicio</a></li>
                <li class="menus"><a href="procesador/procesador.html" target="_blank">Procesadores</a></li>
                <li class="menus"><a href="ram/memoria_ram.html" target="_blank">Memoria RAM</a></li>
                <li class="menus"><a href="graficas/graficas.html" target="_blank">Gráficas</a></li>
                <li class="menus"><a href="ratones/ratones.html" target="_blank">Ratones</a></li>
                <li class="menus"><a href="discos/discos.html" target="_blank">Discos</a></li>
                <li class="menus"><a href="inventario.html">Inventario</a></li>
            </ul>
        </nav>
        </div>
      </header>
        <h2 class="lista-titulo">Inventario</h2>
<section>
<div class="lista">
  <ol>
  <xsl:for-each select="almacen/producto">
  <xsl:sort select="nombre" order="ascending"/>
  <li><xsl:value-of select="nombre"/>:-----------------------------------------------------Cantidad:<xsl:value-of select="cantidad"/></li>

  </xsl:for-each>
  </ol>
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
