--Vista Catastro
Create or replace View vcatastro as SELECT c."ID", "EnArchiva", f."Fondo", sec."Seccion", ser."Serie",
"Tipo", "Signatura", "Titulo", "Plano", "Poligono", "Fecha", "FechaInicio", "FechaFin", "Deposito",
p."Provincia", m."Municipio", "Gerencia", "PartidoJudicial", "Numeral", "CaracteristicasFisicas",
"Tamano", "Procedencia", "Autor", "Observaciones", "FechaDescripcion", "NotaArchivero",
nd."Norma", "NivelDescripcion", "InstrumentosDescripcion", "DocumentacionRelacionada",
"Disco", "UbicacionMaestro", "UbicacionComprimido"
	FROM public."1-3-5-Catastro" as c
    inner join "-Fondos" as f
    on c."Fondo"=f."ID"
    inner join "-Secciones" as sec
    on c."Seccion"=sec."ID"
    inner join "-Series" as ser
    on c."Serie"=ser."ID"
    inner join "-Provincias" as p
    on c."Provincia"=p."ID"
    inner join "-Municipios" as m
    on c."Municipio"=m."ID"
    inner join "-NormasDescripcion" as nd
    on c."NormasDescripcion"=nd."ID";
